<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;


class ContactController extends Controller
{
    use ApiResponseTrait;

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required |numeric' ,
            'email' => 'required |email',
            'title' => 'required',
            'message' => 'required',
            
        ]);
        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }

        $contact = Contact::Create( $request->all() );
        if($contact){

        return $this->apiResponse($contact ,'Message send successfully', 200);
            
        }
        return $this->apiResponse(null ,'Something error try again please.', 200);


    }
}
