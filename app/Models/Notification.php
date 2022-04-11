<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;

    public function donation_request()
    {
        return $this->belongsTo('Donation_request');
    }

    public function clients()
    {
        return $this->belongsToMany('Client');
    }

}