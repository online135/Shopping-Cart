<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DownloadFileRequest;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('web.token')->only('download');
        $this->middleware('web.downloadfile')->only('download');
    }

    function home()
    {
        return view('home', [
            "token" => '1234156'
        ]);
    }


    function download($id, DownloadFileRequest $request)
    {
        return $request->downloadFile();
    }
}