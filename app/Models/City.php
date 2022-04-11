<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;

    public function government()
    {
        return $this->belongsTo('Government');
    }

    public function donation_requests()
    {
        return $this->hasMany('Donation_request');
    }

}