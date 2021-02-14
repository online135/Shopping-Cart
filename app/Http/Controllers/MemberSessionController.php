<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberSessionController extends Controller
{
    public function create()
    {
        return view('members.login');
    }

    public function store(Request $request)
    {
        $member = Member::where([
            'email' => $request->email,
            'password' => $request->password
        ])->first();

        return redirect('/');
    }

    public function delete(Request $request)
    {
        return redirect('/');
    }
}
