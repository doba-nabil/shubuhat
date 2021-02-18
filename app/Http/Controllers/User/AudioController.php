<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function index()
    {
        try{
            $audios = Media::active()->orderBy('id' , 'desc')->where('type' , 'audio')->get();
            return view('frontend.audio.audios' , compact('audios'));
        }catch (\Exception $e){
            return redirect()->back();
        }


    }
}
