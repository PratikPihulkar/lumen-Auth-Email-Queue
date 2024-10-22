<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use App\Models\User;



class EmailController extends Controller
{

    //this function is get perticular data form user, then find and get data from user
    function send_mail(Request $req)  {
    
        $user= User::find($req->id);
        

        if(!$user){
            return "User Not Found";
        }

        $data=[
            'title'=>'this is title',
            'body'=>'this is body'
        ];  


          
        // Mail::to($user->email)->send(new UserMail($data));
        // return "Email Send Successfully to  ". $user->email;

    }
    function send_mail_to_all_user()  {

        $users= User::all();

        $str="";

        $data=[
            'title'=>'this is title',
            'body'=>'this is body'
        ];  
        foreach ($users as $user) {
            Mail::to($user->email)->send(new UserMail($data));
            $str=$str. " done  ".$user->email. PHP_EOL;    //PHP_EOL for new Line
               
        }
        return $str;
    }
}
