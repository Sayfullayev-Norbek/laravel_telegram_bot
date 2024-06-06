<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Company_group;
use App\Service\LeadService;
use App\Service\ModmeService;
use Milly\Laragram\FSM\FSM;
use Milly\Laragram\Types\Message;
use Milly\Laragram\Laragram;
use App\Models\Lead;

class BotController extends Controller{
    private LeadService $leadService;
    private ModmeService $modmeService;
    public function __construct()
    {
        $this->leadService = new LeadService();
        $this->modmeService = new ModmeService();
    }
    public function start_private(Message $message): void
    {
        if ($message->chat->type == 'private') {
            $text = $message->text;
            $chat_id = $message->from->id;
            $last_name = $message->from->last_name;

            if (str_contains($text, "/start ")) {
                $modme_id = explode(" ", $text)[1];
                $company = Company::find($modme_id);//
                $lead = [
                    'telegram_id' => $chat_id,
                    'telegram_name' => $last_name,
                    'modme_company_id' => $modme_id
                ];
                $this->leadService->store($lead);
                Laragram::sendMessage(
                    $chat_id,
                    null,
                    'Bizni O\'quv markaz nomi Ismingiz va Telefon raqamiz qoldiring bog\'lanishga '
                );
                FSM::update('name');
            }
        }
    }
    public function create_text_number(Message $message)
    {
        $text = $message->text;
        $chat_id = $message->from->id;
        $getPhoneNumbers = $this->getPhoneNumber($text);
        $last_name = $message->from->last_name;
        $lead = Lead::query()->where('telegram_id', $chat_id)->latest()->first();//

        if (count($getPhoneNumbers) > 0){
            $getPhoneNumbersStr = implode(', ', $getPhoneNumbers);
            $data = [
                'telegram_name' => $last_name,
                'lead_name' => $text,
                'lead_phone' => $getPhoneNumbersStr
            ];
            $lead->update($data);//
            Laragram::sendMessage(
                $chat_id,
                null,
                "Raxmat siz bilan Bo'lanamiz"
            );
            $this->modmeService->setToken($lead->company->modme_token);
            return $this->modmeService->sendLead([
                'name' => 'milly',
                'phone' => $lead->lead_phone,
                'comment' => $message->text,
                'branch_id' => 147
            ]);
        }else{
            Laragram::sendMessage(
                $chat_id,
                null,
                "ERROR"
            );
        }
    }
    public function start_group(Message $message)
    {
        if ($message->chat->type == 'group' || $message->chat->type == 'supergroup') {
            $text = $message->text;
            $chat_id = $message->from->id;
            $getPhoneNumbers = $this->getPhoneNumber($text);
            if (count($getPhoneNumbers) > 0) {
                $companyGroup = Company_group::query()->where('telegram_chat_id', $chat_id)->first();//
                $lead = Lead::query()->where('telegram_id', $chat_id)->latest()->first();//

                $getPhoneNumbersStr = implode(', ', $getPhoneNumbers);
                if ($companyGroup) {
                    $group_name = $message->chat->title;
                    $data = [
                        'telegram_id' => $chat_id,
                        'telegram_name' => $group_name,
                        'lead_name' => $text,
                        'lead_phone' => $getPhoneNumbersStr,
                        'modme_company_id' => $companyGroup->company_id//
                    ];
                    $this->leadService->store($data);
                    Laragram::sendMessage(
                        1585277374,
                        null,
                        'Bazaga yangi foydalanuvchi keldi!'
                    );
                    $this->modmeService->setToken($lead->company->modme_token);
                    return $this->modmeService->sendLead([
                        'name' => $group_name,
                        'phone' => $getPhoneNumbersStr,
                        'comment' => $text,
                        'branch_id' => 147
                    ]);
                }
            }
        }
    }
    private function getPhoneNumber($text): array
    {
        preg_match_all('/(?:\+?\d{1,3})?[ -]?\(?\d{1,3}\)?[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,3}[ -]?\d{1,4}/', $text, $matches);
        return $matches[0];
    }
}
