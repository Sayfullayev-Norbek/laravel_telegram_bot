<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Milly\Laragram\FSM\FSM;
use Milly\Laragram\Laragram;
use App\Models\BotUser;
use App\Http\Controllers\BotController;
use App\Http\Controllers\LeadController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/bot', function () {
    return Laragram::sendMessage(
        1585277374,
        null,
        'Saytdan '
    );
});


Route::post('/bot', function (){
    FSM::route('name', [BotController::class, 'create_text_number']);
    FSM::route('/', [BotController::class, 'start_private']);
    FSM::route('/', [BotController::class, 'start_group']);
});






