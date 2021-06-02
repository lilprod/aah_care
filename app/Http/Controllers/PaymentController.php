<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Doctor;
use App\Payment;
use App\Appointment;
use App\Patient;
use App\AppointmentFee;
use App\Speciality;
use App\History;
use App\Notification;
use App\Schedule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    protected $provider;

    public function __construct()
    {
        $this->middleware(['auth']); 

        $this->provider = new ExpressCheckout;
    }

    public function show($id){

    	$payment = Payment::findOrFail($id);

    	return view('patients.appointments.invoice', compact('payment'));
    }

    public function pay($id){

        $appointment = Appointment::findOrFail($id);

        return view('payments.pay', compact('appointment'));
    }

    public function save(Request $request){

        $this->validate($request, [
            'appointment_id' => 'required',
            'payment_mode' => 'required',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        if(($request->payment_mode == 1) || ($request->payment_mode == 2)){

            //$response = Http::post('https://paygateglobal.com/api/v1/pay', [
            //    'auth_token' => 'a81d1e51-bf4c-4fa1-ad94-ef30eb442c58',
            //    'identifier' => $appointment->identifier,
            //]);

            //$result = $response->getBody()->getContents();

            //$data = json_decode($result, true);

            $description = 'Patient '.$appointment->patient->name.' '.$appointment->patient->firstname.' Appointment Payment';
            $amount = $appointment->apt_amount;
            $token = "a81d1e51-bf4c-4fa1-ad94-ef30eb442c58";
            $identifier = $appointment->identifier;
            $url = route('dashboard');

            $payment = new Payment();
            $payment->apt_id = $appointment->id;
            $payment->apt_amount = $appointment->apt_amount;
            //$payment->apt_amount = 1;
            $payment->patient_id = $patient->id;
            $payment->patient_user_id = $appointment->patient_user_id;
            $payment->identifier = $appointment->identifier;
            $payment->description = $description;
            $payment->doctor_id = $appointment->doctor_id;
            $payment->doctor_user_id = $doctor->user_id;
            $payment->paymentmode_id = $request->payment_mode;
            $payment->status = 0;
            $payment->save();


            $urlString="https://paygateglobal.com/v1/page?token=$token&amount=$amount&description=$description&identifier=$identifier&url=$url";
            return Redirect::to($urlString);

        }elseif($request->payment_mode == 3){

            $data = [];
            $data['items'] = [
                [
                    'name' => 'Aah.care',
                    'price' => 1,
                    'desc'  => 'Paiement de consultation chez Aah.care',
                    'qty' => 1
                ]
            ];

            $payment = new Payment();
            $payment->apt_id = $appointment->id;
            //$payment->apt_amount = 1;
            $payment->apt_amount = $appointment->apt_amount;
            $payment->patient_id = $patient->id;
            $payment->patient_user_id = $appointment->patient_user_id;
            $payment->identifier = $appointment->identifier;
            $payment->doctor_id = $appointment->doctor_id;
            $payment->doctor_user_id = $doctor->user_id;
            $payment->description = 'Patient '.$appointment->patient->name.' '.$appointment->patient->firstname.' Appointment Payment';
            $payment->paymentmode_id = 3;
            $payment->status = 0;
            $payment->save();
      
            $data['invoice_id'] = $payment->id;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = 1;

            Session::put('invoice_id', $payment->id);
            Session::put('apt_id', $appointment->id);
      
            //$provider = new ExpressCheckout();
      
            $response = $this->provider->setExpressCheckout($data);
      
            $response = $this->provider->setExpressCheckout($data, true);
      
            return redirect($response['paypal_link']);

        }elseif($request->payment_mode == 4){

            //return view('payments.stripe', compact('doctor', 'patient', 'appointment'));

            return redirect()->route('stripe', $appointment->id);
        }

        /*$notification = new Notification();
        $notification->sender_id = auth()->user()->id;
        $notification->body = "Le patient $appointment->name $appointment->firstanme a fait une demande de rendez-vous pour le $appointment->date_apt!";
        //$notification->route = route('appointments.show', $appointment->id);
        $notification->route = route('doctor-pendingappointments');
        $notification->status = 0;
        $notification->receiver_id = $appointment->doctorUser_id;
        $notification->save();*/

        //Redirect to the users.index view and display message
        //return redirect()->route('booking.success', ['appointment'=>$appointment->id,'doctor'=>$doctor->id]);

    }


    public function verif($id){

    	$appointment = Appointment::find($id); 
        
        $payment = Payment::where('identifier', $appointment->identifier)->first(); 
        
            $send = [
                'auth_token' => '7a1cd656-d835-4303-8020-4ffbd0158fd6',
                'identifier' => $payment->identifier,
            ];
    
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://paygateglobal.com/api/v2/status"            ,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($send),
                CURLOPT_HTTPHEADER => array(
                    // Set here requred headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
    
            $result = curl_exec($curl);
            $error = curl_error($curl);
    
            curl_close($curl);

            if ($error) {
                return $this->sendError('cURL Error #: '.$error);
                //echo "cURL Error #:" . $err;
            }else{
                $data = json_decode($result, true);
                
                if(!empty($data['error_code'])){
                
                    return back()->with('error',"Le Paiement de $payment->name $payment->firstname est introuvable!");
                    
                }else{
                    
                    $status = $data['status'];
                    
                    if($status == 0){
                       
                       $payment->status = 1;
                       $appointment->status = 3;
                       $appointment->save();
                       $payment->save();
                       
                        return back()->with('success',"Le Paiement de $payment->name $payment->firstname  est bien valide");
                        
                    }elseif($status == 2){

                        return back()->with('error',"Le Paiement de $payment->name $payment->firstname est non valide");
        
                    
                    }elseif($status == 4){
                        
                       return back()->with('error',"Le Paiement de $payment->name $payment->firstname est expiré!");
                    
                    }elseif($status == 6){
                        
                        return back()->with('error',"Le Paiement de $payment->name $payment->lastname est annulé");
                    }
                    
                }
                
            }
    }
}
