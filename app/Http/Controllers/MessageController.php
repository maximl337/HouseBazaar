<?php

namespace App\Http\Controllers;


use App\Message;
use App\Http\Requests;
//use App\Contracts\Mail;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{

    protected $mailer;

    public function __construct(Mail $mail)
    {
        $this->mailer = $mail;
    }
    public function store(MessageRequest $request)
    {
        $message = Message::create($request->input());

        $user = $message->user()->first();

        Mail::send('emails.reminder', compact('user'), function ($m) use ($user) {

                $m->from('test@housemenow.com', 'System');

                $m->to($user->email, $user->name)->subject('Test');
            });

        //$this->mailer->recipient($user)->send();
        
        flash()->overlay("Success", "Your message was emailed to the poster", 'success');

        return back();
    }
}
