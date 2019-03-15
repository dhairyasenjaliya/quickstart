<?php

namespace App\Http\Controllers;
use App\Fact;
use DB;
use Illuminate\Http\Request;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use LaravelFCM\Message\Topics;

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
          
          $notificationBuilder = new PayloadNotificationBuilder('New Fact');
          $notificationBuilder->setBody($request->description)
                      ->setSound('default');
          
          $notification = $notificationBuilder->build();
          
          $topic = new Topics();
          $topic->topic('fact');
          
          $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
          
          $topicResponse->isSuccess();
          $topicResponse->shouldRetry();
          $topicResponse->error();
 
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
