<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminDashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile() 
    {
        $admin = Admin::where('id', auth('admin')->user()->id)->first();

        return view('admin.profile_setting', compact('admin'));
    }


    public function updatePassword(Request $request)
    {
        //Validate password fields
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $admin = Admin::findOrFail(auth('admin')->user()->id);

        $user = User::findOrFail($admin->user_id); //Get user specified by id

        if ((Hash::check(request('old_password'), Auth('admin')->user()->password)) == false) {

            return back()->with('error', 'Your old password is not correct! Please check!');

        }elseif((Hash::check(request('new_password'), Auth('admin')->user()->password)) == true) {

            return back()->with('error', 'Please enter a password which is not similar then current password.');

        }else{
            $user->password = $request->input('new_password');

            $admin->password = $request->input('new_password');

            $admin->save();

            $user->save();

            return back()->with('success', 'Password updated successfully.');
            
        }
    }

    public function updateSetting(Request $request, $id)
    {
        $admin = Admin::findOrFail($id); //Get admin with specified id

        $user = User::findOrFail($admin->user_id);

        //Validate name, email and password fields
        $this->validate($request, [
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            'email' => 'required|email|unique:users,email,'.$admin->user_id,
            'phone_number' => 'required',
            'address' => 'nullable',
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

        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        if ($request->hasfile('profile_picture')) {
            $user->profile_picture = $fileNameToStore;
        }

        $admin->name = $request->input('name');
        $admin->firstname = $request->input('firstname');
        $admin->email = $request->input('email');

        if ($request->hasfile('profile_picture')) {
            $admin->profile_picture = $fileNameToStore;
        }

        $admin->phone_number = $request->input('phone_number');
        
        $admin->address = $request->input('address');

        $admin->save();

        $user->save();

        //Redirect back view and display message
        return back()->with('success', 'Profil de la pharmacie mis à jour avec succès.');
    }
}
