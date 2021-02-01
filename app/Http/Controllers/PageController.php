<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function index(Request $request) {

        $name = 'index';
        $version = $request->input('version');
        
        return view('home', [
            'name' => $name,
            'version' => $version
        ]);
    }

    function shopping(Request $request) {

        $name = 'shopping';
        $version = $request->input('version');
        
        return view('shopping', [
            'name' => $name,
            'version' => $version
        ]);
    }

    function test(Request $request) {

        $name = 'test';
        $version = $request->input('version');

        return view('shopping', [
            'name' => $name,
            'version' => $version
        ]);
    }
}
