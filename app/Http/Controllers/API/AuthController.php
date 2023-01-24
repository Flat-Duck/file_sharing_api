<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function login(Request $request)
    {
        $request->merge(['role' => '']);        
        if (!Auth::guard()->attempt($request->only(['full_name','password','role']))) {
            return $this->sendError('not Authrized', 'Invalid login Data', 200);
        }
        
        $token = Auth::guard()->user()->createToken('AuthToken')->accessToken;
        return $this->sendResponse("Login Succefull", ['accessToken' => $token]);
    }
}
