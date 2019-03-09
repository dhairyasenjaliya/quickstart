<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\celebrities;
use App\Fact;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/addceleb', 'HomeController@addceleb')->name('addceleb');

Route::get('/edit', 'Operations@edit');

Route::resource('crud', 'Operations');

Route::any('/search',function(Request $request){
    $q = Input::get( 'q' ); 
    $celebs = Celebrities::where('name','LIKE','%'.$q.'%')->get();
    if(count($celebs) > 0)
        return view('/addceleb',['celebs'=>$celebs]) ;
    else{
        $celebs = Celebrities::all();
        return view('/addceleb',['celebs'=>$celebs]);
    }    
});


Route::any('/searchfact',function(Request $request){
    $q = Input::get( 'q' ); 
    $facts = Fact::where('description','LIKE','%'.$q.'%')->get();
    if(count($facts) > 0)
        return view('/managefact',['facts'=>$facts]) ;
    else{
        $facts = Fact::all();
        return view('/managefact',['facts'=>$facts]);
    }    
});


Route::get('/managefact', 'HomeController@showfact')->name('managefact');
Route::get('/factedit', 'FactOperations@edit');
Route::resource('fact', 'FactOperations');