<?php

namespace App\Http\Controllers;

use Milly\Laragram\Types\Message;
use Milly\Laragram\Laragram;


class BotController extends Controller
{
    public function botController(Message $message)
    {
        $message = $message->text;
        $phoneNumbers = $this->getPhoneNumber($message);

        if (count($phoneNumbers) > 0) {
            $response = Laragram::sendMessage(
                1585277374,
                null,
                "Sizni no'meringiz =>  ". implode("\n", $phoneNumbers)
            );
            return $response;
        } else {
            $response = Laragram::sendMessage(
                1585277374,
                null,
                null
            );
            return $response;
        }

    }
    private function getPhoneNumber($message)
    {
        preg_match_all('/(?:\+?\d{1,3})?[ -]?\(?\d{1,3}\)?[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,3}/', $message, $matches);
        return $matches[0];

    }

}
