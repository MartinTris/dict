<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class NbpController extends Controller
{
    /**
     * Display the NBP main page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Return the nbp view
        return view('connect.nbp.nbp');
    }
}