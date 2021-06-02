<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Region;
use App\Country;
use App\User;
use App\Patient;
use App\Pharmacy;
use App\Doctor;
use App\Clinic;
use App\ClinicImage;
use App\Education;
use App\Experience;
use App\Award;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
     /**
     * Patient Social Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function socialPatientRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'firstname' => 'nullable',
            'email' => 'required|email|unique:users',
            'provider' => 'nullable',
            'provider_id' => 'nullable',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['name'] = $request->input('name');
        $input['firstname'] = $request->input('firstname');
        $input['password'] = Hash::make(123456);
        $input['role_id'] = 1;
        $input['is_activated'] = 1;
        $input['lang'] = 'FR';
        $input['profile_picture'] = 'avatar.jpg';
        $input['provider'] = $request->input('provider');
        $input['provider_id'] = $request->input('provider_id');
        $user = User::create($input);

        $user->assignRole('Patient');

        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->firstname = $request->input('firstname');
        $patient->email = $request->input('email');
        $patient->profile_picture = 'avatar.jpg';
        $patient->user_id = $user->id;
        $patient->status = 0;
        $patient->save();

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['id'] =  $user->id;
        $success['name'] =  $user->name;
        $success['firstname'] =  $user->firstname;
        //$success['address'] =  $user->address;
        //$success['phone_number'] =  $user->phone_number;
        $success['role_id'] =  $user->role_id;
        $success['lang'] =  $user->lang;
        $success['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;
   
        return $this->sendResponse($success, 'Patient inscrit avec succès.');
    }


     /**
     * Doctor Social Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function socialDoctorRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'firstname' => 'nullable',
            'email' => 'required|email|unique:users',
            'provider' => 'nullable',
            'provider_id' => 'nullable',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['name'] = $request->input('name');
        $input['firstname'] = $request->input('firstname');
        $input['password'] = Hash::make(123456);
        $input['role_id'] = 2;
        $input['is_activated'] = 0;
        $input['lang'] = 'FR';
        $input['profile_picture'] = 'avatar.jpg';
        $input['provider'] = $request->input('provider');
        $input['provider_id'] = $request->input('provider_id');
        $user = User::create($input);

        $user->assignRole('Doctor');

        $doctor = new Doctor();
        $doctor->name = $request->input('name');
        $doctor->firstname = $request->input('firstname');
        $doctor->email = $request->input('email');
        $doctor->profile_picture = 'avatar.jpg';
        $doctor->user_id = $user->id;
        $doctor->status = 0;
        $doctor->save();

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['id'] =  $user->id;
        $success['name'] =  $user->name;
        $success['firstname'] =  $user->firstname;
        //$success['address'] =  $user->address;
        //$success['phone_number'] =  $user->phone_number;
        $success['role_id'] =  $user->role_id;
        $success['lang'] =  $user->lang;
        $success['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;
   
        return $this->sendResponse($success, 'Patient Doctor avec succès.');
    }


     /**
     * Social Patient Login api
     *
     * @return \Illuminate\Http\Response
     */
     
    public function socialLoginPatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = User::where('email', $request->input('email'))->first();

        if($user){
            $user = Auth::user(); 

            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['id'] =  $user->id;
            $success['name'] =  $user->name;
            $success['firstname'] =  $user->firstname;
            $success['address'] =  $user->address;
            $success['phone_number'] =  $user->phone_number;
            $success['role_id'] =  $user->role_id;
            $success['lang'] =  $user->lang;
            $success['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;

            return $this->sendResponse($success, 'Utilisateur connecté avec succès.');

        }else{

            return $this->sendError('Unauthorised.', ['error'=>'Utilisateur introuvable !']);
        }

    }

     /**
     * Social Doctor Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function socialLoginDoctor(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user != ''){

            if($user->role_id == $request->role_id){

                if($user->is_activated != 1){
                    $response = [
                        'success' => false,
                        'data'    => $user1,
                        'message' =>'Your account is not activated!',
                    ];
                    return response()->json($response, 200);
                }

                $user = Auth::user(); 

                $success['token'] =  $user->createToken('MyApp')->accessToken; 
                $success['id'] =  $user->id;
                $success['name'] =  $user->name;
                $success['firstname'] =  $user->firstname;
                $success['address'] =  $user->address;
                $success['phone_number'] =  $user->phone_number;
                $success['role_id'] =  $user->role_id;
                $success['lang'] =  $user->lang;
                $success['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;

                return $this->sendResponse($success, 'Utilisateur connecté avec succès.');

                
            }else{ 

                return $this->sendError('Unauthorised.', ['error'=>'Profil non autorisé!']);

            }

        }else{ 

            return $this->sendError('Unauthorised.', ['error'=>'Utilisateur introuvable !']);
        }
    }

    /**
     * Pharmacy Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function registerPharmacy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable|email',
            'phone_number' => 'required|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'registration' => 'required',
            'region' => 'required',
            'country' => 'required',
            'city' => 'required',
            'creation_date' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['name'] = Str::upper($input['name']);
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 4;
        $input['address'] = $request->input('city');
        $input['is_activated'] = 0;
        $input['lang'] = 'FR';
        $input['profile_picture'] = 'avatar.jpg';
        $user = User::create($input);

        $user->assignRole('Pharmacy');

        $pharmacy = new Pharmacy();

        $pharmacy->name = $request->input('name');

        $pharmacy->registration = $request->input('registration');

        $pharmacy->email = $request->input('email');

        $pharmacy->phone_number = $request->input('phone_number');

        $pharmacy->address = $request->input('city');

        $pharmacy->city = $request->input('city');

        $pharmacy->creation_date = $request->input('creation_date');

        $region = Region::findOrFail($request->input('region'));

        $pharmacy->region = $region->title;

        $pharmacy->country = $request->input('country');

        $pharmacy->profile_picture = 'avatar.jpg';

        $pharmacy->logo = 'logo.jpg';

        $pharmacy->user_id = $user->id;

        $pharmacy->status = 0;

        $pharmacy->save();

        //Matricule

        $creation_year = Carbon::parse($request->input('creation_date'))->year;

        $creation_month = Carbon::parse($request->input('creation_date'))->month;

        $creation_day = Carbon::parse($request->input('creation_date'))->day;

        $country = Country::where('title' ,'=', $request->input('country'))->first();

        $country_code = Str::upper($country->code);

        $name = Str::of($request->input('name'))->substr(0,3)->upper();

        $pharmacyFinal = Patient::find($pharmacy->id);

        $adhesion_year = Carbon::parse($pharmacyFinal->created_at)->year;

        $pharmacyFinal->matricule = $country_code.''.$creation_year.''.$creation_month.''.$creation_day.''.$name.''.$adhesion_year;

        $pharmacyFinal->save();

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['id'] =  $user->id;
        $success['name'] =  $user->name;
        $success['address'] =  $user->address;
        $success['phone_number'] =  $user->phone_number;
        $success['role_id'] =  $user->role_id;
        $success['lang'] =  $user->lang;
        $success['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;
   
        return $this->sendResponse($success, 'Pharmacy inscrit avec succès.');
    }

    /**
     * Patient Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function registerPatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'nullable|email',
            'phone_number' => 'required|unique:users',
            'address' => 'nullable',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'region' => 'required',
            'country' => 'required',
            'city' => 'required',
            'birth_date' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['name'] = Str::upper($input['name']);
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 1;
        $input['is_activated'] = 1;
        $input['lang'] = 'FR';
        $input['profile_picture'] = 'avatar.jpg';
        $user = User::create($input);

        /*if ($user) {
            $user->code = $this::sendCodeVerif($user->phone_number);
            $user->save();
        }*/

        $user->assignRole('Patient');

        $patient = new Patient();

        $patient->name = $request->input('name');

        $patient->firstname = $request->input('firstname');

        $patient->email = $request->input('email');

        $patient->phone_number = $request->input('phone_number');

        $patient->address = $request->input('address');

        $patient->city = $request->input('city');

        $patient->birth_date = $request->input('birth_date');

        $region = Region::findOrFail($request->input('region'));

        $patient->region = $region->title;

        $patient->country = $request->input('country');

        $patient->profile_picture = 'avatar.jpg';

        $patient->user_id = $user->id;

        $patient->status = 0;

        $patient->save();

        //Matricule

        $birth_year = Carbon::parse($request->input('birth_date'))->year;

        $birth_month = Carbon::parse($request->input('birth_date'))->month;

        $birth_day = Carbon::parse($request->input('birth_date'))->day;

        $country = Country::where('title' ,'=', $request->input('country'))->first();

        $country_code = Str::upper($country->code);

        $name = Str::of($request->input('name'))->substr(0,3)->upper();

        $firstname = Str::of($request->input('firstname'))->substr(0,1)->upper();

        $patientFinal = Patient::find($patient->id);

        $adhesion_year = Carbon::parse($patientFinal->created_at)->year;

        $patientFinal->matricule = $country_code.''.$birth_year.''.$birth_month.''.$birth_day.''.$name.''.$firstname.''.$adhesion_year;

        $patientFinal->save();

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['id'] =  $user->id;
        $success['name'] =  $user->name;
        $success['address'] =  $user->address;
        $success['phone_number'] =  $user->phone_number;
        $success['role_id'] =  $user->role_id;
        $success['lang'] =  $user->lang;
        $success['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;
   
        return $this->sendResponse($success, 'Patient inscrit avec succès.');
    }

    /**
     * Doctor Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function registerDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'nullable|email',
            'phone_number' => 'required|unique:users',
            'address' => 'nullable',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'region' => 'required',
            'country' => 'required',
            'city' => 'required',
            'birth_date' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['name'] = Str::upper($input['name']);
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 2;
        //$input['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/avatar.jpg';
        $input['profile_picture'] = 'avatar.jpg';
        $input['lang'] = 'FR';
        $input['is_activated'] = 0;
        $user = User::create($input);

        /*if ($user) {
            $user->code = $this::sendCodeVerif($user->phone_number);
            $user->save();
        }*/

        $user->assignRole('Doctor');

        $doctor = new Doctor();
        $doctor->name = $request->input('name');
        $doctor->firstname = $request->input('firstname');
        $doctor->email = $request->input('email');
        $doctor->phone_number = $request->input('phone_number');
        $doctor->address = $request->input('address');
        $doctor->city = $request->input('city');

        $doctor->birth_date = $request->input('birth_date');

        $region = Region::findOrFail($request->input('region'));

        $doctor->region = $region->title;

        $doctor->country = $request->input('country');
        $doctor->status = 0;
        $doctor->profile_picture = 'avatar.jpg';
        $doctor->user_id = $user->id;
        $doctor->save();

        //Matricule

        $birth_year = Carbon::parse($request->input('birth_date'))->year;

        $birth_month = Carbon::parse($request->input('birth_date'))->month;

        $birth_day = Carbon::parse($request->input('birth_date'))->day;

        $country = Country::where('title' ,'=', $request->input('country'))->first();

        $country_code = Str::upper($country->code);

        $name = Str::of($request->input('name'))->substr(0,3)->upper();

        $firstname = Str::of($request->input('firstname'))->substr(0,1)->upper();

        $doctorFinal = Patient::find($doctor->id);

        $adhesion_year = Carbon::parse($doctorFinal->created_at)->year;

        $doctorFinal->matricule = $country_code.''.$birth_year.''.$birth_month.''.$birth_day.''.$name.''.$firstname.''.$adhesion_year;

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['id'] =  $user->id;
        $success['name'] =  $user->name;
        $success['firstname'] =  $user->firstname;
        $success['address'] =  $user->address;
        $success['phone_number'] =  $user->phone_number;
        $success['role_id'] =  $user->role_id;
        $success['lang'] =  $user->lang;
        $success['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;
   
        return $this->sendResponse($success, 'Médecin inscrit avec succès.');
    }

    /**
     * Verif Patient Profile
     *
     * @return \Illuminate\Http\Response
     */

    public function verifPatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user_id = $request->user_id;

        $patient = Patient::where('user_id', $user_id)->first();

        if($patient->status == 1){

            $success = true;

            return $this->sendResponse($success, 'Le profil du patient est complet');

        }else{

            $success = false;

            return $this->sendResponse($success, 'Le profil du patient est incomplet');
        }  
    }

    /**
     * Verif Doctor Profile
     *
     * @return \Illuminate\Http\Response
     */

    public function verifDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user_id = $request->user_id;

        $doctor = Doctor::where('user_id', $user_id)->first();

        if($doctor->status == 1){

            $success = true;

            return $this->sendResponse($success, 'Le profil du Médecin est complet');

        }else{

            $success = false;

            return $this->sendResponse($success, 'Le profil du Médecin est incomplet');
        }
    }

    public function updatephone(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old_phoneNumber' => 'required',
            'phone_number' => 'required|unique:users',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = User::where('phone_number', $request->old_phoneNumber)->first();

        if($user == ''){

            return $this->sendError('Le numéro de téléphone de cet utilisateur est introuvable!');

        }elseif(($user != '') && ($user->phone_number == $request->phone_number)){

            return $this->sendError('Le numéro de téléphone saisi est le même que l\'ancien! Veuillez renseigner un autre numéro');

        }else{

            $user->phone_number = $request->phone_number;

            $user->save();

                $response = [
                    'success' => true,
                    'data'    => $user,
                    'message' =>'Numéro de téléphone mis à jour!',
                ];

                return response()->json($response, 200);
        }

    }
    
    public function updatelang(Request $request)
    {
        // Get current user
        $userId = Auth::guard('api')->user()->id;
        $user = User::findOrFail($userId);

        // Validate the data submitted by user
        $validator = Validator::make($request->all(), [
            'lang' => 'required|max:255',
        ]);

        // if fails redirects back with errors
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
            
        }
        
        $user->lang = $request->lang;
        
        $user->save();
        
        $success= true;

        return $this->sendResponse($success, 'Langue éditée avec succès.');
    }

    public function postVerify(Request $request)
    {
        $user = User::where('code', $request->code)->first();
        
        if ($user) {
            
            $user->is_activated = 1;
            $user->code = null;
            $user->save();

            $success= true;

            return $this->sendResponse($success, 'Vérification du numero effectuée avec succès.');
        } else {
            return $this->sendError('Vérification echouée!');
        }
    }

    public function postCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user) {
            $user->code = $this::sendCodeVerif($user->phone_number);
            $user->save();
            $success= true;

            return $this->sendResponse($success, 'Code de vérification envoyé avec succès.');
        }else{
            return $this->sendError('Le numéro de téléphone de cet utilisateur est introuvable!');
        }
    }

    public static function sendCodeVerif($phone_number)
    {
        $code = rand(1111, 9999);
        //Mail::to($email)->send(new SendMailable($code));

        $basic = new \Nexmo\Client\Credentials\Basic('81de9211', '2uK4uXgfutl3LgtC');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '+'.$phone_number,
            'from' => '14373703901',
            'text' => 'Votre code de confirmation de DOMINION est : '.$code,
        ]);

        return $code;
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
     
    public function loginPatient(Request $request)
    {
        if(Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password])){ 
            $user = Auth::user(); 

            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['id'] =  $user->id;
            $success['name'] =  $user->name;
            $success['firstname'] =  $user->firstname;
            $success['address'] =  $user->address;
            $success['phone_number'] =  $user->phone_number;
            $success['role_id'] =  $user->role_id;
            $success['lang'] =  $user->lang;
            $success['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;

            return $this->sendResponse($success, 'Utilisateur connecté avec succès.');

        }else{ 

            return $this->sendError('Unauthorised.', ['error'=>'Informations de connexion incorrectes!']);
        }

    }


    public function loginDoctor(Request $request)
    {
        $user1 = User::where('phone_number', $request->phone_number)->first();

        if(($user1 != '') && ($user1->role_id == $request->role_id)){

            if($user1->is_activated != 1){

                $response = [
                    'success' => false,
                    'data'    => $user1,
                    'message' =>'Your account is not activated!',
                ];
                return response()->json($response, 200);
            }

            if(Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password])){ 


                $user = Auth::user(); 

                $success['token'] =  $user->createToken('MyApp')->accessToken; 
                $success['id'] =  $user->id;
                $success['name'] =  $user->name;
                $success['firstname'] =  $user->firstname;
                $success['address'] =  $user->address;
                $success['phone_number'] =  $user->phone_number;
                $success['role_id'] =  $user->role_id;
                $success['lang'] =  $user->lang;
                $success['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;

                return $this->sendResponse($success, 'Utilisateur connecté avec succès.');

                }else{ 

                    return $this->sendError('Unauthorised.', ['error'=>'Informations de connexion incorrectes!']);
                }
                
            }else{ 

                return $this->sendError('Unauthorised.', ['error'=>'Profil non autorisé!']);

            }
    }


    public function resetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'phone_number' => 'required',

        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = User::where('phone_number', $request->phone_number)->first();

        $password = '';
        
        if($user){

            //$user->password = Hash::make($this::sendCode($user->phone_number));
            $password = $this::sendCode($user->phone_number);
            
            User::where('id', $user->id)->update(['password' => Hash::make($password)]);
            
            //$user->password = $password;

            //$user->save();

            $success = true;

            return $this->sendResponse($success, 'Mot de passe réinitialisé avec succès.');

        }else{

            $response = [
                'success' => false,
                'data'    => [],
                'message' =>'Phone number not found!',
            ];

            return response()->json($response, 200); 

            //return $this->sendError('Unauthorised.', ['error'=>'This User not exist in the database']);
        } 
    }

    public static function sendCode($phone_number)
    {
        $code = rand(1111, 9999);
        //Mail::to($email)->send(new SendMailable($code));

        $basic = new \Nexmo\Client\Credentials\Basic('81de9211', '2uK4uXgfutl3LgtC');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '+'.$phone_number,
            'from' => '14373703901',
            'text' => 'Votre nouveau mot de passe de DOMINION est : '.$code,
        ]);

        return $code;
    }

    public function checkemail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user == ''){

            return $this->sendResponse([], 'Email accepted.');

        }else{

            $response = [
                'success' => false,
                'data'    => $user,
                'message' =>'Email already exist!',
            ];
            return response()->json($response, 200);
        }

    } 

    public function checkphone(Request $request)
    {
        $user = User::where('phone_number', $request->phone_number)->first();

        if($user == ''){

            return $this->sendResponse([], 'Phone number accepted.');

        }else{
            $response = [
                'success' => false,
                'data'    => $user,
                'message' =>'Phone number already exist!',
            ];
            return response()->json($response, 200);
        }

    }

    public function checkpatient(Request $request)
    {
        $user = User::where('role_id', $request->role_id)->first();

        if($user->role_id == 1){
            return $this->sendResponse([], 'Connexion accepted.');
        }else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }

    } 

    public function checkdoctor(Request $request)
    {
        $user = User::where('role_id', $request->role_id)->first();

        if($user->role_id == 2){
            return $this->sendResponse([], 'Connexion accepted.');
        }else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }

    } 

    public function postToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'firebase_token' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = User::where('id', $request->user_id)->first();

        $user->firebase_token = $request->firebase_token;
        $user->save();
        $success = true;
        return $this->sendResponse($success, 'Utilisateur connecté avec succès.');
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        $success = 'true';

        return $this->sendResponse($success, 'Utilisateur déconnecté avec succès.');
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        //return response()->json($request->user());

        $user = $request->user();

        if($user->role_id == 1){

            $patient = Patient::where('user_id', $user->id)->first();

            $user['gender'] = $patient->gender;
            $user['marital_status'] = $patient->marital_status;
            $user['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$patient->profile_picture;
            $user['address'] = $patient->address;
            $user['birth_date'] = $patient->birth_date;
            $user['place_birth'] = $patient->place_birth;
            //$user['nationality'] = $patient->nationality;
            //$user['ethnic_group'] = $patient->ethnic_group;
            $user['blood_group'] = $patient->blood_group;
            $user['rhesus'] = $patient->rhesus;
            //$user['profession'] = $patient->profession;

            return $this->sendResponse($user, 'Infos de l\' utilisateur');

        }else{

            $doctor = Doctor::where('user_id', $user->id)->first();

            $user['gender'] = $doctor->gender;
            //$user['marital_status'] = $doctor->marital_status;
            $user['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$doctor->profile_picture;
            $user['address'] = $doctor->address;
            $user['region'] = $doctor->region;
            $user['country'] = $doctor->country;
            $user['city'] = $doctor->city;
            $user['birth_date'] =$doctor->birth_date;
            $user['place_birth'] = $doctor->place_birth;
            $user['biography'] = $doctor->biography;
            if($doctor->speciality != ''){
               $speciality = $doctor->speciality;
               $speciality['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$speciality->cover_image;
               $user['speciality'] = $speciality;
            }
            $user['rating'] = $doctor->averageRating;
            //$user['nationality'] = $doctor->nationality;
            //$user['profession'] = $doctor->profession;
            return $this->sendResponse($user, 'Infos de l\' utilisateur');
        }

        //return $this->sendResponse($user, 'Infos de l\' utilisateur');
    }


    //change password api
    public function change_password(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return response()->json($arr);
    }

    //forgot_password
    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => "required|email",
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return response()->json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return response()->json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return response()->json($arr);
    }

    public function update_profile(Request $request)
    {
        // Get current user
        $userId = Auth::guard('api')->user()->id;
        $user = User::findOrFail($userId);

        // Validate the data submitted by user
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'firstname' => 'required|max:255',
            'email' => 'nullable',
            'address' => 'nullable',
            ///'phone_number' => 'nullable|number|unique:users',
        ]);

        // if fails redirects back with errors
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        // Fill user model
        $user->fill([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'address' => $request->address
        ]);

        if($user->role_id == 1){
            $patient = Patient::where('user_id', $user->id)
                            ->first();
            $patient->name = $request->name;
            $patient->firstname = $request->firstname;
            $patient->email =  $request->email;
            $patient->address = $request->address;
        
            $patient->save();

        }elseif($user->role_id == 2){

            $doctor = Doctor::where('user_id', $user->id)
                                    ->first();

            //$doctor->gender = $request->input('gender');
            //$doctor->marital_status = $request->input('marital_status');
            //$doctor->country = $request->input('country');
            //$doctor->city = $request->input('city');
            //$doctor->birth_date = $request->input('birth_date');
            //$doctor->place_birth = $request->input('place_birth');
            //$doctor->biography = $request->input('biography');
            //$doctor->nationality = $request->input('nationality');
            //$doctor->profession = $request->input('profession');

            $doctor->name = $request->name;
            $doctor->firstname = $request->firstname;
            $doctor->email =  $request->email;
            $doctor->address = $request->address;


           
            $doctor->save();

        }

        $success = true;
        // Save user to database
        $user->save();
        // Redirect to route
        return $this->sendResponse($success, 'Profil édité avec succès.');
    }

    public function update_picture(Request $request)
    {
        $userId = Auth::guard('api')->user()->id;

        $user = User::findOrFail($userId);

        // Validate the data submitted by user
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'image|required',
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

        // if fails redirects back with errors
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if($user->role_id == 1){

            $patient = Patient::where('user_id', $user->id)->first();

            $patient->profile_picture = $fileNameToStore;
        
            $patient->save();

        }elseif($user->role_id == 2){

            $doctor = Doctor::where('user_id', $user->id)->first();

            $doctor->profile_picture = $fileNameToStore;
           
            $doctor->save();
        }

        // Save user to database
        $user->profile_picture = $fileNameToStore;

        $user->save();

        //$success = true;
        // Send response
        return $this->sendResponse($fileNameToStore, 'Photo de profil éditée avec succès.');
    }

    public function delete_picture(Request $request)
    {
        $userId = Auth::guard('api')->user()->id;

        $user = User::findOrFail($userId);

        $fileNameToStore = 'avatar.jpg';
      
        if($user->role_id == 1){

            $patient = Patient::where('user_id', $user->id)->first();

            $patient->profile_picture = $fileNameToStore;
        
            $patient->save();

        }elseif($user->role_id == 2){

            $doctor = Doctor::where('user_id', $user->id)->first();

            $doctor->profile_picture = $fileNameToStore;
           
            $doctor->save();

        }

        // Save user to database
        $user->profile_picture = $fileNameToStore;

        $user->save();

        //$success = true;
        // Send response
        return $this->sendResponse($fileNameToStore, 'Photo de profil supprimée avec succès.');
    }

    public function generateIdentifier()
    {
        //$randomString = str_random(25);

        //$uniqid = Str::random(9);

        $uniqid = $this->unique_code(9);

        $response = [
            'success' => true,
            'identifier'    => $uniqid,
            'message' =>'Identifier retreive successfully!',
        ];
        return response()->json($response, 200);
    }

    /*public function getIdentifier(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'order_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $order = Order::findOrFail($input['order_id']);

        $response = [
            'success' => true,
            'identifier'    => $order->identifier,
            'message' =>'Order identifier retreive successfully!',
        ];

        return response()->json($response, 200);
    }


    public function postIdentifier(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'order_id' => 'required',
            'identifier' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $order = Order::findOrFail($input['order_id']);
        $order->identifier = $request->identifier;
        $order->save();

        $response = [
            'success' => true,
            'data'    => $order,
            'message' =>'Order identifier add successfully!',
        ];

        return response()->json($response, 200);
    }*/

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
