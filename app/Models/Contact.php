<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'email', 'message','created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function getRead()
    {
        return  $this->new == 1 ? 'مقروءة' : 'غير مقروءة';
    }
    public function scopeRead($query)
    {
        return $query->where('new' , 0);
    }
}
