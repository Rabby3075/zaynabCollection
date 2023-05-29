<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function registrationView()
    {
        return view('Customer.Auth.Registration');
    }

    public function registration(Request $request)
    {
        $validate = $request->validate(['name' => 'required', 'email' => 'required|email', 'password' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11','phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11|number','address'=>'required']);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->social_account = 0;
        $user->status = 0;

    }
}
