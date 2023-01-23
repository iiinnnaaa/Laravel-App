<?php

namespace App\Http\Controllers;

use App\Mail\Auth\EmailConfirmationMail;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function store(Request $request){
//        $email = Email::query()->findOrFail($request->email_id);

//        Mail::to($request->user())->send(new EmailConfirmationMail($email));

//        dd(new EmailConfirmationMail());
        Mail::to('isoyan.inna@gmail.com')->send(new EmailConfirmationMail($request->user()));

        return response('sending');
    }
}
