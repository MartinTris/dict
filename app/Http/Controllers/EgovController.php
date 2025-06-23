<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EgovController extends Controller
{
    public function index()
    {
        // This path matches your file structure
        return view('innovate.egov.egov');
    }
}