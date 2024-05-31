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
    FSM::route('/', [BotController::class, 'botController']);
    FSM::route('name', [BotController::class, 'nameController']);
    FSM::route('javob', [BotController::class, 'javobController']);
});






