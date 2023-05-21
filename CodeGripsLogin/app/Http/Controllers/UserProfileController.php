<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class UserProfileController extends Controller
{
    //Set cookie
    public function setBrowserCookie(Request $request)
    {
        $userId = $request->input('cookieConsentCheck');
        Cookie::queue('user-cookie', $userId, 100);

        return response()->json(['Cookie has been successfully set.']);
    }

    public function getBrowserCookie()
    {
        $cookieRes = Cookie::get('user-cookie');
        dd($cookieRes);
    }
    public function destroyBrowserCookie()
    {
        Cookie::forget('user-cookie');
  
        return response()->json(['Cookie has been successfully deleted.']);
    }
}
