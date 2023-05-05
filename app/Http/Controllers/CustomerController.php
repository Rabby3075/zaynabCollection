<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function registrationView(){
        return view('Customer.Auth.Registration');
    }
}
