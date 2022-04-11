<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    protected $table = 'categories';
    protected $fillable =['name'];
    protected $hidden =['created_at' , 'updated_at'];
    public $timestamps = true;

    public function posts()
    {
        return $this->hasMany('Post');
    }

}