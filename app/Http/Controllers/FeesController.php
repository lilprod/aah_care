<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppointmentFee;

class FeesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = AppointmentFee::all();

        return view('admin.fees.index')->with('fees', $fees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fees.create');
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
            'title' => 'required',
            'description'  => 'nullable',
            'price'  => 'required',
            
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $fee = new AppointmentFee();
        $fee->title = $request->input('title');
        $fee->description = $request->input('description');
        $fee->price = $request->input('price');

        $fee->save();

        return redirect()->route('fees.index')
            ->with('success', 'Appointment Fee added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fee = AppointmentFee::findOrFail($id); //Get fee specified by id

        return view('admin.fees.show', compact('fee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fee = AppointmentFee::findOrFail($id); //Get fee specified by id

        return view('admin.fees.edit', compact('fee'));
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
        $fee = AppointmentFee::findOrFail($id); //Get fee specified by id

        $this->validate($request, [
            'title' => 'required',
            'description'  => 'nullable',
            'price'  => 'required',
            
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );


        $fee->title = $request->input('title');
        $fee->description = $request->input('description');
        $fee->price = $request->input('price');

        $fee->save();

        return redirect()->route('fees.index')
            ->with('success', 'Appointment Fee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fee = AppointmentFee::findOrFail($id); //Get fee specified by id

        $fee->delete();

        return redirect()->route('fees.index')
            ->with('success',
             'Appointment Fee deleted successfully.');
    }
}
