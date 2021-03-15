<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogincustomController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

       
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password'), 'active' => 1])) {
            return redirect('/');
        }
        else
        {
            return redirect()->back();
        }
    }
}