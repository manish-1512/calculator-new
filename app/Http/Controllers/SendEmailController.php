<?php

namespace App\Http\Controllers;
use Mail;
 
use App\Mail\NotifyMail;
use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    public function index()
    {
 
      Mail::to('kumarvijesh089@gmail.com')->send(new NotifyMail());
 
      if (Mail::failures()) {
           return response()->Fail('Sorry! Please try again latter');
      }else{
           return response()->success('Great! Successfully send in your mail');
         }
    }
}
