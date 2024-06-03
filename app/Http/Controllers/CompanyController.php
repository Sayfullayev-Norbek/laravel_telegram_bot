<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Service\ModmeService;

class CompanyController extends Controller
{
    private ModmeService $modmeService;
    public function __construct(ModmeService $modmeService)
    {
        $this->modmeService = $modmeService;
    }
    public function index(Request $request){
        $request->validate([
            'modme_id' => 'required|integer',
            'token' => 'required',
        ]);
        $modme_id = $request->input('modme_id');
        $token = $request->input('token');
        if(!empty($modme_id) && !empty($token)){
            $data = Company::query()
                ->where('modme_company_id',$modme_id)
                ->where('modme_token', $token)
                ->first();
            $request = $this->modmeService->checkToken($token);
            $name = $request['company']['data']['name'];
            $modme_company_id = $request['company']['data']['id'];
            Company::query()->create([
                'modme_company_id' => $modme_company_id,
                'name' => $name,
                'modme_token' => $token,
            ]);

            if(!empty($data)){

                return 'bor';
            }else{
                return "tariff tanlash";
            }
            }
        }else{
            return view('index');
        }
    }

    public function store(Request $request)
    {

    }
}
