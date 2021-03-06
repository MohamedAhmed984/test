<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{

    protected $table = 'contacts';
    // protected $guard =[];
    protected $fillable = ['phone' ,'email', 'title' , 'message'];
    protected $hidden =['created_at' , 'updated_at'];
    public $timestamps = true;

}