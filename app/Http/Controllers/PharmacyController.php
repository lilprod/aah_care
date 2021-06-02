<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use App\Country;
use App\User;
use App\Pharmacy;
use App\Speciality;
use App\History;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PharmacyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all pharmacies and pass it to the view
        $pharmacies = Pharmacy::all();
        //$pharmacies = Pharmacy::orderby('id', 'asc')->paginate(8);

        return view('admin.pharmacies.index')->with('pharmacies', $pharmacies);
    }

    public function changeUserStatus(Request $request)
    {
        $pharmacy = Pharmacy::findOrFail($request->pharmacy_id);

        $user = User::where('id', $pharmacy->user_id)->first();
        //$pharmacy->status = $request->status;
        $user->is_activated = $request->status;

        //$pharmacy->save();
        $user->save();
  
        return response()->json(['success'=>'Pharmacy Account status change successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name, email and password fields
        $this->validate($request, [
            'registration' => 'required',
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|unique:users',
            'creation_date' => 'required',
            'address' => 'required',
            'region' => 'required',
            'country' => 'required',
            'city' => 'required',
            'director_name' => 'required',
            'logo' => 'image|required',
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

        $pharmacy = new Pharmacy();
        $pharmacy->registration = $request->input('registration');
        $pharmacy->name = $request->input('name');
        $pharmacy->email = $request->input('email');
        $pharmacy->password = 123456;
        $pharmacy->biography = $request->input('biography');
        $pharmacy->profile_picture = $fileNameToStore;
        $pharmacy->logo = $logoNameToStore;
        $pharmacy->phone_number = $request->input('phone_number');
        $region = Region::findOrFail($request->input('region'));
        $pharmacy->region = $region->title;
        $pharmacy->country = $request->input('country');
        $pharmacy->city = $request->input('city');
        $pharmacy->address = $request->input('address');
        $pharmacy->creation_date = $request->input('creation_date');
        $pharmacy->slogan = $request->input('slogan');
        $pharmacy->director_name = $request->input('director_name');
        $pharmacy->status = $request->input('status');
        $pharmacy->is_activated = $request->input('status');
        $pharmacy->create_user_id = auth()->user()->id;

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = 123456;
        $user->profile_picture = $fileNameToStore;
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->role_id = 4;

        $pharmacy->save();
        $user->save();
        $user->assignRole('Pharmacy');

        $creation_year = Carbon::parse($request->input('creation_date'))->year;

        $creation_month = Carbon::parse($request->input('creation_date'))->month;

        $creation_day = Carbon::parse($request->input('creation_date'))->day;

        $country = Country::where('title' ,'=', $request->input('country'))->first();

        $country_code = Str::upper($country->code);

        $name = Str::of($request->input('name'))->substr(0,3)->upper();

        $pharmacyFinal = Pharmacy::find($pharmacy->id);

        $adhesion_year = Carbon::parse($pharmacyFinal->created_at)->year;

        $pharmacyFinal->matricule = $country_code.''.$creation_year.''.$creation_month.''.$creation_day.''.$name;

        $pharmacyFinal->user_id = $user->id;

        $pharmacyFinal->save();
        
        $historique = new History();

        $historique->action = 'Create';

        $historique->table = 'User/Pharmacy';

        $historique->user_id = auth()->user()->id;

        $pharmacyFinal->save();

        $historique->save();

        //Redirect to the pharmacies.index view and display message
        return redirect()->route('pharmacies.index')
            ->with('success',
             'Nouvelle Pharmacie ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pharmacy = Pharmacy::findOrFail($id); //Get pharmacy with specified id

        return view('admin.pharmacies.show', compact('pharmacy')); //pass pharmacy data to view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pharmacy = Pharmacy::findOrFail($id); //Get pharmacy with specified id

        return view('admin.pharmacies.edit', compact('pharmacy')); //pass pharmacy data to view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $pharmacy->status = $request->input('status');
        $pharmacy->is_activated = $request->input('status');

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
        
        $historique = new History();
        $historique->action = 'Update';
        $historique->table = 'User/Pharmacy';
        $historique->user_id = auth()->user()->id;
        
        $historique->save();

        //Redirect to the pharmacies.index view and display message
        return redirect()->route('pharmacies.index')
            ->with('success',
             'Pharmacie éditée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id); //Get pharmacy with specified id

        $user = User::findOrFail($pharmacy->user_id);

        if ($user->profile_picture != 'avatar.jpg') {
            Storage::delete('public/profile_images/'.$user->profile_picture);
        }

        if ($pharmacy->logo != 'logo.jpg') {
            Storage::delete('public/pharmacies/logo/'.$pharmacy->logo);
        }

        $historique = new History();
        $historique->action = 'Delete';
        $historique->table = 'User/Pharmacy';
        $historique->user_id = auth()->user()->id;

        $user->delete();
        $pharmacy->delete();
        $historique->save();

        return redirect()->route('pharmacies.index')
            ->with('success',
             'Pharmacie supprimée avec succès.');
    }
}
