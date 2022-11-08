<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Registermail;
use Illuminate\Support\Facades\Mail;


class SendEmailController extends Controller
{
    public function index()
    {
      Mail::to('nikhilsharma28122000@gmail.com')->send(new Registermail());
      

      return "okk";
      // if(Mail::failures()) {
      //      return response()->Fail('Sorry! Please try again latter');
      // }else{
      //      return response()->success('Great! Successfully send in your mail');
      //    }
    } 
}

