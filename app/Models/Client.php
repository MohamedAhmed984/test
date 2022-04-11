<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class Client extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'clients';
    protected $fillable = ['name','email','phone','password','birth_date','last_donation_date','government_id','city_id','blood_type_id'];
    protected $hidden = ['password','api_token','pin_code'];
    public $timestamps = true;

    public function bloodTypes()
    {
        return $this->belongsToMany(Blood_type::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function governments()
    {
        return $this->belongsToMany(Government::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class);
    }

}