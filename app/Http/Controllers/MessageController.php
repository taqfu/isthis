<?php

namespace App\Http\Controllers;


use App\Message;
use App\User;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest()){
            return View('Message.guest');
        }
        return View('Message.index', [
            'messages'=>Message::orWhere('to', Auth::user()->id)->orWhere('from', Auth::user()->id)
              ->orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::guest()){
            return View('Message.guest');
        }
        $user = User::fetch_user_by_username($request->username);
        if ($user==null){
            return View('Message.invalid', [
                'username'=>$request->username,
            ]);
        }
        return View('Message.create', [
            "user"=>$user,    
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'=>'required|exists:users,username|string', 
            'text'=>'required|string',
        ]);
        if (Auth::guest()){
            return View('Message.guest');
        }
        $user = User::fetch_user_by_username($request->username);
        if ($user==null){
            trigger_error("User #" . Auth::user()->id . " is attempting to create a 
              message to a username that does not exist:" . $request->username);
        }
        if ($user==Auth::user()){
            trigger_error("User #" . Auth::user()->id . " tried to send a message to themselves.");
        }
        $message = new Message;
        $message->from = Auth::user()->id;
        $message->to = $user->id; 
        $message->text = $request->text;
        $message->save();
        return redirect(route('message.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, [
            'read_status'=>'required|boolean',
        ]);
        
        if (Auth::guest()){
            return View('Message.guest');
        }
        $message = Message::find($id);
        if ($message==null){
            trigger_error("User #" . Auth::user()->id . " is trying to update message #" . $message->id . " and it does not exist.");
        }
        $message->read = (boolean)$request->read_status;
        $message->save();
        return back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
