<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use JWTFactory;
use JWTAuth;
use App\User;
use Illuminate\Support\Facades\Auth;


class APILoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);

        $credentials = $request->only('email', 'password');
        
      
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }
        
       
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'], 404);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }
        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token ]], 200);
    }

  
    public function logout(Request $request)
    {
         
        $this->validate($request, ['token' => 'required']);
        if(JWTAuth::invalidate($request->input('token')))
        {
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        }
    }

    
}
