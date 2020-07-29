<?php

namespace App\Http\Controllers\Auth;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends CustomController
{
    //
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login.login');
    }

    public function login()
    {
        $credentials = [
            'username' => $this->postField('username'),
            'password' => $this->postField('password')
        ];
        if ($this->isAuth($credentials)) {
            return redirect('/admin');
        }
        return redirect()->back()->with(['fail' => 'Periksa Username & Password']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
