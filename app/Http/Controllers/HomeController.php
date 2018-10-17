<?php

namespace App\Mail;
namespace App\Http\Controllers;


use App\Mail\ActivationMail;
use App\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    //
    public function viewRegisterForm()
    {
    	return view('register');
    }

    public function proccessRegistration(Request $request)
    {
    	//data validation
    	// $this->validate($request->all());
    	$this->validate($request, [
    		'email' => 'required|email',
    		'username' => 'required|min:4',
    		'password' => 'required|min:6',
    		'photo' => 'required|mimes:jpeg,jpg,png'
    	]);

    	//proccess photo upload
    	$fileobject = $request->file('photo');
    	$file_ext = $fileobject->extension();
    	$file_name = str_random(16).'.'.$file_ext;
    	$path = $fileobject->storeAs('profile_photo', $file_name);

    	//Registration completed
        if ($path) {
            $activation_token = str_random(16).md5($request->input('email'));
            //insert data to database
            $data = [
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'photo' => $path,
                'activation_token' => $activation_token
            ];

            try {
                User::create($data);
                // $user = new User();
                // $user->email = $request->input('email');
                // $user->username = $request->input('username');
                // $user->password = bcrypt($request->input('password'));
                // $user->photo = $path;
                // $user->save();


                //Email user activation link
                Mail::to($data['email'])->send(new ActivationMail($data));


                session()->flash('message', 'Registration success !');
                return redirect('/');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            session()->flash('message', 'Photo was not uploaded !');
            return redirect()->back();
        }
    }
    
    public function viewLoginForm()
    {
    	return view('login');
    }

    public function processLogin(Request $request)
    {
        // data validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'active' => 1
        ];

        // check if user credentials is valid
        if (Auth::attempt($data)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        session()->flash('message', 'Email/password is incorrect or your account is not activated!');
        return redirect()->back();
    }

    public function viewDashboard()
    {
        return view('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        session()->flash('message', 'You are logged out!');
        return redirect()->route('login');
    }

    public function proccessActivation($token){
        $user = User::where('activation_token', $token)->first();

        if ($user !== null) {
            $user->update([
                'active' => 1
            ]);

            session()->flash('message', 'Account activated. You can login now');
            return redirect()->route('login');
        }
        session()->flash('message', 'Invalid activation link.');
        return redirect()->route('login');
    }


    public function viewForgotForm(){
        return view('forgot');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processForgot(Request $request){
        // data validation
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        //find the user
        $user = User::where('email', $request->input('email'))->first();

        if ($user !== null) {
            $reset_token = str_random(16).md5($request->input('email'));
            $user->update([
                'reset_token' => $reset_token
            ]);

            //Email user reset pass link
            /** @var TYPE_NAME $user */
            Mail::to($request->input('email'))->send(new PasswordResetMail($user));

            session()->flash('message', 'Password reset mail sent.');
            return redirect()->route('login');
        }
        session()->flash('message', 'Invalid Email or User not found.');
        return redirect()->back();
    }

}
