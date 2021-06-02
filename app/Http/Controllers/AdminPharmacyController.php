<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pharmacy;
use App\Prescription;
use App\Doctor;
use App\Patient;
use App\User;
use App\Region;
use App\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminPharmacyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:pharmacy']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile() 
    {
        $pharmacy = Pharmacy::where('id', auth('pharmacy')->user()->id)->first();

    	return view('pharmacies.admin.profile_setting', compact('pharmacy'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $prescriptions = Prescription::orderBy('created_at', 'desc')
                                        ->get();

        return view('pharmacies.admin.prescriptions', compact('prescriptions'));                           
    }

    public function edit($id)
    {
        $prescription = Prescription::findOrFail($id);

        $prescribeddrugs = $prescription->prescribeddrugs;

        return view('pharmacies.admin.edit_prescription', compact('prescription', 'prescribeddrugs'));                           
    }

    public function show($id)
    {
        $prescription = Prescription::findOrFail($id);

        $prescribeddrugs = $prescription->prescribeddrugs;

        return view('pharmacies.admin.show_prescription', compact('prescription', 'prescribeddrugs'));                           
    }


    public function filterPrescription($id)
    {
        $prescriptions = Prescription::where('patient_id', $id)
                                        ->orderBy('id', 'desc')
                                        ->get();

        return view('pharmacies.admin.patient_prescription', compact('prescriptions'));                           
    }

    public function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      $data = [];
      if($query != '')
      {
       $data = DB::table('patients')
         ->where('matricule', 'like', '%'.$query.'%')
         ->where('name', 'like', '%'.$query.'%')
         ->orWhere('firstname', 'like', '%'.$query.'%')
         ->orWhere('email', 'like', '%'.$query.'%')
         ->orWhere('phone_number', 'like', '%'.$query.'%')
         ->orWhere('address', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();
      }
      /* else
      {
       $data = DB::table('clients')
         ->orderBy('id', 'desc')
         ->limit(10)
         ->get();  

         $data = [];

        
      } */ 

        if(count($data) == 0) {
            $total_row = 0;
        } else {
            $total_row = $data->count();
        } 
      
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
        <td>'.$row->matricule.'</td>
         <td>'.$row->name.'</td>
         <td>'.$row->firstname.'</td>
         <td>'.$row->email.'</td>
         <td>'.$row->phone_number.'</td>
         <td><a href="'.route('patient_prescription.view', $row->id).'" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Voir Prescription</a></td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="6">Pas de Patient trouvé</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }


    public function updateSetting(Request $request, $id)
    {
    	$pharmacy = Pharmacy::findOrFail($id); //Get pharmacy with specified id

        //Validate these fields

        $this->validate($request, [
            'registration' => 'required',
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users,email,'.$pharmacy->user_id,
            'phone_number' => 'required|unique:users,phone_number,'.$pharmacy->user_id,
            'creation_date' => 'required',
            'address' => 'required',
            'region' => 'required',
            'country' => 'nullable',
            'city' => 'required',
            'director_name' => 'required',
            'logo' => 'image|nullable',
            'profile_picture' => 'image|nullable',
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

        if ($request->hasfile('logo')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();

            // Filename to store
            $logoNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('logo')->storeAs('public/pharmacies/logo', $logoNameToStore);
        } else {
            $logoNameToStore = 'logo.jpg';
        }

        $pharmacy->registration = $request->input('registration');
        $pharmacy->name = $request->input('name');
        $pharmacy->email = $request->input('email');
        $pharmacy->biography = $request->input('biography');
        if ($request->hasfile('profile_picture')) {
            $pharmacy->profile_picture = $fileNameToStore;
        }

        if ($request->hasfile('logo')) {
            $pharmacy->logo = $logoNameToStore;
        }

        $pharmacy->phone_number = $request->input('phone_number');
        $pharmacy->address = $request->input('address');
        $region = Region::findOrFail($request->input('region'));
        $pharmacy->region = $region->title;

        if($request->input('country') != ''){
           $pharmacy->country = $request->input('country'); 
        }else{
            $pharmacy->country = $request->input('old_country'); 
        }
        $pharmacy->city = $request->input('city');
        $pharmacy->creation_date = $request->input('creation_date');
        $pharmacy->slogan = $request->input('slogan');
        $pharmacy->director_name = $request->input('director_name');
        $pharmacy->status = 1;

        $user = User::findOrFail($pharmacy->user_id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        //$user->password = 123456;
        if ($request->hasfile('profile_picture')) {
            $user->profile_picture = $fileNameToStore;
        }
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');

        $pharmacy->save();
        $user->save();

        //Redirect back view and display message
        return back()->with('success', 'Profil de la pharmacie mis à jour avec succès.');

    }


    public function updatePassword(Request $request)
    {
        //Validate password fields
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $pharmacy = Pharmacy::findOrFail(auth('pharmacy')->user()->id);

        $user = User::findOrFail($pharmacy->user_id); //Get user specified by id

        if ((Hash::check(request('old_password'), Auth('pharmacy')->user()->password)) == false) {

            return back()->with('error', 'Your old password is not correct! Please check!');

        }elseif((Hash::check(request('new_password'), Auth('pharmacy')->user()->password)) == true) {

            return back()->with('error', 'Please enter a password which is not similar then current password.');

        }else{
            $user->password = $request->input('new_password');

            $pharmacy->password = $request->input('new_password');

            $pharmacy->save();

            $user->save();

            return back()->with('success', 'Password updated successfully.');
            
        }
    }
}
