<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function shopping(Request $request) {

        $name = 'apple';
        $version = $request->input('version');
        
        return view('shopping', [
            'name' => $name,
            'version' => $version
        ]);
    }

    function test(Request $request) {

        $name = 'orange';
        $version = $request->input('version');

        return view('shopping', [
            'name' => $name,
            'version' => $version
        ]);
    }
}
