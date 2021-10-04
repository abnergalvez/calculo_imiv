<?php

namespace App\Http\Controllers\Dashboard\Normal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.normal.home');
    }
}
