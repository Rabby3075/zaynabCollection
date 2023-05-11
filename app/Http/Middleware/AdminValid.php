<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('admin')->check();
        if($check){
            $user = Auth::guard('admin')->user();
            if ($user->status === 1){
                return $next($request);
            }
            else{
                return redirect()->route('OtpView');
            }

        }
        else{
            return redirect()->route('AdminLoginView');
        }

    }
}
