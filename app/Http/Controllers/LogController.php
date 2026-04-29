<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LogController extends Controller
{
    public function index(): View
    {
        return view('logs.index');
    }
}
