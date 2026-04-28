<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DogBreedController extends Controller
{
    public function index(): View
    {
        return view('breeds.index');
    }
}
