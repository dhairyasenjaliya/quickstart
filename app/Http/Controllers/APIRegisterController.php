<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use App\Model\Photos;

class APIRegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
                'name' => 'required',
                'password'=> 'required'                  
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } 

        $data = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'), 
            'password' => bcrypt($request->get('password')),       
        ]);

        return Response::json('success');
    }
}

// {

//     data:{
//         token:
//     },
//     message : '',
//     status : 200,
//     error:''
// }


