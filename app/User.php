<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password','phone' , 'gender' , 'active' ,'created_at' , 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeActive($query)
    {
        return $query->where('active' , 1);
    }
    public function getActive()
    {
        return  $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Question');
    }

}
