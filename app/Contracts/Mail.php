<?php

namespace App\Contracts;

use App\User;

interface Mail
{
    
    public function sender(User $sender);

    public function recipient(User $recipient);

    public function addMergeVar($name, $content);

    public function send();

    public function sendTemplate();

    public function checkIfRecipientIsUnsubbed();

    public function event($event);

}