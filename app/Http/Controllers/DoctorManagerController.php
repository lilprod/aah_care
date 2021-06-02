<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alert;
use App\User;
use App\Doctor;
use App\Drug;
use App\Speciality;
use App\Service;
use App\Patient;
use App\History;
use App\Appointment;
use App\Clinic;
use App\ClinicImage;
use App\Education;
use App\Experience;
use App\Award;
use App\Prescription;
use App\Payment;
use App\Review;
use App\Answer;
use App\Region;
use App\Country;
use App\DoctorService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Mail\SendPassChangeCode;

class DoctorManagerController extends Controller
{	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /*public function __construct()
    {
        $this->middleware(['auth', '2fa']);
    }*/

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $upcomapts = auth()->user()->doctorUpcomingapts();

        $todayapts = auth()->user()->doctorTodayapts();

        $prescriptions = auth()->user()->doctorprescriptions();

        $payments = auth()->user()->doctorpayments();

        $doctor = Doctor::where('user_id', auth()->user()->id)->first();

        $today = Carbon::today();

        return view('doctors.dashboard' , compact('upcomapts', 'todayapts', 'prescriptions', 'payments', 'doctor', 'today'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews(){

        $doctor = Doctor::where('user_id', auth()->user()->id)->first();

        $reviews = $doctor->reviews;

        return view('doctors.reviews', compact('doctor', 'reviews'));
    }

    public function myInvoices(){

        $payments = auth()->user()->doctorpayments();

        return view('doctors.invoices', compact('payments'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword(){

    	return view('doctors.change_password');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function verifCode(){

        return view('doctors.verif_code');
    }

    public function postEmail(Request $request)
    {
        //Validate email field
        $this->validate($request, [
            'email' => 'required',
        ]);

        $email = $request->email;

        $code = Str::upper($this->unique_code(4));

        Mail::to($email)->send(new SendPassChangeCode($code));

        $user = User::findOrFail(auth()->user()->id);

        $user->code = $code;

        $user->save();

        return redirect()->route('doctor_verif_code')
            ->with('success', 'Code bien envoyé, verifiez votre adresse email');

    }

    public function postCode(Request $request)
    {
        //Validate code field
        $this->validate($request, [
            'code' => 'required',
        ]);

        if ($user = User::where('code', '=',$request->code)->first()) {

            $user->code = null;

            $user->save(); 

            return redirect()->route('doctor_confirm_change_password')->with('success', 'Your account has been verified! you can change your password ');
     
        } else {

            return back()->with('error', 'Error Verification!');
        }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function verifEmail(){

        return view('doctors.verif_email');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile($id){

        $doctor = Doctor::findOrFail($id);

        $specialities = Speciality::all();

        $services = $doctor->services;

        return view('doctors.profile', compact('doctor', 'specialities', 'services'));
    }

    public function updatePassword(Request $request)
    {
        //Validate password fields
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id); //Get user specified by id

        if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {

            return back()->with('error', 'Your old password is not correct! Please check!');

        } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {

            return back()->with('error', 'Please enter a password which is not similar then current password.');

        } else {
            //User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);

            $user->password = $request->input('new_password');

            $user->save();

            ///return back()->with('success', 'Password updated successfully.');
            return redirect()->route('doctor_dashboard')->with('success', 'Password updated successfully.');
        }
        //return redirect('profils')->with('success', 'Mot de passe mis à jour');
    }

    public function take($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->status = 1;

        $appointment->confirm_date = Carbon::now();

        $patient = Patient::findOrFail($appointment->patient_id);

        $doctor = Doctor::findOrFail($appointment->doctor_id);

        //$doctor->patients()->attach($patient->id, ['status' => 1]);

        $doctor->patients()->syncWithoutDetaching([$patient->id], ['status' => 1]);

        $appointment->save();

        /*$notification = new Notification();
        $notification->sender_id = auth()->user()->id;
        $notification->body = "Le médecin $appointment->doctor_name $appointment->docor_firstanme a accépté prendre votre rendez-vous du $appointment->date_apt de $appointment->begin_time au $appointment->end_time!";
        $notification->route = route('appointments.show', $appointment->id);
        $notification->status = 0;
        $notification->receiver_id = $appointment->user_id;
        $notification->save();*/

        # code...
        $alert = new Alert();
        $alert->sender_id = $appointment->doctor_user_id;
        $alert->body = "Votre médecin $appointment->doctor->name $appointment->doctor->firstname a accepté vous prendre en RDV. Merci de procéder au paiement des frais pour confirmation";
        //$alert->route = route('orders.show', $order->id);
        $alert->route = route('dashboard');
        $alert->object_id = $appointment->id;
        $alert->object = 'ACCEPTATION DE RDV PAR LE MEDECIN';
        $alert->object_status = 1;
        $alert->status = 0;
        $alert->receiver_id = $appointment->patient_user_id;
        $alert->save();


        return redirect()->route('doctor_my_appointments')
            ->with('success', 'Votre confirmation de rendez-vous a été enregistré avec succès!');
    }

    public function archivedApt(Request $request)
    {
        $appointment = Appointment::findOrFail($request->get('id'));
        $appointment->status = 2;
        $appointment->save();

        # code...
        $alert = new Alert();
        $alert->sender_id = $appointment->doctor_user_id;
        $alert->body = "Le médecin $appointment->doctor->name $appointment->doctor->firstname ne pourra malheureusement pas vous prendre en RDV. Merci de prendre un autre RDV";
        //$alert->route = route('orders.show', $order->id);
        $alert->route = route('dashboard');
        $alert->object_id = $appointment->id;
        $alert->object = 'ANNULATION DE RDV PAR LE MEDECIN';
        $alert->object_status = 2;
        $alert->status = 0;
        $alert->receiver_id = $appointment->patient_user_id;
        $alert->save();

        return $appointment;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setting() {

        $doctor = Doctor::where('user_id',auth()->user()->id)->first();

        $specialities = Speciality::all();

        $services = $doctor->services;
    	
    	return view('doctors.profile_setting', compact('doctor', 'specialities', 'services'));
    }


    public function uploadCropImage(Request $request)
    {
        $doctor = Doctor::findOrFail($request->input('doctor_id'));

        $user = User::findOrFail($doctor->user_id);

        $folderPath = public_path('storage/profile_images/');
 
        $image_parts = explode(";base64,", $request->image);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
 
        $fileNameToStore = uniqid().'.png';
 
        $imageFullPath = $folderPath.$fileNameToStore;
 
        file_put_contents($imageFullPath, $image_base64);
         
        $doctor->profile_picture = $fileNameToStore;

        $user->profile_picture = $fileNameToStore;

        $doctor->save();

        $user->save();

        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }

    public function postSetting(Request $request) {

        $doctor = Doctor::findOrFail($request->input('doctor_id'));

        $user = User::findOrFail($doctor->user_id);

        $data = $request->all();

        //Validate name, email and password fields

        $this->validate($request, [
            'doctor_id' => 'required|max:120',
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            //'email' => 'required|email|unique:users,email,'.$user->id,
            'phone_number' => 'required',
            //'password' => 'required|min:6|confirmed',
        ]);

        if ($request->hasfile('profile_picture')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('profile_picture')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('profile_picture')->storeAs('public/profile_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'avatar.jpg';
        }

        $old_services = DoctorService::where('doctor_id', $doctor->id)
                                        ->get();
    
        if(!$old_services->isEmpty()){
            
            DB::table('doctor_services')->where('doctor_id', $doctor->id)
                                        ->delete();
        }

        $services = [];

        $services = explode(',' , $request->input('services'));

        foreach ($services as $item) {
            # code...
            $service = new DoctorService();

            $service->doctor_id = $doctor->id;
            $service->service_title = $item;
            $service->user_id = $doctor->user_id;
            $service->save();
        }

        $doctor->apt_fees = $request->input('apt_fees');
        $doctor->name = $request->input('name');
        $doctor->firstname = $request->input('firstname');
        //$doctor->email = $request->input('email');
        $doctor->gender = $request->input('gender');
        //$doctor->marital_status = $request->input('marital_status');
        if ($request->hasfile('profile_picture')) {
            $doctor->profile_picture = $fileNameToStore;
        }

        $doctor->phone_number = $request->input('phone_number');
        $doctor->address = $request->input('address');
        //$doctor->region = $request->input('region');
        $region = Region::findOrFail($request->input('region'));
        $doctor->region = $region->title;

        if($request->input('country') != ''){

           $doctor->country = $request->input('country'); 

        }else{

            $doctor->country = $request->input('old_country'); 
        }

        if($doctor->matricule == ''){

            $birth_year = Carbon::parse($request->input('birth_date'))->year;

            $birth_month = Carbon::parse($request->input('birth_date'))->month;

            $birth_day = Carbon::parse($request->input('birth_date'))->day;

            $country = Country::where('title' ,'=', $doctor->country)->first();

            $country_code = Str::upper($country->code);

            //$date = Carbon::parse($doctor->created_at)->toDateString();

            //$timestamp = strtotime($date);

            //$month = date('m', $timestamp);

            $name = Str::of($doctor->name)->substr(0,3)->upper();

            $firstname = Str::of($doctor->firstname)->substr(0,1)->upper();

            $adhesion_year = Carbon::parse($doctor->created_at)->year;

            $doctor->matricule = $country_code.''.$birth_year.''.$birth_month.''.$birth_day.''.$name.''.$firstname.''.$adhesion_year;

            //$doctor->matricule = $country_code.date("y").$month.$name.$firstname;
        }
        

        $doctor->city = $request->input('city');
        $doctor->birth_date = $request->input('birth_date');
        $doctor->place_birth = $request->input('place_birth');
        $doctor->biography = $request->input('biography');
        $doctor->title = $request->input('title');
        $doctor->speciality_id = $request->input('speciality_id');
        //$doctor->nationality = $request->input('nationality');
        //$doctor->profession = $request->input('profession');
        //$doctor->status = $request->input('status');

        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        //$user->email = $request->input('email');
        if ($request->hasfile('profile_picture')) {
            $user->profile_picture = $fileNameToStore;
        }
        
        $user->phone_number = $request->input('phone_number');
        //$user->gender = $request->input('gender');
        //$user->birth_date = $request->input('birth_date');
        $user->address = $request->input('address');

        if($data['clinic_name'] != ''){
            $clinic = Clinic::where('doctor_id', $doctor->id)->first();

            if($clinic){

                $clinic->name = $request->input('clinic_name');
                $clinic->address = $request->input('clinic_address');
                $clinic->doctor_id = $doctor->id;
                $clinic->doctor_userid = $doctor->user_id;
                $clinic->save();

            }else{

                $clinic = new Clinic();
                $clinic->name = $request->input('clinic_name');
                $clinic->address = $request->input('clinic_address');
                $clinic->doctor_id = $doctor->id;
                $clinic->doctor_userid = $doctor->user_id;
                $clinic->save();
            }
        }
        

        $i = 0;
        $j = 0;
        $k = 0;

        /*if (isset($data['awards'])) {

            foreach($data['awards'] as $row){

                $award = new Award();
                $award->awards = $data['awards'][$i];
                $award->year = $data['year'][$i];
                $award->doctor_id = $doctor->id;
                $award->doctor_user_id = $doctor->user_id;

                $award->save();

                $i++;
            }
        }

        if (isset($data['degree'])) {

            foreach($data['degree'] as $row){

                $education = new Education();
                $education->degree = $data['degree'][$j];
                $education->institute = $data['institute'][$j];
                $education->year_completion = $data['year_completion'][$j];
                $education->doctor_id = $doctor->id;
                $education->doctor_user_id = $doctor->user_id;

                $education->save();

                $j++;
            }
        }

        if (isset($data['exercice_place'])) {

            foreach($data['exercice_place'] as $row){

                $experience = new Experience();
                $experience->exercice_place = $data['exercice_place'][$k];
                $experience->from = $data['from'][$k];
                $experience->to = $data['to'][$k];
                $experience->year_completion = $data['year_completion'][$k];
                $experience->doctor_id = $doctor->id;
                $experience->doctor_user_id = $doctor->user_id;

                $experience->save();

                $k++;
            }
        }*/

        $doctor->save();

        $user->save();

        $historique = new History();
        $historique->action = 'Update Doctor Profile';
        $historique->table = 'User/Doctor';
        $historique->user_id = auth()->user()->id;

        $historique->save();

        //Redirect to the users.index view and display message
        return redirect()->back()->with('success', 'Profile Updated successfully.');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function myAppointments() {

        //$upcomapts = auth()->user()->doctorUpcomingapts();
        //$pendingapts = auth()->user()->doctorPendingapts();
        $myallapts = auth()->user()->myallapts();

        return view('doctors.appointments', compact('myallapts'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function myPatients() {

        $doctor = Doctor::where('user_id', auth()->user()->id)->first();

        $mypatients = $doctor->patients;
        
        return view('doctors.my_patients', compact('mypatients'));
    }

    public function start($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->status = 4;

        $appointment->save();

        $drugs = Drug::all();

        $date = Carbon::today();

        return view('doctors.prescriptions.create', compact('appointment', 'drugs', 'date'));
    }

    public function finish($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->status = 5;

        $appointment->save();

        return redirect()->route('doctor_my_appointments')
            ->with('success', 'Appointment closed successfully!');
    }
}
