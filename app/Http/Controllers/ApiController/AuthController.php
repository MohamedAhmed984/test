<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use Hash;
use Validator;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class AuthController extends Controller
{
    use ApiResponseTrait;
    
    
    public function adminRegister(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }
        $request->merge(['password'=>bcrypt($request->password)]);
        $admin = User::create($request->all());
        $admin->save();

        if($admin){
            return $this->apiResponse($admin ,'Data saved Successfully',200);
        }


    }
    
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->apiResponse(null ,$validator->errors(),400);
        }

        if(auth()->guard('user')->attempt(['phone' => request('phone'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'user']);
            
            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success =  $user;
            $success['token'] =  $user->createToken('MyApp',['user'])->accessToken; 

            return $this->apiResponse($success,'Admin Login successfully',200);
        }else{ 
            return $this->apiResponse(null ,'Your phone or password is wrong',400);
        }
    }

    public function adminProfile(){
        $admin = auth()->guard('user-api')->user();
        return $this->apiResponse($admin,'admin data',200);
  
    }

    public function adminLogout(Request $request){
        if (auth()->guard('user-api')->check()) {
            $token = auth()->guard('user-api')->user()->token();
            $token->revoke();
            return $this->apiResponse(null,'client logout successfully',200);
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'] , Response::HTTP_UNAUTHORIZED);
        } 
    }

// ------------------------------------------------

    public function clientRegister(Request $request){
            
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:clients',
            'phone' => 'required|unique:clients',
            'password' => 'required|min:8',
            'birth_date' => 'required',
            'last_donation_date' => 'required',
            'city_id' => 'required|numeric',
            'blood_type_id' => 'required|numeric',
        ]);
        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }
        $request->merge(['password'=>bcrypt($request->password)]);
        $client = Client::create($request->all());

        if($client){
            $success =  $client;
            $success['token'] =  $client->createToken('MyApp',['client'])->accessToken; 
            return $this->apiResponse($success ,'Data saved Successfully',200);
        }


    }

    public function clientLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->apiResponse(null ,$validator->errors(),400);
        }

        if(auth()->guard('client')->attempt(['phone' => request('phone'), 'password' => request('password')])){
            
            $client = auth()->guard('client')->user();
            $success =  $client;
            $success['token'] =  $client->createToken('MyApp',['client'])->accessToken; 
            return $this->apiResponse($success,'Client Login successfully',200);

            
        }else{ 
            return $this->apiResponse(null ,'Your phone or password is wrong',400);
        }
    }
    
    public function clientProfile(){
      $client = auth()->guard('client-api')->user();
      return $this->apiResponse($client,'client data',200);

    }

    public function clientLogout(Request $request){
        if (auth()->guard('client-api')->check()) {
            $token = auth()->guard('client-api')->user()->token();
            $token->revoke();
            return $this->apiResponse(null,'client logout successfully',200);
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'] , Response::HTTP_UNAUTHORIZED);
        } 
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            
        ]);

        if($validator->fails()){
            return $this->apiResponse(null ,$validator->errors(),400);
        }

        $client = Client::where('phone', $request->phone)->first();
        if($client){
            $code = Str::random(6);
            $client->pin_code = $code ;
            if($client->save()){
                $email = $client->email;
                Mail::to($email)->send(new ResetPassword($code));

                return $this->apiResponse("ok",'please write the code which you recieved in your email ',200);

            }
            else{
            return $this->apiResponse(null,'Something error please try again',400);

            }
        }
        else{
            return $this->apiResponse(null,'There is no account for this phone',400);

        }
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'pin_code' => 'required',
            'password' => 'required|min:8',
            
        ]);

        if($validator->fails()){
            return $this->apiResponse(null ,$validator->errors(),400);
        }

        $client = Client::where('phone', $request->phone)->first();

        if($client->pin_code == $request->pin_code){
            $client->password = bcrypt($request->password);
            $client->pin_code = null ;
            if($client->save()){

            return $this->apiResponse($client,'Your password changed successfully',200);
            }

            return $this->apiResponse(null,'something error please try again',200);
        }
        return $this->apiResponse(null,'sorry your code isn\'t true',200);

    }


}