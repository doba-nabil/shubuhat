<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Folder extends Model
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
        'title', 'subtitle','body','image', 'active' , 'parent_id' ,'created_at' , 'updated_at'
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
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function mainImage()
    {
        return $this->morphOne('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'main');
    }
}
