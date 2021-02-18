<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
    public function subCategories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    public function childrenTree()
    {
        return $this->subCategories()->with('childrenTree');
    }
    public function mainImage()
    {
        return $this->morphOne('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'main');
    }


    public function videos()
    {
        return $this->hasMany('App\Models\Media' , 'category_id' , 'id')->active()->where('type' , 'video');
    }
    public function audios()
    {
        return $this->hasMany('App\Models\Media' , 'category_id' , 'id')->active()->where('type' , 'audio');
    }
    public function books()
    {
        return $this->hasMany('App\Models\Media' , 'category_id' , 'id')->active()->where('type' , 'book');
    }
    public function articles()
    {
        return $this->hasMany('App\Models\Media' , 'category_id' , 'id')->active()->where('type' , 'article');
    }
}
