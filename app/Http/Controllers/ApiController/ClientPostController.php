<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class ClientPostController extends Controller
{
    use ApiResponseTrait;

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|numeric',
        ]);

        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }

        $client = auth()->guard('client-api')->user();   
        $client->posts()->toggle($request->post_id);
        
        $post_favourite = DB::table('client_post')->where('client_id', $client->id)->where('post_id', $request->post_id)->first();
        if($post_favourite){
            return $this->apiResponse(null ,'Post added to your favourites successfuly',200);

        }
        return $this->apiResponse(null ,'Post deleted from your favourites',200);

    }

    public function favouritesList(){

        $client = auth()->guard('client-api')->user(); 
        $favourites = $client->posts()->get();
        return $this->apiResponse($favourites ,'list of favourite posts',200);

    }
}
