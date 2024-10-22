<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use App\Models\User;
use App\Jobs\QueueJob;

class QueueController extends Controller
{

    function send_mail(Request $req)  {
    
        $user= User::find($req->id);
        

        if(!$user){
            return "User Not Found";
        }

        $data=[
            'title'=>'this is title',
            'body'=>'this is body'
        ];  

        dispatch(new QueueJob($data));
        return "Email in QUEUE  ". $user->email;
    }


    // NOT WORKING //////////////////
    function send_mail_to_all_user()  {

        $users= User::all();

        $str="";

        $data=[
            'title'=>'this is title',
            'body'=>'this is body'
        ];  
        foreach ($users as $user) {
            dispatch(new QueueJob($users));
            return "Email in QUEUE  ". $user->email;
            // Mail::to($user->email)->send(new UserMail($data));
            // $str=$str. " done  ".$user->email. PHP_EOL;    //PHP_EOL for new Line     
        }
        return $str;
    }
  

}
