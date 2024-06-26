<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Company_group;
use App\Models\Lead;
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

            $data = Company::query()->where('modme_company_id',$modme_id)->where('modme_token', $token)->first();

            $groups = Company_group::query()->where('company_id', $modme_id)->get();
            $modme_branch_id = Company_group::query()->where('company_id', $modme_id)->first();
            $leads = Lead::all();

            if(!empty($data)){

                $request = $this->modmeService->checkToken($token);
                $name = $request['data']['company']['name'];
                $modme_company_id = $request['data']['company']['id'];

                return view('modme.statistika', compact('data', 'groups', 'modme_id', 'token', "modme_branch_id", 'leads'));
            } else {
                return view('modme.tariff', compact('token', 'modme_id'));
            }
        } else {
            return view('index');
        }
    }
    public function tariffStore(Request $request){
        $request->validate([
            'tariff' => 'required',
            'terms' => 'accepted',
        ]);

        $tariff = $request->input('tariff');
        $token = $request->input('token');

        $result = $this->modmeService->checkToken($token);


        if (isset($result['error'])) {
            return back()->withErrors(['modme_token' => $result['error']]);
        }
        $modme_id = $result['data']['company']['id'];
        $name = $result['data']['company']['name'];

        if($result == true){
            if(!empty($modme_id)){
                if(!empty($name)){


                    Company::query()->create([
                        'name' => $name,
                        'modme_company_id' => $modme_id,
                        'modme_token' => $token,
                        'tariff' => $tariff,
                    ]);
                    $data = Company::query()
                        ->where('modme_company_id',$modme_id)
                        ->where('modme_token', $token)
                        ->first();
                    $groups = Company_group::query()->where('company_id', $modme_id)->get();

                    return view('modme.statistika', compact('data', 'groups', 'modme_id', 'token'));
                }else{
                    return "Company name yuq";
                }
            }else{
                return "Modme ID topilmadi";
            }
        }else{
            return "Modme bilan bo'g'lanishda muammo";
        }
    }
}

