<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use JWTFactory;
use JWTAuth;
use App\User;
use App\Fact;
use App\Celebrities;
use Illuminate\Support\Facades\Auth;
use DB; 
use Storage;

class APIFindCelebritiesController extends Controller
{
    public function find(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            'search' => 'required',            
        ]);
 
        if($validator->fails()) {
            return response()->json([ 'error'=> $validator->messages()], 401);
        }

        $search = $request->get('search'); 

        $query2 = Celebrities::where('name',$search)->distinct()->get(['name','image','height','weight','networth']);       
        
        if($query2 == '[]'){  
            return response()->json('No Celeb Found !!');  
        }
        else{
            return response()->json($query2);
        } 
    }

    public function all(Request $request)
    {    
        $data = Celebrities::all('name','image','height','weight','networth'); 
        
        return response()->json($data);  
    } 
}
