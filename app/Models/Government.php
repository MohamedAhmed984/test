<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Government extends Model 
{

    protected $table = 'governments';
    public $timestamps = true;

    public function cities()
    {
        return $this->hasMany('City');
    }

    public function clients()
    {
        return $this->belongsToMany('Client');
    }

}