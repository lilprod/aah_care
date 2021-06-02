<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\Drug as DrugResource;
use App\Drug;
use App\DrugType;
use Validator;

class DrugController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = Drug::all();
        
        return $this->sendResponse($drugs, 'Drugs retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
   
        $validator = Validator::make($data, [
            'name' => 'required',
            'generic_name' => 'required',
            'short_note' => 'nullable',
            'drug_type_id' => 'nullable',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $drug = new Drug(); 

        $drug->name = $request->input('name');
        $drug->generic_name = $request->input('generic_name');
        $drug->short_note = $request->input('short_note');
        $drug->drug_type_id = $request->input('drug_type_id');

        $drug->save();

        return $this->sendResponse($drug, 'Drug added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drug = Drug::find($id);
  
        if (is_null($drug)) {

            return $this->sendError('Drug not found.');
        }
   
        return $this->sendResponse($drug, 'Drug retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {
        $data = $request->all();
   
        $validator = Validator::make($data, [
            'name' => 'required',
            'generic_name' => 'required',
            'short_note' => 'nullable',
            'drug_type_id' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $drug->name = $request->input('name');
        $drug->generic_name = $request->input('generic_name');
        $drug->short_note = $request->input('short_note');
        $drug->drug_type_id = $request->input('drug_type_id');

        $drug->save();

        return $this->sendResponse($drug, 'Drug updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        $drug->delete();
   
        return $this->sendResponse([], 'Drug deleted successfully.');
    }
}
