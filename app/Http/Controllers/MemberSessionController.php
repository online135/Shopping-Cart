<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberSessionController extends Controller
{
    public function create()
    {
        session()->invalidate();
        var_dump(session('user.teams'));
        echo "<hr/>";

        session()->put('user.teams', [123]);
        var_dump(session('user.teams'));
        echo "<hr/>";


        // return view('members.login',);
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
