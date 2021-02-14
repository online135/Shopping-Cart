<?php

namespace App\Http\Controllers\Controls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        return view('controls.home');
    }
}
