<?php

namespace App\Http\Controllers;

use App\Models\Company_group;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Queue\Queue;

class CompanyGroupController extends Controller
{
    public function companyCreate(){
        if(!empty($_GET)){
            $company_id = $_GET['company_id'];
            $telegram_chat_id = $_GET['telegram_chat_id'];
            Company_group::query()->create([
                'company_id' => $company_id,
                'telegram_chat_id' => $telegram_chat_id
            ]);
            return redirect()->route('tariff_create');
        }else{
            return redirect()->route('companyCreate');
        }

    }
}
