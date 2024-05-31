<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\LeadService;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Http\Controllers\BotController;

class LeadController extends Controller
{

    public function store(Lead $lead)
    {
        $chat_id = $lead->chat_id;
        $telegram_id = $lead->client_id;
        $telegram_name = $lead->last_name;
        $requestData = [
            'telegram_id' => $telegram_id,
            'telegram_name' => $telegram_name,
            'chat_id' => $chat_id
        ];

        Lead::create($requestData);
//
//        $lead = new Lead();
//        $lead->telegram_id = $telegram_id;
//        $lead->telegram_name = $telegram_name;
//        $lead->save();

    }
}
