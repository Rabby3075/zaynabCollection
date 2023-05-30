<?php

namespace App\Http\Controllers;

use App\Mail\loginMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function registrationView()
    {
        if (Auth::check()){return redirect()->back()->with('failed','You are already login');}
        else{return view('Customer.Auth.Registration');}
    }

    public function registration(Request $request)
    {
        $validate = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11',
                'address'=>'required',
                'password' => 'required|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{5,20}$/',
            ],
            ['password.regex'=>"Please use atleast 1 uppercase, 1 lowercase, 1 special charactee, 1 numbers"]
        );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->social_account = 0;
        $user->status = 0;
        if(User::where('email',$request->email)->first()){
            return redirect()->back()->with('failed',$request->email. ' is already registered');
        }
        else{
            $user->save();
            return redirect()->route('loginView')->with('success',' Registration Complete Successfully. Please logout to get access of this page');
        }
    }
    public function loginView()
    {
        if (Auth::check()){return redirect()->back()->with('failed','You are already login. Please logout to get access of this page');}
        else{return view('Customer.Auth.Login');}
    }
    public function login(Request $request)
    {
        $validate = $request->validate(['email' => 'required', 'password' => 'required']);
        $credentials = $request->only('email', 'password');
        $auth = Auth::attempt($credentials);
        if ($auth){
            $user = Auth::user();
            if ($user->status === 0){
                $code = Str::random(6);
                $user->otp = $code;
                $user->save();
                $this->send2FAEmail($user);
                return redirect()->route('otpView')->with('success','Please check your email for otp');
            }
            else{
                return redirect()->route('dashboard');
            }
        }
        else {
            return redirect()->back()->with('failed', 'Login failed due to invalid email and password');
        }
    }
    private function send2FAEmail($user)
    {
        $secretKey = $user->otp;
        $email = $user->email;
        $details = ['code' => $secretKey];
        Mail::to($email)->send(new loginMail($details));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginView')->with('success','Logout Successfully');
    }
    public function otpView()
    {
        if (Auth::check()){
            $user = Auth::user();
            if ($user->status===0){return view('Customer.Auth.Otp');}
            else{return redirect()->back()->with('failed','your email is already verified');}
        }
        else{return redirect()->back()->with('failed','you have no permission to access this page');}
    }
    public function ResendOtp()
    {
        if (Auth::check()){
            $user = Auth::user();
            $user->otp = Str::random(6);
            $user->save();
            $this->send2FAEmail($user);
            return redirect()->route('otpView')->with('success','Resend otp on your email');
        }
        else{return redirect()->back()->with('failed','you are not allow to submit this');}
    }
    public function otpSubmit(Request $request){
        $otp = $request->first.$request->second.$request->third.$request->fourth.$request->fifth.$request->sixth;
        $user = Auth::user();
        if ($user->otp === $otp){
            $user->status = 1;
            $user->save();
            return view('Customer.Dashboard.dashboard');
        }
        else{
            return redirect()->back()->with('failed','Invalid OTP');
        }
    }
    public function dashboard()
    {
        return view('Customer.Dashboard.dashboard');
    }
}
