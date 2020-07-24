<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use Illuminate\Http\Request;

class MainController extends CustomController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('main.layouts');
    }
}

