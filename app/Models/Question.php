<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'mini_question'
            ]
        ];
    }

    protected $fillable = [
        'question', 'mini_question','mini_answer','main_page', 'active' , 'views' ,'created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('active' , 1);
    }
    public function scopeAnswered($query)
    {
        return $query->where('answered' , 1);
    }
    public function scopeNotAnswered($query)
    {
        return $query->where('answered' , 0);
    }
    public function getActive()
    {
        return  $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }
    public function getAnswered()
    {
        return  $this->answered == 1 ? 'تمت الإجابة من : ' : 'لم تتم الإجابة بعد';
    }
    public function moderator()
    {
        return $this->belongsTo('App\Models\Moderator', 'moderator_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function answers()
    {
        return $this->hasMany('App\Models\Answer')->orderBy('order','asc');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment','question_id', 'id')->orderBy('id' , 'desc');
    }
    public function file()
    {
        return $this->morphOne('App\Models\File', 'fileable', 'fileable_type', 'fileable_id');
    }
}
