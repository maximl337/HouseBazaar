<?php

namespace App\Http\Controllers;


use Mail;
use App\Message;
use App\Http\Requests;
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

        Mail::send('emails.message', compact('user', 'message'), function ($m) use ($user, $message) {

                $m->from('notifications@housemenow.com', 'system');

                $m->to($user->email, $user->name)->subject('You have a new message');
            });
        
        flash()->overlay("Success", "Your message was emailed to the poster", 'success');

        return back();
    }
}
