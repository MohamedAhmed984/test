<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation_request extends Model 
{

    protected $table = 'donation_requests';
    public $timestamps = true;

    public function blood_type()
    {
        return $this->belongsTo('Blood_type');
    }

    public function city()
    {
        return $this->belongsTo('City');
    }

    public function notifications()
    {
        return $this->hasMany('Notification');
    }

}