<?php

namespace App\Http\Controllers\API\V1\Back;

use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\ValidationRules\ClientRules;
use Illuminate\Support\Facades\Validator;
use App\Helpers\{Response, ValidatorHelper};
use App\Repositories\Interfaces\{IUserRepo, IClientRepo};
use App\Http\Resources\{ClientResource, ClientCollection};


class AccountController extends Controller
{
    protected $userRepo;
    protected $clientRepo;

    public function __construct(IUserRepo $userRepo, IClientRepo $clientRepo){
        $this->userRepo = $userRepo;
        $this->clientRepo = $clientRepo;
    }

    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function register(Request $request){
        try{
            $validator = Validator::make($request->all(), ClientRules::registerRules(), ValidatorHelper::messages());
            if ($validator->passes()){
                $data = $validator->validated();
                $data['startValidity'] = Carbon::now()->format('Y-m-d');
                $data['endValidity'] = Carbon::now()->addDays(15)->format('Y-m-d');
                $data['status'] = 'Active';
                $client = $this->clientRepo->create($data);
                $this->clientRepo->createRelatedUsers($client, $data['users']);
                return Response::respondSuccess(Response::SUCCESS , new ClientResource($client));
            }
            return Response::respondError($validator->errors()->all());
        } catch (\Exception $e) {
            return Response::respondError($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function account(Request $request){
        try{
            $validator = Validator::make($request->all() , (new Client)->searchRules(), ValidatorHelper::messages());
            if ($validator->passes()){
                $models = $this->clientRepo->paginate();
                $this->clientRepo->load($models, ['users']);
                return Response::respondSuccess(Response::SUCCESS , new ClientCollection($models));
            }
            return Response::respondError($validator->errors()->all());
        } catch (\Exception $e) {
            return Response::respondError($e->getMessage());
        }
    }

}
