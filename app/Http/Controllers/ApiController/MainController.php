<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Blood_type;
use App\Models\Category;
use App\Models\City;
use App\Models\Government;

class MainController extends Controller
{
    use ApiResponseTrait;

    public function bloodsList(){
        
        $bloods = Blood_type::all();

        return $this->apiResponse($bloods ,'ok ',200);

    }

    public function categoriesList(){
        $categories = Category::all();
        return $this->apiResponse($categories ,'All categries',200);

    }

    public function citiesList(){
        $cities = City::all();
        return $this->apiResponse($cities ,'All cities', 200);
    }

    public function governmentsList(){

        $governments = Government::all();

        return $this->apiResponse($governments ,'All governments', 200);

    }
}
