<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;

use App\Region;
use App\Country;
use App\User;
use App\Supplier;
use App\Speciality;
use App\History;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:pharmacy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get pharmacy's suppliers and pass it to the view

        //$suppliers = Supplier::all();

        $pharmacy = auth('pharmacy')->user();

        $suppliers = $pharmacy->suppliers;

        return view('pharmacies.admin.suppliers.index')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pharmacies.admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate these fields
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|',
            'phone_number' => 'required',
            'address' => 'required',
            'country' => 'nullable',
            'city' => 'required',
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

        $supplier = new Supplier();

        $supplier->name = $request->input('name');
        //$supplier->firstname = $request->input('firstname');
        $supplier->email = $request->input('email');
        $supplier->biography = $request->input('biography');
        $supplier->profile_picture = $fileNameToStore;
        $supplier->phone_number = $request->input('phone_number');
        $supplier->address = $request->input('address');
        $supplier->country = $request->input('country'); 
        $supplier->city = $request->input('city');
        $supplier->status = $request->input('status');
        $supplier->pharmacy_id = auth('pharmacy')->user()->id;

        $supplier->save();

        
        $historique = new History();
        $historique->action = 'Create';
        $historique->table = 'Supplier';
        $historique->user_id = auth('pharmacy')->user()->id;
        
        $historique->save();

        //Redirect to the suppliers.index view and display message
        return redirect()->route('suppliers.index')
            ->with('success',
             'Fournisseur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('pharmacies.admin.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('pharmacies.admin.suppliers.edit', compact('supplier'));
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
        $supplier = Supplier::findOrFail($id);

        //Validate these fields
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|',
            'phone_number' => 'required',
            'address' => 'required',
            'country' => 'nullable',
            'city' => 'required',
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

        $supplier->name = $request->input('name');
        //$supplier->firstname = $request->input('firstname');
        $supplier->email = $request->input('email');
        $supplier->biography = $request->input('biography');
        if ($request->hasfile('profile_picture')) {
            $supplier->profile_picture = $fileNameToStore;
        }

        $supplier->phone_number = $request->input('phone_number');
        $supplier->address = $request->input('address');
        $supplier->country = $request->input('country'); 
        $supplier->city = $request->input('city');
        $supplier->status = $request->input('status');
        $supplier->pharmacy_id = auth('pharmacy')->user()->id;

        $supplier->save();

        
        $historique = new History();
        $historique->action = 'Update';
        $historique->table = 'Supplier';
        $historique->user_id = auth('pharmacy')->user()->id;
        
        $historique->save();

        //Redirect to the suppliers.index view and display message
        return redirect()->route('suppliers.index')
            ->with('success',
             'Fournisseur édité avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        if ($supplier->profile_picture != 'avatar.jpg') {
            Storage::delete('public/profile_images/'.$supplier->profile_picture);
        }

        $historique = new History();
        $historique->action = 'Delete';
        $historique->table = 'Supplier';
        $historique->user_id = auth('pharmacy')->user()->id;

        $supplier->delete();
        $historique->save();

        return redirect()->route('suppliers.index')
            ->with('success',
             'Fournisseur supprimé avec succès.');
    }
}
