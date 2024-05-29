<?php

namespace App\Http\Controllers;

use Milly\Laragram\Types\Message;
use Milly\Laragram\Laragram;


class BotController extends Controller{
    public function botController(Message $message)
    {
        $text = $message->text;
        if ($text == "/start 1231235484") {
            $response = Laragram::sendMessage(
                1585277374,
                null,
                "Sizning hayotingizni tanlov o‘zgartiradi. Shunday ekan, birinchi navbatda maqsadingizni aniqlang va harakatni boshlang! O‘zini anglay boshlagan yosh inson oldida qaysi oliy o‘quv yurtini tanlash muammosi turadi. Qaysi kasbni egallasam, orzumdagidek hayotga erishaman? Bu va shunga o‘xshash savollar har bir insonni yoshligida o‘ylantirgan va o‘ylantirib kelmoqda."
            );
            return $response;
        }

        $phoneNumbers = $this->getPhoneNumber($text);

        if (count($phoneNumbers) > 0) {
            $response = Laragram::sendMessage(
                1585277374,
                null,
                "id: " . $message->from->id . "Ismi " . $message->from->first_name . "Abitureyntni Phone nuber:  ". implode("\n", $phoneNumbers)
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
    private function getPhoneNumber($text)
    {
        preg_match_all('/(?:\+?\d{1,3})?[ -]?\(?\d{1,3}\)?[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,4}/', $text, $matches);
        return $matches[0];

    }
}
