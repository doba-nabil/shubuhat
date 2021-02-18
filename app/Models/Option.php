<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'title', 'phone' , 'whatsapp' , 'email' ,'logo' , 'footer_text' , 'facebook' , 'insta' , 'youtube' , 'twitter'
        ,'active','created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function banner_image()
    {
        return $this->morphOne('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'banner_image');
    }
    public function folder_ad()
    {
        return $this->morphOne('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'folder_ad_image');
    }

}
