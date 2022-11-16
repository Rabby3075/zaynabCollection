<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginMail;

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
        return view('Admin.login');
    }
    public function login(Request $request){
        $validate = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]
    );
    $loginCheck = Admin::where('email',$request->email)->where('password',$request->password)->first();
    if($loginCheck){
        $request->session()->put('id',$loginCheck->id);
        $request->session()->put('email',$loginCheck->email);
        $request->session()->put('phone',$loginCheck->phone);
        $request->session()->put('username',$loginCheck->username);
        $request->session()->put('password',$loginCheck->password);
        Mail::to($loginCheck->email)->send(new loginMail());
        return  redirect()->route('Homepage');
    }
    else{
        return redirect()->back()->with('message', 'Login failed due to invalid username and password');
    }
    }
    public function Homepage(){
        return view('Admin.Dashboard.HomePage.home');
    }
}
