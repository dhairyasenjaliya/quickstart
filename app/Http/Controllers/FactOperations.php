<?php

namespace App\Http\Controllers;
use App\Fact;
use DB;
use Illuminate\Http\Request;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class FactOperations extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facts = DB::select('select * from facts');
        return view('addceleb',['facts'=>$facts]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description'=>'required' 
          ]);
          $Fact = new Fact([
            'description' => $request->get('description')            
          ]);
          $Fact->save();

          $optionBuilder = new OptionsBuilder();
          $optionBuilder->setTimeToLive(60*20);

          $notificationBuilder = new PayloadNotificationBuilder('Latest Facts');
          $notificationBuilder->setBody('New Facts Added')->setSound('default');

          $dataBuilder = new PayloadDataBuilder();
          $dataBuilder->addData(['a_data' => 'my_data']);

          $option = $optionBuilder->build();
          $notification = $notificationBuilder->build();
          $data = $dataBuilder->build();

          $token = "a_registration_from_your_database";

          $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

          $downstreamResponse->numberSuccess();
          $downstreamResponse->numberFailure();
          $downstreamResponse->numberModification();

          //return Array - you must remove all this tokens in your database
          $downstreamResponse->tokensToDelete();

          //return Array (key : oldToken, value : new token - you must change the token in your database )
          $downstreamResponse->tokensToModify();

          //return Array - you should try to resend the message to the tokens in the array
          $downstreamResponse->tokensToRetry();

          return redirect('/managefact')->with('success', 'Fact Added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $facts = Fact::find($id);
       
        // $facts = DB::table('facts')->where('id', '=', $id)->get();
        return view('/factedit', compact('facts'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $request->validate([
            'description'=>'required'  
          ]);
    
          $facts = Fact::find($id);
          $facts->description = $request->get('description'); 
          $facts->save();
    
          return redirect('/managefact')->with('success', 'Description has been updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facts = Fact::find($id);
        $facts->delete();
        return redirect('/managefact')->with('success', 'Description Deleted Success!!');
    }
 }
