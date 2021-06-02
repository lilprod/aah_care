<?php

use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\User;
use App\Alert;
use Carbon\Carbon;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Video Chat

Route::get('/video-chat', function () {

    // fetch all users apart from the authenticated user

    $users = User::where('id', '<>', Auth::id())
                  ->where('role_id', '<>', auth()->user()->role_id)
                  ->where('role_id', '<>', 3)
                  ->where('is_activated', 1)
                  ->get();

    return view('video_chat.index', ['users' => $users]);
})->name('video_chat')->middleware('auth');

// Endpoints to call or receive calls.

Route::post('/video/call-user', 'VideoChatController@callUser');

Route::post('/video/accept-call', 'VideoChatController@acceptCall');

/*Route::group(['middleware' => 'auth'], function(){

  Route::get('video_chat', 'VideoChatController@index')->name('video_chat');

  Route::post('auth/video_chat', 'VideoChatController@auth');
});*/

//Notifications
Route::resource('alerts', 'AlertController');

Route::get('/getNotifs', 'AlertController@lastNotifAjax')->name('getNotifs');

Route::get('/updateStatus', 'AlertController@updateStatusAjax')->name('updateStatus');


//PDF

Route::get('patient/{id}/prescriptionInvoice', ['as' => 'prescription.invoice', 'uses' => 'PatientManagerController@pdfexport']);

Route::get('patient/{id}/invoice', ['as' => 'patient.invoice', 'uses' => 'PatientManagerController@pdfInvoice']);

Route::get('patient/{id}/appointment', ['as' => 'appointment.pdf', 'uses' => 'PatientManagerController@pdfAppointment']);

//Account Verification

Route::get('/verify', 'VerifyController@getVerify')->name('getVerify');

Route::post('/verify', 'VerifyController@postVerify')->name('verify');

//Paypal

Route::post('paypal/payment', 'PaypalController@payment')->name('payment');

Route::get('paypal/cancel', 'PaypalController@cancel')->name('payment.cancel');

Route::get('paypal/success', 'PaypalController@success')->name('payment.success');

//Stripe

Route::get('/stripe/{id}', ['as' => 'stripe', 'uses' => 'StripeController@stripe']);

//Route::get('stripe', 'StripeController@stripe')->name('stripe');

Route::post('stripe', 'StripeController@stripePost')->name('stripe.post');

//Admin Auth
Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {

    Route::get('login', 'AdminAuthController@getLogin')->name('login');

    Route::post('login', 'AdminAuthController@postLogin');

    Route::get('dashboard', 'AdminDashboardController@adminHome')->name('dashboard');

    Route::post('logout', 'AdminAuthController@postLogout')->name('logout');
});

// Admin Doctors reviews

Route::get('admin/reviews', 'AdminReviewController@index')->name('admin.reviews');

Route::delete('admin/reviewsdelete/{id}', 'AdminReviewController@destroy')->name('admin.reviewsDelete');

//Admin Post

Route::get('admin/active/posts', 'AdminPostController@index')->name('admin.posts');

Route::get('admin/pending/posts', 'AdminPostController@pending')->name('admin.pending_posts');

Route::get('admin/posts/{id}', 'AdminPostController@show')->name('admin_posts_show');

Route::delete('admin/posts_delete/{id}', 'AdminPostController@delete')->name('admin_posts_delete');

Route::get('admin/create/posts', 'AdminPostController@create')->name('admin_posts_create');

Route::get('admin/posts/{id}/edit', 'AdminPostController@edit')->name('admin_posts_edit');

Route::post('admin/posts', 'AdminPostController@store')->name('admin_posts_store');

Route::patch('admin/posts/update/{id}', 'AdminPostController@update')->name('admin_posts_update');

Route::get('postm/check_slug', 'AdminPostController@check_slug')->name('admin.post.check_slug');

Route::post('admin/activate/posts/{id}','AdminPostController@active')->name('admin_activate_post');

Route::post('admin/desactivate/posts/{id}','AdminPostController@desactive')->name('admin_desactivate_post');

//Admin Payment

Route::get('admin/payments', 'AdminPaymentController@index')->name('admin_payments');

Route::get('admin/payments/{id}', 'AdminPaymentController@show')->name('admin_payments_show');

//Admin Disease

Route::get('admin/diseases', 'AdminDiseaseController@index')->name('admin.diseases');

Route::get('admin/diseases/{id}', 'AdminDiseaseController@show')->name('admin_diseases_show');

Route::get('admin/create/diseases', 'AdminDiseaseController@create')->name('admin_diseases_create');

Route::delete('admin/diseases_delete/{id}', 'AdminDiseaseController@delete')->name('admin_diseases_delete');

Route::patch('admin/posts/update/{id}', 'AdminPostController@update')->name('admin_posts_update');

Route::get('admin/diseases/{id}/edit', 'AdminDiseaseController@edit')->name('admin_diseases_edit');

Route::post('admin/diseases', 'AdminDiseaseController@store')->name('admin_diseases_store');

Route::get('diseasem/check_slug', 'AdminDiseaseController@check_slug')->name('admin.disease.check_slug');

//Admin Signature Approval

Route::get('admin/active/signatures', 'AdminSignatureController@index')->name('admin.signatures');

Route::get('admin/pending/signatures', 'AdminSignatureController@pending')->name('admin.pending_signatures');

Route::get('admin/signatures/{id}', 'AdminSignatureController@show')->name('admin_signatures_show');

Route::delete('admin/signatures_delete/{id}', 'AdminSignatureController@delete')->name('admin_signatures_delete');

Route::get('admin/create/signatures', 'AdminSignatureController@create')->name('admin_signatures_create');

Route::get('admin/signatures/{id}/edit', 'AdminSignatureController@edit')->name('admin_signatures_edit');

Route::post('admin/signatures', 'AdminSignatureController@store')->name('admin_signatures_store');

Route::patch('admin/signatures/update/{id}', 'AdminSignatureController@update')->name('admin_signatures_update');

//Admin Appointment

Route::get('admin/appointments', 'AdminAppointmentController@index')->name('admin_appointments');

Route::prefix('admin')->middleware('auth:admin')->group(function () {

  Route::resource('fees', 'FeesController');

});

//Admin Faq Management

Route::get('admin/faqs', 'FaqController@index')->name('faqs.index');

Route::get('admin/faqs/create', 'FaqController@create')->name('faqs.create');

Route::get('admin/faqs/{id}/show', 'FaqController@show')->name('faqs.show');

Route::get('admin/faqs/{id}/edit', 'FaqController@edit')->name('faqs.edit');

Route::delete('admin/faqs/{id}', 'FaqController@destroy')->name('faqs.destroy');

Route::patch('admin/faqs/update/{id}', 'FaqController@update')->name('faqs.update');

Route::post('admin/faqs', 'FaqController@store')->name('faqs.store');

//Admin Account Management

Route::get('admin/profile', 'Admin\AdminDashboardController@profile')->name('admin_profile');

Route::post('/admin/update_password', 'Admin\AdminDashboardController@updatePassword')->name('admin_update_password');

Route::patch('/admin/update_setting/{id}', 'Admin\AdminDashboardController@updateSetting')->name('update_admin_setting');

//Frontend Authentification

//Route::get('/login/doctor', 'Auth\LoginController@showDoctorLoginForm');

//Route::post('/login/doctor', 'Auth\LoginController@doctorLogin');

//2FA

/*Route::group(['prefix'=>'2fa'], function(){
   // Route::get('/','LoginSecurityController@show2faForm');
   Route::post('/generateSecret','LoginSecurityController@generate2faSecret')->name('generate2faSecret');
    Route::post('/enable2fa','LoginSecurityController@enable2fa')->name('enable2fa');
    Route::post('/disable2fa','LoginSecurityController@disable2fa')->name('disable2fa');

});*/

//Route::get('/get2fasetting','LoginSecurityController@get2fasetting')->name('get2fasetting');

/*Route::post('/2fa', function () {

    return redirect(URL()->previous());

})->name('2fa')->middleware('2fa');*/

Auth::routes();

//Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration')->name('complete_registration');

//Route::get('/re-authenticate', 'LoginSecurityController@reauthenticate')->name('re_authenticate');

//Admin Pharmacy

Route::post('pharmacy/store/drugs', 'Pharmacy\PharmacyDrugController@storeDrug')->name('pharmacy_store_drug');

Route::resource('suppliers', 'Pharmacy\SupplierController');

Route::resource('orders', 'Pharmacy\OrderController');

Route::resource('pharmacydrugs', 'Pharmacy\PharmacyDrugController');

Route::get('pharmacy/admin/patient/{id}/all/prescriptions', ['as' => 'patient_prescription.view', 'uses' => 'AdminPharmacyController@filterPrescription']);

Route::get('pharmacy/admin/prescriptions', 'AdminPharmacyController@index')->name('pharmacy_prescriptions');

Route::get('pharmacy/admin/prescription/{id}/edit', 'AdminPharmacyController@edit')->name('pharmacy_prescription_edit');

Route::get('pharmacy/admin/prescription/{id}/view', 'AdminPharmacyController@show')->name('pharmacy_prescription_view');

Route::get('/patient_search/action', 'AdminPharmacyController@action')->name('patient_search.action');

Route::get('pharmacy/admin/profile', 'AdminPharmacyController@profile')->name('admin_pharmacy_profile');

Route::get('/pharmacy/dashboard', 'Pharmacy\DashboardController@adminHome')->name('pharmacy_dashboard');

Route::post('/pharmacy/update_password', 'AdminPharmacyController@updatePassword')->name('pharmacy_update_password');

Route::patch('/pharmacy/update_setting/{id}', 'AdminPharmacyController@updateSetting')->name('update_pharmacy_setting');

//Pharmacy Auth

Route::get('/login/pharmacy', 'Auth\LoginController@showPharmacyLoginForm')->name('login_pharmacy');

Route::post('/login/pharmacy', 'Auth\LoginController@pharmacyLogin')->name('post_login_pharmacy');

Route::get('/register/pharmacy', 'Auth\RegisterController@showPharmacyRegisterForm')->name('register_pharmacy');

//Route::post('/register/pharmacy', 'Auth\RegisterController@createPharmacy');

Route::post('/register/pharmacy', 'Auth\RegisterController@registerPharmacy');

Route::get('/register/doctor', 'Auth\RegisterController@showDoctorRegisterForm')->name('register_doctor');

Route::post('/register/doctor', 'Auth\RegisterController@registerDoctor');

//Route::post('/register/doctor', 'Auth\RegisterController@createDoctor');

Route::get('/getDoctors', 'PagesController@getDoctors')->name('getDoctors');

Route::post('/take/{id}', ['as' => 'take', 'uses' => 'DoctorManagerController@take']);

Route::post('/finish/{id}', ['as' => 'finish', 'uses' => 'DoctorManagerController@finish']);

Route::post('/checkup', 'AppointmentController@check')->name('checkUp');

Route::post('/archivedapt', 'DoctorManagerController@archivedApt')->name('archivedapt');

# Socialite URLs

// La page où on présente les liens de redirection vers les providers
//Route::get("login-register", "SocialiteController@loginRegister");

// La redirection vers le provider
Route::get('redirect/{provider}', 'SocialiteController@redirect')->name('socialite.redirect');

// Le callback du provider
Route::get('redirect/{provider}/callback', 'SocialiteController@callback')->name('socialite.callback');


Route::get('/accept/message/request/{id}' , function ($id){
    Chat::acceptMessageRequest($id);
    return redirect()->back();
})->name('accept.message');

Route::post('/trigger/{id}' , function (\Illuminate\Http\Request $request , $id) {
    Chat::startVideoCall($id , $request->all());
});

Route::post('/group/chat/leave/{id}' , function ($id) {
    Chat::leaveFromGroupConversation($id);
});


//Administrations

Route::get('changeStatus', 'DoctorController@ChangeUserStatus')->name('changeStatus');

Route::resource('ratings', 'RatingController');

Route::resource('pharmacies', 'PharmacyController');

Route::get('validateStatus', 'Pharmacy@ChangeUserStatus')->name('validateStatus');

// Admin Medical Ressources

Route::resource('signatures', 'SignatureController');

Route::resource('specialities', 'SpecialityController');

Route::resource('services', 'ServiceController');

Route::resource('drugs', 'DrugController');

Route::resource('diseases', 'DiseaseController');

Route::resource('drugtypes', 'DrugTypeController');

Route::resource('prescriptions', 'PrescriptionController');

Route::resource('prescriptiontypes', 'PrescriptionTypeController');

//Admin Doctor

Route::resource('doctors', 'DoctorController');

Route::resource('patients', 'PatientController');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::resource('categories', 'CategoryController');

Route::resource('schedules', 'ScheduleController');

Route::resource('appointments', 'AppointmentController');

Route::post('verif/{id}','PaymentController@verif')->name('verif');

//Patients Routes

Route::get('patient/pay/{id}/appointment', ['as' => 'appointment.pay', 'uses' => 'PaymentController@pay']);

Route::post('/patient/appointment/pay', 'PaymentController@save')->name('patient_apt_pay');

Route::post('/patient/crop-image-upload', 'PatientManagerController@uploadCropImage')->name('patient_crop_image');

Route::get('/patient/profile_setting', 'PatientManagerController@setting')->name('patient_profile_setting');

Route::post('/patient/post_setting', 'PatientManagerController@postSetting')->name('post_patient_setting');

Route::get('/patient/profile/{id}', ['as' => 'patient.profile', 'uses' => 'PagesController@profilePatient']);

Route::get('/patient/booking/{id}', ['as' => 'booking.doctor', 'uses' => 'PatientManagerController@booking']);

Route::get('/patient/rating/{id}', ['as' => 'rating.doctor', 'uses' => 'PatientManagerController@rating']);

Route::get('/invoice/{id}', ['as' => 'invoice.show', 'uses' => 'PaymentController@show']);

Route::get('/patient/booking/success/{appointment}/{doctor}', ['as' => 'booking.success', 'uses' => 'AppointmentController@success']);

Route::get('/getSchedules', 'PatientManagerController@getSchedules')->name('getSchedules');

//Patient Change Password routes

Route::get('/patient/change_password', 'PatientManagerController@verifEmail')->name('patient_change_password');

Route::post('/patient/verif_email', 'PatientManagerController@postEmail')->name('patient_verif_email');

Route::get('/patient/verif_code', 'PatientManagerController@verifCode')->name('patient_verif_code');

Route::post('/patient/post_code', 'PatientManagerController@postCode')->name('patient_post_code');

Route::get('/patient/confirm_change_password', 'PatientManagerController@changePassword')->name('confirm_change_password');

Route::post('/patient/update_password', 'PatientManagerController@updatePassword')->name('patient_update_password');

//Pateient's Favorites Doctors routes

Route::post('favorite/{doctor}', 'PatientManagerController@favoriteDoctor');

Route::post('unfavorite/{doctor}', 'PatientManagerController@unFavoriteDoctor');

Route::get('my_favourites', 'PatientManagerController@myFavorites')->name('my_favourites')->middleware('auth');

//Doctors Routes

Route::post('/doctor/crop-image-upload', 'DoctorManagerController@uploadCropImage')->name('doctor_crop_image');

Route::get('/doctor/profile_setting', 'DoctorManagerController@setting')->name('doctor_profile_setting');

Route::post('/doctor/post_setting', 'DoctorManagerController@postSetting')->name('post_doctor_setting');

Route::get('/doctor/profile/{id}', ['as' => 'doctor.profile', 'uses' => 'PagesController@profileDoctor']);

//Doctor Change Password routes

//Route::get('/doctor/change_password', 'DoctorManagerController@changePassword')->name('doctor_change_password');

Route::get('/doctor/change_password', 'DoctorManagerController@verifEmail')->name('doctor_change_password');

Route::post('/doctor/verif_email', 'DoctorManagerController@postEmail')->name('doctor_verif_email');

Route::get('/doctor/verif_code', 'DoctorManagerController@verifCode')->name('doctor_verif_code');

Route::post('/doctor/post_code', 'DoctorManagerController@postCode')->name('doctor_post_code');

Route::get('/doctor/confirm_change_password', 'DoctorManagerController@changePassword')->name('doctor_confirm_change_password');

Route::post('/doctor/update_password', 'DoctorManagerController@updatePassword')->name('doctor_update_password');

//Doctor's Appointments route

Route::get('/doctor/my_appointments', 'DoctorManagerController@myAppointments')->name('doctor_my_appointments');

Route::get('/doctor/my_patients', 'DoctorManagerController@myPatients')->name('doctor_my_patients');

Route::get('/doctor/reviews', 'DoctorManagerController@reviews')->name('doctor_reviews');

Route::get('/doctor/my_invoices', 'DoctorManagerController@myInvoices')->name('doctor_my_invoices');

Route::get('/doctor/pending_posts', 'PostController@pending')->name('doctor_pending_posts');

Route::get('/doctor/startapt/{id}', ['as' => 'appointment.start', 'uses' => 'DoctorManagerController@start']);

Route::post('/bulk/schedules/store', 'ScheduleController@save')->name('bulk_schedules_store');

Route::post('/bulk/schedules/update', 'ScheduleController@modif')->name('bulk_schedules_update');

Route::post('/post/reviews/answers', 'RatingController@saveAnswer')->name('review_answers_store');

Route::post('/post/answers/replies', 'RatingController@replyStore')->name('answers_replies_store');

//Website Pages

Route::get('/pharmacy/profile/{id}', ['as' => 'pharmacy.profile', 'uses' => 'PagesController@profilePharmacy']);

Route::get('/our-pharmacies', 'SearchController@pharmacies')->name('pharmacies');

Route::post('/pharmacy/search', 'SearchController@postPharmacy')->name('post_search_pharmacy');

Route::get('/', 'PagesController@index')->name('home');

Route::get('/about-us', 'PagesController@about')->name('about');

Route::get('/our-services', 'PagesController@services')->name('services');

Route::get('/contact-us', 'PagesController@contact')->name('contact');

Route::post('contact', 'ContactController@store')->name('postcontact');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/get/services', 'PagesController@search')->name('get_services');

Route::post('/search', 'SearchController@postSearch')->name('search');

Route::get('/search/disease', 'SearchController@searchDisease')->name('search_disease');

Route::post('/postsearch/disease', 'SearchController@postData')->name('post_search_disease');

Route::get('/blog', 'PagesController@blog')->name('blog');

Route::get('/our-doctors', 'PagesController@doctors')->name('our_doctors');

Route::get('list/doctors', 'PagesController@listDoctor')->name('list_doctors');

Route::get('/terms', 'PagesController@terms')->name('terms');

Route::get('/policy', 'PagesController@policy')->name('policy');

Route::get('/faq', 'PagesController@faq')->name('faq');

Route::get('/getCountries', 'PagesController@getCountries')->name('getCountries');

Route::post('/loadmore/load_data', 'PagesController@load_data')->name('loadmore.load_data');

Route::get('post/{slug}', ['as' => 'blog.show', 'uses' => 'PagesController@postDetails']);

Route::get('post/author/{name}', ['as' => 'author.show', 'uses' => 'PagesController@authorPost']);

Route::get('category/{slug}', ['as' => 'categoryPosts', 'uses' => 'PagesController@categoryPosts']);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('doctor/dashboard', 'DoctorManagerController@index')->name('doctor_dashboard');

Route::get('categorie/check_slug', 'CategoryController@check_slug')->name('category.check_slug');

Route::get('postn/check_slug', 'PostController@check_slug')->name('post.check_slug');

Route::get('diseasen/check_slug', 'DiseaseController@check_slug')->name('disease.check_slug');

//Chat

//Route::get('/chat', 'ChatController@index')->name('chat');

Route::get('/messages', 'ChatController@fetchAllMessages');

Route::post('/messages', 'ChatController@sendMessage');

//Messages

Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages');
 
Route::post('/send', 'MessagesController@postSendMessage');

Route::get('/fetch-old-messages', 'MessagesController@getOldMessages');

//Localisation

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
});

//Video Chat

//Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('/chat/{id}', 'VideoChatController@chat')->name('videochat');

Route::get('/group/chat/{id}', 'VideoChatController@groupChat')->name('group.chat');

Route::post('/chat/message/send', 'VideoChatController@send')->name('chat.send');

Route::post('/chat/message/send/file', 'VideoChatController@sendFilesInConversation')->name('chat.send.file');

Route::post('/group/chat/message/send', 'VideoChatController@groupSend')->name('group.send');

Route::post('/group/chat/message/send/file', 'VideoChatController@sendFilesInGroupConversation')->name('group.send.file');

*/

/*Route::group(['prefix' => 'admin'], function() {

  
Route::get('events/{event}/remind/{user}', [
'as' => 'remindHelper', 'uses' => 'EventsController@remindHelper']);
View:

route('remindHelper',['event'=>$eventId,'user'=>$userId]);
    
});*/

/*Route::get('/test', function () {

    $date = Carbon::today()->toDateString();

    $timestamp = strtotime($date);

    $month = date('m', $timestamp);

    $name = Str::of('KOSSIGAN')->substr(0,3)->upper();

    $firstname = Str::of('Prodige')->substr(0,1)->upper();

    $matricule = 'TG'.date("y").$month.$name.$firstname;

    dd($matricule);
});*/

Route::get('/notify', function () {

  //$user = User::find(9);

  //$user->notify(new App\Notifications\RealTimeNotification('Hello World'));

  $alert = new Alert();
  $alert->sender_id = 6;
  $alert->body = "Le patient ABALO Koffi souhaite prendre RDV avec vous.Merci de consulter vos RDV en attente";
  //$alert->route = route('orders.show', $order->id);
  //$alert->route = route('dashboard');
  $alert->route = route('doctor_dashboard');
  $alert->object = 'DEMANDE DE RDV';
  $alert->object_status = 0;
  $alert->status = 0;
  $alert->receiver_id = 9;
  $alert->save();
});

/*Route::get('/create_role_permission', function () {
    $role = Role::create(['name' => 'Admin']);
    $permission = Permission::create(['name' => 'Admin Permissions']);
    auth()->user()->assignRole('Admin');
    auth()->user()->givePermissionTo('Admin Permissions');


    $admin = new Admin();
    $admin->name = 'KOSSIGAN';
    $admin->firstname = 'Prodige';
    $admin->email = 'pkossigan@gmail.com';
    $admin->password = Hash::make('prodige93');
    $admin->phone_number = 22893343699;
    $admin->address = 'Lomé-Togo';
    $admin->profile_picture = 'avatar.jpg';
    $admin->save();
       
});*/