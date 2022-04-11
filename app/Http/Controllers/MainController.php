<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Response;

class MainController extends Controller
{
    function homepage(){

        return view('welcome'); 
    }
}