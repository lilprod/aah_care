<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\Doctor;
use App\History;
use App\Appointment;
use App\AppointmentFee;
use App\Schedule;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AppointmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'schedule_id' => 'required',
            'date_apt' => 'required',
            'user_id' => 'required',
            'note' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $appointment = new Appointment();

        $patient = Patient::where('user_id', $request->input('user_id'))->first();

        $appointment->patient_user_id = $request->input('user_id');

        $appointment->patient_id = $patient->id;

        $appointment->date_apt = $request->input('date_apt');

        $appointment->schedule_id = $request->input('schedule_id');

        $schedule = Schedule::findOrFail($request->input('schedule_id'));

        $appointment->begin_time = $schedule->begin_time;

        $appointment->end_time = $schedule->end_time; 

        $appointment->identifier = $this->unique_code(9);

        //$appointment->apt_amount = 1;

        $fee = AppointmentFee::find(1);

        $appointment->apt_amount = $fee->price;

        $appointment->doctor_id = $request->input('doctor_id');

        $appointment->note = $request->input('note');

        $doctor = Doctor::findOrFail($appointment->doctor_id);

        $appointment->doctor_user_id = $doctor->user_id;

        $appointment->speciality_id = $doctor->speciality_id;

        $appointment->status = 0;

        $historique = new History();
        $historique->action = 'Create';
        $historique->table = 'Appointment';
        $historique->user_id = auth()->user()->id;

        $appointment->save();

        $historique->save();


        $appointment['doctor_name'] = $appointment->doctor->name;

        $appointment['doctor_firstname'] = $appointment->doctor->firstname;

        $appointment['doctor_email'] = $appointment->doctor->email;

        $appointment['doctor_phone_number'] = $appointment->doctor->phone_number;

        $appointment['doctor_speciality'] = $appointment->doctor->speciality->title;

        $appointment['doctor_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->doctor->profile_picture;


        $appointment['patient_name'] = $appointment->patient->name;

        $appointment['patient_firstname'] = $appointment->patient->firstname;

        $appointment['patient_email'] = $appointment->patient->email;

        $appointment['patient_phone_number'] = $appointment->patient->phone_number;

        $appointment['patient_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->patient->profile_picture;

        //$patient = $appointment->patient;
        //$patient['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$patient->profile_picture;

        //$doctor = $appointment->doctor;
        //$doctor['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$doctor->profile_picture;
        //$speciality = $doctor->speciality;
        //$doctor['speciality'] = $speciality;
        //$speciality['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$speciality->cover_image;

        return $this->sendResponse($appointment, 'Appointment saved sucessfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);
  
        if (is_null($appointment)) {
            return $this->sendError('Appointment not found.');
        }

        $appointment['doctor_name'] = $appointment->doctor->name;

        $appointment['doctor_firstname'] = $appointment->doctor->firstname;

        $appointment['doctor_email'] = $appointment->doctor->email;

        $appointment['doctor_phone_number'] = $appointment->doctor->phone_number;

        $appointment['doctor_speciality'] = $appointment->doctor->speciality->title;

        $appointment['doctor_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->doctor->profile_picture;


        $appointment['patient_name'] = $appointment->patient->name;

        $appointment['patient_firstname'] = $appointment->patient->firstname;

        $appointment['patient_email'] = $appointment->patient->email;

        $appointment['patient_phone_number'] = $appointment->patient->phone_number;

        $appointment['patient_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->patient->profile_picture;
   
        return $this->sendResponse(new PostResource($appointment), 'Appointment retrieved successfully.');
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

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            //'department_id' => 'required',
            'doctor_id' => 'required',
            'schedule_id' => 'required',
            'date_apt' => 'required',
            'user_id' => 'required',
            'note' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if($appointment->status == 0){

            $patient = Patient::where('user_id', $request->input('user_id'))->first();

            $appointment->patient_user_id = $request->input('user_id');

            $appointment->patient_id = $patient->id;

            $appointment->date_apt = $request->input('date_apt');

            $appointment->schedule_id = $request->input('schedule_id');

            $schedule = Schedule::findOrFail($request->input('schedule_id'));

            $appointment->begin_time = $schedule->begin_time;

            $appointment->end_time = $schedule->end_time; 

            //$appointment->apt_amount = 1;
            $fee = AppointmentFee::find(1);

            $appointment->apt_amount = $fee->price;

            $appointment->doctor_id = $request->input('doctor_id');

            $appointment->note = $request->input('note');

            $doctor = Doctor::findOrFail($appointment->doctor_id);

            $appointment->doctor_user_id = $doctor->user_id;

            $appointment->speciality_id = $doctor->speciality_id;

            $appointment->status = 0;

            $historique = new History();
            $historique->action = 'Update';
            $historique->table = 'Appointment';
            $historique->user_id = auth()->user()->id;

            $appointment->save();

            $historique->save();

            $appointment['doctor_name'] = $appointment->doctor->name;

            $appointment['doctor_firstname'] = $appointment->doctor->firstname;

            $appointment['doctor_email'] = $appointment->doctor->email;

            $appointment['doctor_phone_number'] = $appointment->doctor->phone_number;

            $appointment['doctor_speciality'] = $appointment->doctor->speciality->title;

            $appointment['doctor_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->doctor->profile_picture;

            $appointment['patient_name'] = $appointment->patient->name;

            $appointment['patient_firstname'] = $appointment->patient->firstname;

            $appointment['patient_email'] = $appointment->patient->email;

            $appointment['patient_phone_number'] = $appointment->patient->phone_number;

            $appointment['patient_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->patient->profile_picture;

            return $this->sendResponse($appointment, 'Appointment updated sucessfully!');
        }

        return $this->sendError('Appointment can not be updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
   
        return $this->sendResponse([], 'Appointment deleted successfully.');
    }
}
