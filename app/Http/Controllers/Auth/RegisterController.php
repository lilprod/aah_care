<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Admin;
use App\Doctor;
use App\Patient;
use App\Pharmacy;
use App\Speciality;
use App\Region;
use App\Country;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /*use RegistersUsers {
     // change the name of the name of the trait's method in this class
     // so it does not clash with our own register method
        register as registration;
    }*/

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->middleware('guest:pharmacy');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user) ?: redirect('/verify?email='.$request->email.'&phone_number='.$request->phone_number);
    }

    /*public function register(Request $request)
    {
        //Validate the incoming request using the already included validator method
        $this->validator($request->all())->validate();

        // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // Save the registration data in an array
        $registration_data = $request->all();

        // Add the secret key to the registration data
        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();

        //$registration_data["google2fa_enable"] = 1;

        // Save the registration data to the user session for just the next request
        $request->session()->flash('registration_data', $registration_data);

        // Generate the QR image. This is the image the user will scan with their app
     // to set up two factor authentication
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $registration_data['email'],
            $registration_data['google2fa_secret']
        );

        // Pass the QR barcode image to our view
        return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registration_data['google2fa_secret']]);
    }*/

    /*public function completeRegistration(Request $request)
    {        
        // add the session data back to the request input
        $request->merge(session('registration_data'));

        // Call the default laravel authentication
        return $this->registration($request);
    }*/

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:8', 'unique:users'],
            'address' => ['nullable', 'string'],
            'city' => ['required', 'string'],
            'birth_date' => ['required'],
            //'username' => ['nullable', 'string'],
        ]);
    }


    public static function sendCode($email, $phone_number)
    {
        $code = rand(1111, 9999);
        Mail::to($email)->send(new SendMailable($code));

        /*$basic = new \Nexmo\Client\Credentials\Basic('81de9211', '2uK4uXgfutl3LgtC');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => $phone_number,
            'from' => '14373703901',
            'text' => 'Code de Vérification: '.$code,
        ]);*/

        return $code;
    }


    /*public function showPatientRegisterForm()
    {
        return view('auth.register', ['url' => 'patient']);
    }*/

    public function showDoctorRegisterForm()
    { 
        $specialities = Speciality::all();

        return view('auth.register_doctor', ['url' => 'doctor', 'specialities' => $specialities ]);
    }


    public function showPharmacyRegisterForm()
    {
        return view('auth.register_pharmacy', ['url' => 'pharmacy']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
         
         $fileNameToStore = 'avatar.jpg';

         $user = User::create([
            'name' => $data['name'],
            'firstname' => $data['firstname'],
            //'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'],
            'address' => $data['city'],
            'profile_picture' => 'avatar.jpg',
            //'google2fa_secret' => $data['google2fa_secret'],
            //'google2fa_enable' => $data['google2fa_enable'],
            'role_id' => 1,
            'is_activated' => 0,
            'lang' => 'FR',
        ]);

        $user->assignRole('Patient');

        $patient = new Patient();

        $patient->name = $data['name'];

        $patient->firstname = $data['firstname'];

        //$patient->username = $data['username'];

        $patient->email = $data['email'];

        $patient->phone_number = $data['phone_number'];

        $patient->address = $data['city'];

        $patient->city = $data['city'];

        $patient->birth_date = $data['birth_date'];

        $patient->profile_picture = 'avatar.jpg';

        $patient->user_id = $user->id;

        $patient->status = 0;

        $patient->country = $data['country'];

        $patient->save();

        $birth_year = Carbon::parse($data['birth_date'])->year;

        $birth_month = Carbon::parse($data['birth_date'])->month;

        $birth_day = Carbon::parse($data['birth_date'])->day;

        $country = Country::where('title' ,'=', $data['country'])->first();

        $country_code = Str::upper($country->code);

        $date = Carbon::today()->toDateString();

        $timestamp = strtotime($date);

        $month = date('m', $timestamp);

        $name = Str::of($data['name'])->substr(0,3)->upper();

        $firstname = Str::of($data['firstname'])->substr(0,1)->upper();

        $patientFinal = Patient::find($patient->id);

        $adhesion_year = Carbon::parse($patientFinal->created_at)->year;

        //$patient->matricule = $country_code.'-'.date("y").'-'.$month.'-'.$name.'-'.$firstname.'-'.$adhesion_year;

        $patientFinal->matricule = $country_code.''.$birth_year.''.$birth_month.''.$birth_day.''.$name.''.$firstname.''.$adhesion_year;

        $patientFinal->save();

        if ($user) {
            $user->code = $this::sendCode($user->email, $user->phone_number);
            $user->save();
        }

        return $user;
       
    }

    protected function validatorDoctor(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:8'],
            //'address' => ['required', 'string'],
            //'username' => ['nullable', 'string'],
            //'title' => ['required', 'string'],
            //'gender' => ['required'],
            //'place_birth' => ['required', 'string'],
            //'nationality' => ['required'],
            //'marital_status' => ['required'],
            //'speciality_id' => ['required'],
            'city' => ['required', 'string'],
            'birth_date' => ['required'],
            'region' => ['required'],
            'country' => ['required', 'string'],
            'exercice_place' => ['required', 'string'],
        ]);
    }


    protected function registerDoctor(Request $request)
    {
        $this->validatorDoctor($request->all())->validate();

        event(new Registered($user = $this->createDoctor($request->all())));

        return $this->registered($request, $user) ?: redirect('/verify?email='.$request->email.'&phone_number='.$request->phone_number);
    }

    protected function registerPharmacy(Request $request)
    {
        $this->validatorPharmacy($request->all())->validate();

        event(new Registered($user = $this->createPharmacy($request->all())));

        return $this->registered($request, $user) ?: redirect('/verify?email='.$request->email.'&phone_number='.$request->phone_number);
    }

    protected function validatorPharmacy(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:8'],
            //'address' => ['required', 'string'],
            //'username' => ['nullable', 'string'],
            'registration' => ['required', 'string'],
            'city' => ['required', 'string'],
            'creation_date' => ['required'],
            'region' => ['required'],
            'country' => ['required', 'string'],
        ]);
    }


    protected function createPharmacy(array $data)
    {
        //$this->validatorPharmacy($request->all())->validate();

        $fileNameToStore = 'avatar.jpg';

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'],
            'address' => $data['city'],
            'profile_picture' => $fileNameToStore,
            'role_id' => 4,
            'is_activated' => 0,
            'lang' => 'FR',
        ]);

        $user->assignRole('Pharmacy');

        $pharmacy = new Pharmacy();

        $pharmacy->name = $data['name'];

        $pharmacy->email = $data['email'];

        $pharmacy->phone_number = $data['phone_number'];

        $pharmacy->password = $data['password'];

        $pharmacy->profile_picture = $fileNameToStore;

        //$pharmacy->username = $data['username'];

        $pharmacy->address = $data['city'];

        $pharmacy->creation_date = $data['creation_date'];

        $region = Region::findOrFail($data['region']);

        $pharmacy->region = $region->title;

        $pharmacy->country = $data['country'];

        $pharmacy->registration = $data['registration'];

        //$pharmacy->exercice_place = $data['exercice_place'];

        $pharmacy->city = $data['city'];

        $pharmacy->logo = $fileNameToStore;

        $pharmacy->user_id = $user->id;

        $pharmacy->status = 0;

        $pharmacy->save(); 

        $creation_year = Carbon::parse($data['creation_date'])->year;

        $creation_month = Carbon::parse($data['creation_date'])->month;

        $creation_day = Carbon::parse($data['creation_date'])->day;

        $country = Country::where('title' ,'=', $data['country'])->first();

        $country_code = Str::upper($country->code);

        $name = Str::of($data['name'])->substr(0,3)->upper();

        $pharmacyFinal = Pharmacy::find($pharmacy->id);

        $adhesion_year = Carbon::parse($pharmacyFinal->created_at)->year;

        $pharmacyFinal->matricule = $country_code.''.$creation_year.''.$creation_month.''.$creation_day.''.$name;

        $pharmacyFinal->save();

        if ($user) {
            $user->code = $this::sendCode($user->email, $user->phone_number);
            $user->save();
        }

        return $user;

        return redirect()->intended('login/pharmacy');
    }


    protected function createDoctor(array $data)
    {
        //$this->validatorDoctor($request->all())->validate();

        $fileNameToStore = 'avatar.jpg';

        $user = User::create([
            'name' => $data['name'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'],
            'address' => $data['city'],
            'profile_picture' => $fileNameToStore,
            'role_id' => 2,
            'is_activated' => 0,
            'lang' => 'FR',
        ]);

        $user->assignRole('Doctor');

        $doctor = new Doctor();

        $doctor->name = $data['name'];

        $doctor->firstname = $data['firstname'];

        $doctor->email = $data['email'];

        $doctor->phone_number = $data['phone_number'];
        //$doctor->username = $data['username'];
        $doctor->address = $data['city'];
        //$doctor->title = $data['title'];
        //$doctor->gender = $data['gender'];
        //$doctor->place_birth = $data['place_birth'];
        //$doctor->nationality = $data['nationality'];
        //$doctor->speciality_id =$data['speciality_id'];
        $doctor->birth_date = $data['birth_date'];

        $region = Region::findOrFail($data['region']);

        $doctor->region = $region->title;

        $doctor->country = $data['country'];

        $doctor->exercice_place = $data['exercice_place'];

        $doctor->city = $data['city'];

        $doctor->profile_picture = $fileNameToStore;

        $doctor->user_id = $user->id;

        $doctor->status = 0;

        //$date = Carbon::today()->toDateString();

        //$timestamp = strtotime($date);

        //$month = date('m', $timestamp);

        //$doctor->matricule = $country_code.date("y").$month.$name.$firstname;

        $doctor->save(); 

        $birth_year = Carbon::parse($data['birth_date'])->year;

        $birth_month = Carbon::parse($data['birth_date'])->month;

        $birth_day = Carbon::parse($data['birth_date'])->day;

        $country = Country::where('title' ,'=', $data['country'])->first();

        $country_code = Str::upper($country->code);

        $name = Str::of($data['name'])->substr(0,3)->upper();

        $firstname = Str::of($data['firstname'])->substr(0,1)->upper();

        $doctorFinal = Doctor::find($doctor->id);

        $adhesion_year = Carbon::parse($doctorFinal->created_at)->year;

        $doctorFinal->matricule = $country_code.''.$birth_year.''.$birth_month.''.$birth_day.''.$name.''.$firstname.''.$adhesion_year;

        $doctorFinal->save();

        if ($user) {
            $user->code = $this::sendCode($user->email, $user->phone_number);
            $user->save();
        }

        return $user;

        return redirect()->intended('login');
    }



    /*protected function createDoctor(Request $request)
    {
        $this->validatorDoctor($request->all())->validate();

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

        $fileNameToStore = 'avatar.jpg';

        $user = User::create([
            'name' => $request['name'],
            'firstname' => $request['firstname'],
            'email' => $request['email'],
            'password' => $request['password'],
            'phone_number' => $request['phone_number'],
            'address' => $data['city'],
            'profile_picture' => $fileNameToStore,
            'role_id' => 2,
            'is_activated' => 0,
            'lang' => 'FR',
        ]);

        $user->assignRole('Doctor');

        $doctor = new Doctor();
        $doctor->name = $request['name'];
        $doctor->firstname = $request['firstname'];
        //$doctor->username = $request['username'];
        $doctor->email = $request['email'];
        $doctor->phone_number = $request['phone_number'];
        $doctor->address = $request['city'];
        //$doctor->title = $request['title'];
        //$doctor->gender = $request['gender'];
        $doctor->birth_date = $request['birth_date'];
        //$doctor->place_birth = $request['place_birth'];
        //$doctor->nationality = $request['nationality'];
        //$doctor->speciality_id =$request['speciality_id'];
        $region = Region::findOrFail($request['region']);
        $doctor->region = $region->title;
        $doctor->country =$request['country'];
        $doctor->exercice_place =$request['exercice_place'];
        $doctor->city =$request['city'];
        $doctor->profile_picture = $fileNameToStore;
        $doctor->user_id = $user->id;
        $doctor->status = 0;

        //$date = Carbon::today()->toDateString();

        //$timestamp = strtotime($date);

        //$month = date('m', $timestamp);

        //$doctor->matricule = $country_code.date("y").$month.$name.$firstname;

        $doctor->save();

        $birth_year = Carbon::parse($data['birth_date'])->year;

        $birth_month = Carbon::parse($data['birth_date'])->month;

        $birth_day = Carbon::parse($data['birth_date'])->day;

        $country = Country::where('title' ,'=', $request['country'])->first();

        $country_code = Str::upper($country->code);

        $name = Str::of($request['name'])->substr(0,3)->upper();

        $firstname = Str::of($request['firstname'])->substr(0,1)->upper();

        $doctorFinal = Doctor::find($doctor->id);

        $adhesion_year = Carbon::parse($doctorFinal->created_at)->year;

        $doctorFinal->matricule = $country_code.'-'.$birth_year.'-'.$birth_month.'-'.$birth_day.'-'.$name.'-'.$firstname.'-'.$adhesion_year;

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...

            // initialise the 2FA class
            $google2fa = app('pragmarx.google2fa');

            // generate a new secret key for the user
            $user->google2fa_secret = $google2fa->generateSecretKey();

            // save the user
            $user->save();

            // generate the QR image
            $QR_Image = $google2fa->getQRCodeInline(
                config('app.name'),
                $user->email,
                $user->google2fa_secret
            );

            // Pass the QR barcode image to our view.
            return view('google2fa.2fa_settings', ['user' => $user,
                                            'QR_Image' => $QR_Image, 
                                            'secret' => $user->google2fa_secret
                                        ]);
        }

        //return redirect()->intended('login');
    }*/
}
