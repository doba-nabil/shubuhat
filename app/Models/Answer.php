<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'title', 'answer','question_id','created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }
}
