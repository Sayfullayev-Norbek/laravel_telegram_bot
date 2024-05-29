<?php

use App\Http\Controllers\LaragramController;
use Milly\Laragram\FSM\FSM;
use \Milly\Laragram\Types\Message;
use \Milly\Laragram\Laragram;

FSM::route('', function (Message $message) {
    Laragram::sendMessage(
            $message->chat->id,
            null,
            null, "Inside anonymous function"
    );
}, [
    (new \Milly\Laragram\Types\Update())->message
]);
FSM::route('state_+', [SomeClass::class, 'someMethod']);
