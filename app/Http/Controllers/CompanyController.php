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
            if(!empty($data)){
                $request = $this->modmeService->checkToken($token);
                $name = $request['data']['company']['name'];
                $modme_company_id = $request['data']['company']['id'];
                Company::query()->create([
                    'name' => $name,
                    'modme_company_id' => $modme_company_id,
                    'modme_token' => $token,
                    'tariff' => "Zo'r"
                ]);
                return view('modme.statistika', compact('data', $data));
            } else {
                return view('modme.tariff');
            }
        } else {
            return view('index');
        }
    }

    public function tariffCreate(Request $request){
        $request->validate([
            'tariff' => 'required',
            'terms' => 'accepted',
        ]);
        $tariff = $request->input('tariff');
        $token = $request->input('token');
        dd($request['token']);

        $result = $this->modmeService->checkToken($token);

        if (isset($result['error'])) {
            return back()->withErrors(['modme_token' => $result['error']]);
        }

        $modme_company_id = $result['data']['company']['id'];
        $name = $result['data']['company']['name'];

        Company::query()->create([
            'name' => $name,
            'modme_company_id' => $modme_company_id,
            'modme_token' => $token,
            'tariff' => $tariff,
        ]);

        return view('modme.statistika');
    }
    
}

