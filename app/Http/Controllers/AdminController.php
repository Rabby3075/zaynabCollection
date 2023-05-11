<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminLog;
use App\Models\Company;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginMail;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    private static function get_user_agent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public function loginView()
    {
        return view('Admin.Auth.login');
    }

    public function login(Request $request)
    {
        $validate = $request->validate(['email' => 'required', 'password' => 'required']);
        $credentials = $request->only('email', 'password');
        $auth = Auth::guard('admin')->attempt($credentials);
        if ($auth) {
            $user = Auth::guard('admin')->user();
            $code = rand(1000, 9999);
            $user->otp = $code;
            $user->save();
            $this->send2FAEmail($user);
            $token = Str::random(60);
            $logs = new AdminLog();
            $logs->Ip = $request->ip();
            $logs->Os = self::get_os();
            $logs->Browser = self::get_browsers();
            $logs->Device = self::get_device();
            date_default_timezone_set('Asia/Dhaka');
            $logs->LoginTime = date("Y-m-d h:i:sa");
            $logs->Token = $token;
            $logs->save();
            session(['auth_token' => $token]);
            return redirect()->route('OtpView');
        } else {
            return redirect()->back()->with('message', 'Login failed due to invalid username and password');
        }
    }
    public function logHistory(){
        $logs = AdminLog::orderBy('id', 'DESC')->get();
        return view('Admin.Auth.Log')->with('logs',$logs);
    }

    public static function get_device()
    {

        $tablet_browser = 0;
        $mobile_browser = 0;

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
        }

        $mobile_ua = strtolower(substr(self::get_user_agent(), 0, 4));
        $mobile_agents = array('w3c', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',

            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',

            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-', 'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-');

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower(self::get_user_agent()), 'opera mini') > 0) {
            $mobile_browser++;

            //Check for tables on opera mini alternative headers

            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));

            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }

        if ($tablet_browser > 0) {
            //do something for tablet devices

            return 'Tablet';
        } else if ($mobile_browser > 0) {
            //do something for mobile devices

            return 'Mobile';
        } else {
            //do something for everything else
            return 'Computer';
        }

    }

    public static function get_browsers()
    {

        $user_agent = self::get_user_agent();

        $browser = "Unknown Browser";

        $browser_array = array('/msie/i' => 'Internet Explorer', '/Trident/i' => 'Internet Explorer', '/firefox/i' => 'Firefox', '/safari/i' => 'Safari', '/chrome/i' => 'Chrome', '/edge/i' => 'Edge', '/opera/i' => 'Opera', '/netscape/' => 'Netscape', '/maxthon/i' => 'Maxthon', '/knoqueror/i' => 'Konqueror', '/ubrowser/i' => 'UC Browser', '/mobile/i' => 'Safari Browser',);

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }
        }
        return $browser;
    }

    public static function get_os()
    {

        $user_agent = self::get_user_agent();
        $os_platform = "Unknown OS Platform";
        $os_array = array('/windows nt 10/i' => 'Windows 10', '/windows nt 6.3/i' => 'Windows 8.1', '/windows nt 6.2/i' => 'Windows 8', '/windows nt 6.1/i' => 'Windows 7', '/windows nt 6.0/i' => 'Windows Vista', '/windows nt 5.2/i' => 'Windows Server 2003/XP x64', '/windows nt 5.1/i' => 'Windows XP', '/windows xp/i' => 'Windows XP', '/windows nt 5.0/i' => 'Windows 2000', '/windows me/i' => 'Windows ME', '/win98/i' => 'Windows 98', '/win95/i' => 'Windows 95', '/win16/i' => 'Windows 3.11', '/macintosh|mac os x/i' => 'Mac OS X', '/mac_powerpc/i' => 'Mac OS 9', '/linux/i' => 'Linux', '/ubuntu/i' => 'Ubuntu', '/iphone/i' => 'iPhone', '/ipod/i' => 'iPod', '/ipad/i' => 'iPad', '/android/i' => 'Android', '/blackberry/i' => 'BlackBerry', '/webos/i' => 'Mobile',);

        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }
        return $os_platform;
    }


    public function OtpView()
    {
        return view('Admin.Auth.Otp');
    }

    public function verifyOtp(Request $request)
    {
        $user = Auth::guard('admin')->user();
        if ($user->otp === $request->otp) {
            $user->status = 1;
            $user->save();
            return redirect()->route('Homepage');
        } else {
            return redirect()->back()->with('message', 'Invalid Otp');
        }
    }


    private function send2FAEmail($user)
    {
        $secretKey = $user->otp;
        $email = $user->email;
        $details = ['code' => $secretKey];
        Mail::to($email)->send(new loginMail($details));
    }

    public function Homepage()
    {
        $productCategory = DB::table('product_details')->join('product_categories', 'product_details.category', '=', 'product_categories.id')->select(DB::raw('count(product_categories.id) as count, product_categories.categoryName'))->groupBy('product_categories.categoryName')->get();
        $product = ProductDetails::all();

        return view('Admin.Dashboard.HomePage.home', compact('productCategory', 'product'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Homepage');
    }

}
