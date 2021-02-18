<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        try{
            $videos = Media::active()->orderBy('id' , 'desc')->where('type' , 'video')->get();
            return view('frontend.video.videos' , compact('videos'));
        }catch (\Exception $e){
            return redirect()->back();
        }
    }
}
