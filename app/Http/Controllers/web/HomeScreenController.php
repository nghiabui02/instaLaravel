<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeScreenController extends Controller
{
    public function index()
    {
        return view('home.home');
    }
}
