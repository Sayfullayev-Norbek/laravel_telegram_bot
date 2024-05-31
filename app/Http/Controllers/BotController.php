<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Service\LeadService;
use Milly\Laragram\FSM\FSM;
use Milly\Laragram\Types\Message;
use Milly\Laragram\Laragram;
use App\Models\Lead;


class BotController extends Controller{
    private LeadService $leadServive;
    public function __construct()
    {
        $this->leadServive = new LeadService();
    }
    public function botController(Message $message)
    {
        $text = $message->text;
        $chat_id = $message->from->id;
        $last_name = $message->from->last_name;

        if (str_contains($text, "/start ")) {

            $modme_id = explode(" ", $text)[1];
            $company_name = Company::find($modme_id);
            $lead = [
                'telegram_id' => $chat_id,
                'telegram_name' => $last_name,
                'modme_company_id' => $modme_id
            ];
            $this->leadServive->store($lead);

            Laragram::sendMessage(
                1585277374,
                null,
                'telefon no\'mer va ismingiz Bizni O\'quv markaz nomi => '.  $company_name->name
            );
            FSM::update('name');


        }
    }
    public function nameController(Message $message)
    {
        $text = $message->text;
        $chat_id = $message->from->id;
        $last_name = $message->from->first_name;
        $leads = Lead::where('telegram_id', $chat_id)->first();
        $modme_id = $leads->modme_company_id;
        $company_name = Company::find($modme_id);

        if ($text){
            $lead = [
                'telegram_id' => $chat_id,
                'telegram_name' => $last_name,
                'modme_company_id' => $modme_id,
                'lead_name' => $company_name->name
            ];
            $lead_db = Lead::find($modme_id);

            if ($lead_db) {
                $lead_db->update($lead);
            }
            Laragram::sendMessage(
                1585277374,
                null,
                "Number ism " . $leads->lead_name
            );
            FSM::update('javob');
        }
    }
    public function javobController(Message $message)
    {
        $chat_id = $message->from->id;
        $text = $message->text;

        $getPhoneNumbers = $this->getPhoneNumber($text);
        if (count($getPhoneNumbers) > 0) {
            $getPhoneNumbersStr = implode(', ', $getPhoneNumbers);
            Laragram::sendMessage(
                1585277374, // Replace with actual recipient ID
                null,
                "Received the following phone number(s): " . $getPhoneNumbersStr
            );

        } else {
            Laragram::sendMessage(
                $chat_id,
                null,
                "No valid phone numbers found. Please provide a valid phone number."
            );
        }
    }
    private function getPhoneNumber($text)
    {
        preg_match_all('/(?:\+?\d{1,3})?[ -]?\(?\d{1,3}\)?[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,4}/', $text, $matches);
        return $matches[0];
    }
}
