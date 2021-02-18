<?php

namespace App\Traits;

use App\Models\File;
use App\Models\Image;

Trait UploadTrait
{
    /************ upload main image ******************/
    function saveimage($image , $folder , $imageable_id , $imageable_type , $type)
    {
        $albumImage = new Image();
        $fileimagename = time() . '-' . $image->getClientOriginalName();
        $path = $folder;
        $image->move($path , $fileimagename);
        $albumImage->imageable_id = $imageable_id;
        $albumImage->imageable_type = $imageable_type;
        $albumImage->type = $type;
        $albumImage->image = $fileimagename;
        $albumImage->save();
    }
    /************ edit main image ******************/
    function editimage($image , $folder , $imageable_id , $imageable_type , $type)
    {
        $imagee = Image::where('imageable_type' , $imageable_type)->where('type', $type)->where('imageable_id' , $imageable_id)->first();
        if(isset($imagee)){
            @unlink($folder.'/'. $imagee->image);
            $imagee->delete();
        }
        $albumImage = new Image();
        $fileimagename = time() . '-' . $image->getClientOriginalName();
        $path = $folder;
        $image->move($path , $fileimagename);
        $albumImage->imageable_id = $imageable_id;
        $albumImage->imageable_type = $imageable_type;
        $albumImage->type = $type;
        $albumImage->image = $fileimagename;
        $albumImage->save();
    }
    /******* upload multi images *************/
    function saveimages($images , $folder , $imageable_id , $imageable_type , $type)
    {
        foreach ($images as $image){
            $albumImage = new Image();
            $filename = time() . '--' . $image->getClientOriginalName();
            $path = $folder;
            $image->move($path , $filename);
            $albumImage->imageable_id = $imageable_id;
            $albumImage->imageable_type = $imageable_type;
            $albumImage->type = $type;
            $albumImage->image = $filename;
            $albumImage->save();
        }
    }
     /**************** delete and unlink one image ************/
    function deleteimage($id  , $path)
    {
        $image = Image::where('id' , $id)->first();
        @unlink($path .'/'. $image->image);
        $image->delete();
    }
    /**************** delete and unlink images ************/
    function deleteimages($id , $path , $imageable_type)
    {
        $images = Image::where('imageable_id' , $id)->where('imageable_type' , $imageable_type)->get();
        foreach($images as $image){
            @unlink($path . $image->image);
            $image->delete();
        }
    }
    /************ upload media ******************/
    function saveFile($file , $folder , $fileable_id , $fileable_type , $kind)
    {
        if($kind == 0){
            $fileInfo = new File();
            $fileInfo->fileable_id = $fileable_id;
            $fileInfo->fileable_type = $fileable_type;
            $fileInfo->link = $file;
            $fileInfo->save();
        }elseIf($kind == 1){
            $fileInfo = new File();
            $fileinfoname = time() . '-' . $file->getClientOriginalName();
            $path = $folder;
            $file->move($path , $fileinfoname);
            $fileInfo->fileable_id = $fileable_id;
            $fileInfo->fileable_type = $fileable_type;
            $fileInfo->file = $fileinfoname;
            $fileInfo->save();
        }
    }
    /************ edit media ******************/
    function editFile($file , $folder , $fileable_id , $fileable_type , $kind)
    {
        if($kind == 0){
            $filee = File::where('fileable_id' , $fileable_id)->where('fileable_type' , $fileable_type)->first();
            if(isset($filee)){
                @unlink($folder.'/'. $filee->file);
                $filee->delete();
            }
            $fileInfo = new File();
            $fileInfo->fileable_id = $fileable_id;
            $fileInfo->fileable_type = $fileable_type;
            $fileInfo->link = $file;
            $fileInfo->save();
        }elseIf($kind == 1){
            $filee = File::where('fileable_id' , $fileable_id)->first();
            if(isset($filee)){
                @unlink($folder.'/'. $filee->file);
                $filee->delete();
            }
            $fileInfo = new File();
            $fileinfoname = time() . '-' . $file->getClientOriginalName();
            $path = $folder;
            $file->move($path , $fileinfoname);
            $fileInfo->fileable_id = $fileable_id;
            $fileInfo->fileable_type = $fileable_type;
            $fileInfo->file = $fileinfoname;
            $fileInfo->save();
        }
    }
    /************ delete media ******************/
    function deletefiles($id , $path)
    {
        $files = File::where('fileable_id' , $id)->get();
        foreach($files as $file){
            @unlink($path . $file->file);
            $file->delete();
        }
    }
}
