<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HRFormsCategory;
class HRFormController extends Controller
{
    //
    public function index()
    {
        $categories = HRFormsCategory::with('forms')->get();
        return view('hrforms.index', compact('categories'));
    }
}
