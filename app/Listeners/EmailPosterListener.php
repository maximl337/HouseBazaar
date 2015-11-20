<?php

namespace App\Listeners;

use App\Events\EmailPosterEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailPosterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EmailPosterEvent  $event
     * @return void
     */
    public function handle(EmailPosterEvent $event)
    {
        $message = $event->message;
    }
}
