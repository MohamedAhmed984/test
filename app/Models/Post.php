<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{

    protected $table = 'posts';
    protected $fillable =['title','content','image','category_id'];
    protected $hidden =['created_at' , 'updated_at'];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function clients()
    {
        return $this->belongsToMany('Client');
    }

}