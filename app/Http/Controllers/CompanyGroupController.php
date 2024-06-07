<?php

namespace App\Http\Controllers;

use App\Models\Company_group;
use Illuminate\Http\Request;

class CompanyGroupController extends Controller
{
    public function groupCreate(Request $request){
        $request->validate([
            'telegram_chat_id' => 'required|integer'
        ]);
        dd($request);
        $modme_id = $request->input('modme_id');
        $token = $request->input('token');
        $company_id = $request->company_id;
        $telegram_chat_id = $request->telegram_chat_id;

        Company_group::query()->create([
            'company_id' => $company_id,
            'telegram_chat_id' => $telegram_chat_id
        ]);

        $data = Company_group::query()->where('telegram_chat_id', $telegram_chat_id)->first();
        $groups = Company_group::query()->where('company_id',$company_id)->get();

        return view('modme.statistika', compact('data', 'groups', 'modme_id', 'token'));
    }
}
