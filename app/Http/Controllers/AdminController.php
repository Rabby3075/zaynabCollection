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
use PragmaRX\Google2FA\Google2FA;


class AdminController extends Controller
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
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

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
            $google2fa = app(Google2FA::class);
            $user->otp = $google2fa->generateSecretKey();
            $user->save();
            $this->send2FAEmail($user);
            return redirect()->route('OtpView')->with('message', 'An Otp code send to your email');
        } else {
            return redirect()->back()->with('message', 'Login failed due to invalid username and password');
        }

    }
    public function OtpView(){
        return view('Admin.Auth.Otp');
    }
    public function verify2FA(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $google2fa = app(Google2FA::class);
        $valid = $google2fa->verifyKey($user->otp, $request->otp);

        if ($valid) {
            return "success";
        } else {
            return "failed";
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
        Auth::guard('admin')->logout();
        return  redirect()->route('Homepage');
    }

}
