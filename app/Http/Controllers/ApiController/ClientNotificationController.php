<?php

namespace App\Http\Controllers\ApiController;
use App\Http\Traits\ApiResponseTrait;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ClientNotificationController extends Controller
{
    use ApiResponseTrait;

    public function setClientNotificationsData(Request $request){

        $validator = Validator::make($request->all(), [
            'blood_types_ids' => 'required',
            'governrates_ids' => 'required',
        ]);

        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }

        $client = auth()->guard('client-api')->user();  
        $client-> bloodTypes()->detach();
        $client->bloodTypes()->sync($request->blood_types_ids);
        $client-> governments()->detach();
        $client->governments()->sync($request->governrates_ids);
        return $this->apiResponse('ok' ,'Data saved successfully',200);
        
    }
    

}
