<?php

namespace App\Http\Controllers;

use App\Models\Company_group;
use Illuminate\Http\Request;

class CompanyGroupController extends Controller
{
    public function groupCreate(Request $request){
        $request->validate([
            'telegram_chat_id' => 'required|integer',
            'modme_branch_id' => 'required|integer'
        ]);
        $modme_id = $request->input('modme_id');
        $token = $request->input('token');
        $company_id = $modme_id;

        $telegram_chat_id = $request->telegram_chat_id;
        $modme_branch_id = $request->modme_branch_id;

        $data = Company_group::query()->where('telegram_chat_id', $telegram_chat_id)->first();
        $groups = Company_group::query()->where('company_id',$company_id)->get();

        if($data){
            return view('modme.statistika')->with([
                    'data' => $data,
                    'groups' => $groups,
                    'modme_id' => $modme_id,
                    'token' => $token,
                    'message' => 'Bu Telegram chat ID bor'
                ]);
        }else{
            Company_group::query()->create([
                'company_id' => $company_id,
                'telegram_chat_id' => $telegram_chat_id,
                'modme_branch_id' => $modme_branch_id
            ]);
            return redirect(route('index'));
        }

    }
}
