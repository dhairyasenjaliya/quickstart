<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Celebrities;
use DB;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use LaravelFCM\Message\Topics;

class Operations extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $celebs = DB::select('select * from celebrities');
        return view('addceleb',['celebs'=>$celebs]) ;
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
            'name'=>'required',
            'height'=>'required',
            'weight'=>'required',
            'networth'=>'required'
          ]);
          $Celebrities = new Celebrities([
            'name' => $request->get('name'),
            'height'=> $request->get('height'),
            'weight'=> $request->get('weight'),
            'networth'=> $request->get('networth')
          ]);
          $Celebrities->save();

          $notificationBuilder = new PayloadNotificationBuilder('New Celebrities');
          $notificationBuilder->setBody($request->name)
                      ->setSound('default');
          
          $notification = $notificationBuilder->build();
          
          $topic = new Topics();
          $topic->topic('celebrities');
          
          $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
          
          $topicResponse->isSuccess();
          $topicResponse->shouldRetry();
          $topicResponse->error();           

          return redirect('/addceleb')->with('success', 'Celeb Added!!');
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
    public function edit($id)
    {
        $Celebrities = Celebrities::find($id);
        return view('/edit', compact('Celebrities'));         
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
            'name'=>'required',
            'height'=> 'required',
            'weight'=> 'required',
            'networth'=> 'required',
          ]);
    
          $Celebrities = Celebrities::find($id);
          $Celebrities->name = $request->get('name');
          $Celebrities->height = $request->get('height');
          $Celebrities->weight = $request->get('weight');
          $Celebrities->networth = $request->get('networth');
          $Celebrities->save();
    
          return redirect('/addceleb')->with('success', 'Celeb has been updated !!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Celebrities = Celebrities::find($id);
        $Celebrities->delete();
        return redirect('/addceleb')->with('success', 'Celebrity Deleted Success!!');
    }
}