<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginMail;
use const http\Client\Curl\AUTH_ANY;


class AdminController extends Controller
{

    public function loginView(){
        return view('Admin.Auth.login');
    }

    public function login(Request $request){
        $validate = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]
    );

        $credentials = $request->only('email', 'password');
        $auth = Auth::guard('admin')->attempt($credentials);
        if ($auth) {
            $user = Auth::guard('admin')->user();
            $code = rand(1000,9999);
            $user->otp = $code;
            $user->save();
            $this->send2FAEmail($user);
            //config(['session.lifetime' => 1]);
            return redirect()->route('OtpView');
        } else {
            return redirect()->back()->with('message', 'Login failed due to invalid username and password');
        }

    }
    public function OtpView(){
        return view('Admin.Auth.Otp');
    }
    public function verifyOtp(Request $request){
        $user = Auth::guard('admin')->user();
        if ($user->otp === $request->otp){
            $user->status = 1;
            $user->save();
            return redirect()->route('Homepage');
        }
        else{
            return redirect()->back()->with('message', 'Invalid Otp');
        }
    }


    private function send2FAEmail($user)
    {
        $secretKey = $user->otp;
        $email = $user->email;
        $details = [
            'title' => 'Registration Confirmation',
            'code' => $secretKey
        ];
        Mail::to($email)->send(new loginMail($details));
    }

    public function Homepage(){
        $productCategory = DB::table('product_details')
            ->join('product_categories', 'product_details.category', '=', 'product_categories.id')
            ->select(DB::raw('count(product_categories.id) as count, product_categories.categoryName'))
            ->groupBy('product_categories.categoryName')
            ->get();
        $product = ProductDetails::all();

        return view('Admin.Dashboard.HomePage.home',compact('productCategory','product'));
    }
    public function logout(Request $request){
        $user = Auth::guard('admin')->user();
        $user->status = 0;
        $user->save();
        Auth::guard('admin')->logout();
        return  redirect()->route('Homepage');
    }

}
