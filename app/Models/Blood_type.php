<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blood_type extends Model 
{

    protected $table = 'blood_types';
    protected $fillable=['blood_type_name'];
    protected $hidden =['created_at' , 'updated_at'];
    public $timestamps = true;

    public function clients()
    {
        return $this->belongsToMany('Client');
    }

    public function donation_requests()
    {
        return $this->hasMany('Donation_request');
    }

}