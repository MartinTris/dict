<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GecsController extends Controller
{
    /**
     * Display the GECS main page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Update the view path to match your directory structure
        return view('protect.gecs.gecs');
    }
}