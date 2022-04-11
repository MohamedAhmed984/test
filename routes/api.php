<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\PostController;
use App\Http\Controllers\ApiController\MainController;
use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\ApiController\ClientPostController;
use App\Http\Controllers\ApiController\ContactController;
use App\Http\Controllers\ApiController\ClientNotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('v1')->namespace('ApiController')->group(function () {
    
    Route::group( ['prefix' => 'client'],function(){


        Route::post('register',[AuthController::class , 'clientRegister']);
        Route::post('login',[AuthController::class, 'clientLogin']);
        Route::post('reset-password',[AuthController::class, 'resetPassword']);
        Route::post('change-password',[AuthController::class, 'changePassword']);
        
        Route::group( ['middleware' => ['auth:client-api','scopes:client'] ],function(){
        // authenticated staff routes here 
            Route::get('profile',[AuthController::class, 'clientProfile']);
            Route::get('logout',[AuthController::class, 'clientLogout']);

            // -------------------- Routes of governments--------------------------
            Route::get('/governments',[MainController::class , 'governmentsList']);
         
            // -------------------- Routes of cities--------------------------
            Route::get('/cities',[MainController::class , 'citiesList']);
        
            // -------------------- Routes of contact--------------------------
           Route::post('/contact',[ContactController::class , 'store']);
          
            // -------------------- Routes of categories--------------------------
            Route::get('/categories',[MainController::class , 'categoriesList']);

            // -------------------- Routes of posts--------------------------

            Route::get('/posts',[PostController::class , 'postsList']);
            Route::get('/category-posts',[PostController::class , 'categoryPosts']);
            Route::get('/show-post',[PostController::class , 'showPost']);
            
            // -------------------- Routes of favourite posts---------------------------
            Route::post('/add-favourite-post',[ClientPostController::class , 'store']);
            Route::get('/favourite-posts',[ClientPostController::class , 'favouritesList']);

            // -------------------- Routes of bloods--------------------------

            Route::get('/bloods',[MainController::class , 'bloodsList']);
            // -------------------- Routes of Notifications --------------------------
            Route::post('/notifications-data',[ClientNotificationController::class , 'setClientNotificationsData']);
            

        });

    });

    // ***********************Admin routes *********************

    // Route::post('admin/register',[AuthController::class , 'adminRegister']);
    // Route::post('admin/login',[AuthController::class, 'adminLogin']);
    

    // Route::group( ['prefix' => 'admin','middleware' => ['auth:user-api','scopes:user'] ],function(){
    //    // authenticated staff routes here 
    //     Route::get('profile',[AuthController::class, 'adminProfile']);
    //     Route::get('logout',[AuthController::class, 'adminLogout']);

    //     // -------------------- Routes of category---------------------------
    //     Route::post('/add-category',[categoryController::class , 'create']);
    //     Route::put('/update-category',[categoryController::class , 'update']);
    //     Route::delete('/delete-category',[categoryController::class , 'destroy']);
    //     Route::get('/categories',[categoryController::class , 'categoriesList']);

    //     // -------------------- Routes of posts---------------------------
    //     Route::post('/add-post',[PostController::class , 'create']);
    //     Route::post('/update-post',[PostController::class , 'update']);
    //     Route::delete('/delete-post',[PostController::class , 'destroy']);
    //     Route::get('/show-posts',[PostController::class , 'show']);


    // });


});
