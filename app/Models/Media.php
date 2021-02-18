<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Media extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'title','body','image', 'active' ,'kind', 'type' , 'category_id' ,'created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('active' , 1);
    }
    public function getActive()
    {
        return  $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }
    public function getVideoKind()
    {
        return  $this->kind == 1 ? 'ملف فيديو' : 'رابط يوتيوب';
    }
    public function getAudioKind()
    {
        return  $this->kind == 1 ? 'ملف صوت' : 'رابط SoundCloud';
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function mainImage()
    {
        return $this->morphOne('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'main');
    }
    public function file()
    {
        return $this->morphOne('App\Models\File', 'fileable', 'fileable_type', 'fileable_id');
    }
}
