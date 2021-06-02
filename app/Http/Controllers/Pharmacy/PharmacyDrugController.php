<?php

namespace App\Http\Controllers\Pharmacy;


use App\User;
use App\PharmacyDrug;
use App\Drug;
use App\DrugType;
use App\Speciality;
use App\History;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PharmacyDrugController extends Controller
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
        //Get pharmacy's drugs and pass it to the view

        $pharmacy = auth('pharmacy')->user();

        $drugs = $pharmacy->drugs;

        return view('pharmacies.admin.drugs.index')->with('drugs', $drugs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drugs = Drug::all();

        $drugtypes = DrugType::all(); //Get all drugtypes

        return view('pharmacies.admin.drugs.create', compact('drugs', 'drugtypes'));
    }

    public function storeDrug(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'generic_name' => 'required',
            'short_note' => 'nullable',
            'drug_type_id' => 'nullable',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $drug = new Drug(); 

        $drug->name = $request->input('name');
        $drug->generic_name = $request->input('generic_name');
        $drug->short_note = $request->input('short_note');
        $drug->drug_type_id = $request->input('drug_type_id');

        $drug->save();

        if($request->input('add') == 1){
            return redirect()->route('pharmacydrugs.create')
            ->with('success',
             'Drug added successfully.');
        }else{
            return redirect()->route('pharmacydrugs.edit', $request->input('entity'))
            ->with('success',
             'Drug added successfully.');

        }

        //return redirect()->route('pharmacydrugs.create') ->with('success','Drug added successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'drug_id' => 'required|numeric',
            'q_minimum' => 'required|numeric',
            'unit_ht' => 'nullable',
            'unit_tt' => 'required',
            'discount' => 'nullable',
            'short_note' => 'nullable',
            'description' => 'nullable',
            'status' => 'required|boolean',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $drug = new PharmacyDrug(); 

        $drug->drug_id = $request->input('drug_id');
        $drug->q_stock = 0;
        $drug->q_minimum = $request->input('q_minimum');
        $drug->unit_ht = $request->input('unit_ht');
        $drug->unit_tt = $request->input('unit_tt');
        $drug->discount = $request->input('discount');
        $drug->description = $request->input('description');
        $drug->status = $request->input('status');
        $drug->pharmacy_id = auth('pharmacy')->user()->id;

        $drug->save();
        
        return redirect()->route('pharmacydrugs.index')
            ->with('success',
             'Médicament ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pharmacydrug = PharmacyDrug::findOrFail($id);

        $drugs = Drug::all();

        $drugtypes = DrugType::all(); //Get all drugtypes

        return view('pharmacies.admin.drugs.edit', compact('pharmacydrug', 'drugs', 'drugtypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pharmacydrug = PharmacyDrug::findOrFail($id);

        $drugs = Drug::all();

        $drugtypes = DrugType::all(); //Get all drugtypes

        return view('pharmacies.admin.drugs.edit', compact('pharmacydrug','drugs', 'drugtypes'));
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
        $drug = PharmacyDrug::findOrFail($id);



        $this->validate($request, [
            'drug_id' => 'required|numeric',
            'q_minimum' => 'required|numeric',
            'unit_ht' => 'nullable',
            'unit_tt' => 'required',
            'discount' => 'nullable',
            'short_note' => 'nullable',
            'description' => 'nullable',
            'status' => 'required|boolean',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $drug->drug_id = $request->input('drug_id');
        $drug->q_minimum = $request->input('q_minimum');
        $drug->unit_ht = $request->input('unit_ht');
        $drug->unit_tt = $request->input('unit_tt');
        $drug->discount = $request->input('discount');
        $drug->description = $request->input('description');
        $drug->status = $request->input('status');
        $drug->pharmacy_id = auth('pharmacy')->user()->id;

        $drug->save(); 

        return redirect()->route('pharmacydrugs.index')
            ->with('success',
             'Médicament édité avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drug = PharmacyDrug::findOrFail($id);

        $historique = new History();
        $historique->action = 'Delete';
        $historique->table = 'Supplier';
        $historique->user_id = auth('pharmacy')->user()->id;

        $drug->delete();
        $historique->save();

        return redirect()->route('pharmacydrugs.index')
            ->with('success',
             'Médicament supprimé avec succès.');
    }
}
