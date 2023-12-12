<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogisticController extends Controller
{
    public function index()
    {
        return view("logistic.index");
    }
}
