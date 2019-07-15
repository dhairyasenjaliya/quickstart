<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use JWTAuth; 
use App\Fact; 
use Illuminate\Support\Facades\Auth;
use DB; 


class APIFactController extends Controller
{
    public function getfact(Request $request)
    {    
        $data = Fact::all('description');
        return response()->json($data);         
    }
}
