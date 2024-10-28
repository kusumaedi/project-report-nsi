<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $report = Report::latest()->get();
        return view('home', compact('report'));
    }
}
