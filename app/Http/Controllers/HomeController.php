<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

 
use App\User;
use App\Celebrities;
use Illuminate\Support\Facades\Auth;
use DB; 



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function addceleb()
    {
        $celebs = DB::select('select * from celebrities');
        // $celebs = Celebrities::all()->order_by('created_at', 'desc') ;
        // $celebs = DB::table('celebrities')->latest()->first();
        
        return view('addceleb',['celebs'=>$celebs]) ;
    }

}
