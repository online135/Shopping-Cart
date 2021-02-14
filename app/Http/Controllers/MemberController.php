<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function create()
    {
        return view('members.register');
    }

    public function store(Request $request)
    {
        if ($request->password === $request->password_confirmation){
            $member = Member::create([
                'email' => $request->email,
                'password' => $request->password,
            ]);
        }
        return redirect('/');
    }
}
