<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\EmailVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $email =  Crypt::encryptString($request->email);
        $password =  Crypt::encryptString($request->password);
        $url  = route('register.auth.verify', [$email, $password]);


        Mail::to($request->email)->send(new EmailVerify($url));
    }


    public function verify($email, $password)
    {
        $reqEmail  = Crypt::decryptString($email);
        $reqPassword  = Crypt::decryptString($password);

        $auth  = Auth::attempt(['email' => $reqEmail, 'password' => $reqPassword]);

        if ($auth) {
            $user = User::where('email', $reqEmail)->first();
            $user->email_verified_at = today();
            $user->save();
        }
    }
}
