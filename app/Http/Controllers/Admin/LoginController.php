<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Auth;
use Session;
use DB;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->isAdmin()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.pages.login');
    }

    public function login(LoginRequest $request)
    {
        $unReadNotification = DB::table('notifications')->where('read_at', NULL)->get();
        $numberOfUnReadNotification = count($unReadNotification);
        Session::put('numberOfUnReadNotification', $numberOfUnReadNotification);
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            if(Auth::user()->isAdmin()){
                return redirect()->route('admin.dashboard');
            } else{
                Session::flash('Error', trans('language.error.error_login'));
                return redirect()->route('admin.showlogin');
            }
        }
        Session::flash('Error', trans('language.error.error_login'));
        return redirect()->route('admin.showlogin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.showlogin');
    }
}
