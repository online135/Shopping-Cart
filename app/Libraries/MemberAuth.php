<?php 

namespace App\Libraries;
use App\Models\Member;

class MemberAuth {
    
    public const HOME = '/';
    private static $member = null;
    
    public static function member(){
        if( empty(self::$member) && session()->exists('memberId')){
            self::$member = Member::find(session('memberId'));
        }
        return self::$member;
    }

    public static function isLoggedIn(){
        return !empty(self::member());
    }

    public static function logIn($email, $password){
        self::$member = Member::where([
            'email' => $email,
            'password' => $password
        ])->first();

        if (!empty(self::$member)){
            session(['memberId' => self::$member->id]);
        }
    }

    public static function logOut(){
        session()->forget('memberId');
        self::$member = null;
    }
}