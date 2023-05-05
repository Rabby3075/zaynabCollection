<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class CompanyController extends Controller
{
    public function companyView(){
        $company = Company::first();
        return view('Admin.Company.Company')->with('company',$company);
    }

    public function companyManagement(Request $request){
        $validate = $request->validate([
            "image"=>'image|mimes:jpeg,png,jpg,gif,svg',
            "mobile"=>'nullable|regex:/^\d{11}$/',
            "email"=>'nullable|email',
            "fbLink"=>'nullable|url|regex:/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/',
        ]);
        $check = Company::first();
        if($check){
            if (empty($request->image)){
                $nameImage = $check->logo;
            }else {
                if (File::exists(public_path('Company').'/'.$check->logo)) {
                    // Delete the existing image file
                    File::delete(public_path('Company').'/'.$check->logo);
                }
                $nameImage = $request->file('image')->getClientOriginalName();
                $folder = $request->file('image')->move(public_path('Company').'/',$nameImage);
            }
            $check->companyName = $request->companyName;
            $check->businessType = $request->businessType;
            $check->businessMoto = $request->businessMoto;
            $check->fbLink = $request->fbLink;
            $check->email = $request->email;
            $check->mobile = $request->mobile;
            $check->address = $request->address;
            $check->ownerName = $request->ownerName;
            $check->logo = $nameImage;
            $check->details = $request->details;
            $update = $check->save();
            if ($update){
                return redirect()->route('companyView')->with('success','Company Details Updated Successfully');
            }

        }
        else {
            if (empty($request->image)){
                $nameImage = "";
            }else {
                $nameImage = $request->file('image')->getClientOriginalName();
                $folder = $request->file('image')->move(public_path('Company').'/',$nameImage);
            }
            $company = new Company();
            $company->companyName = $request->companyName;
            $company->businessType = $request->businessType;
            $company->businessMoto = $request->businessMoto;
            $company->fbLink = $request->fbLink;
            $company->email = $request->email;
            $company->mobile = $request->mobile;
            $company->address = $request->address;
            $company->ownerName = $request->ownerName;
            $company->logo = $nameImage;
            $company->details = $request->details;
            $save = $company->save();
            if ($save){

                return redirect()->route('companyView')->with('success','Company Details Save Successfully');
            }

        }
    }
}
