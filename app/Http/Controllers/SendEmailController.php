<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;

 

class SendEmailController extends Controller
{
    

    public function index($emailid)
    {
      // echo $emailid;
      // exit;

      dd($emailid);

      Mail::to($emailid)->send(new MyTestMail());

    
      if (Mail::failures()) {
        return Redirect()->route('inbox.index')->with('success','File is Forwarded.');

      //   return response()->json(['fail' => "Sorry! Please try again latter"], 403) ;  // JsonResponse object

       }else{

        return Redirect()->route('inbox.index')->with('success','File is Forwarded.');

      //   return response()->json(['success' => "Great! Successfully send in your mail"], 200) ;  // JsonResponse object

         }
    } 

}
