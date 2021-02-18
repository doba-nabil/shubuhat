<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\FolderFile;
use App\Models\Media;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function __construct()
    {
        $this->data = Folder::active()->orderBy('id' , 'desc')->
        where('startDate','<=' , Carbon::now())->
        where('endDate','>=' , Carbon::now())->paginate(6);
        \View::share('data', $this->data);
    }

    public function index()
    {
        return view('frontend.folder.folders');
    }

    function folders()
    {
        return view('frontend.folder.pagination_data')->render();
    }
    function show($slug)
    {
        $folder = Folder::active()->where('slug' , $slug)->first();
        if(isset($folder)){

            $videoIds = [];
            $folder_file_videos = FolderFile::where('folder_id' , $folder->id)->where('type' , 'video')->get();
            foreach ($folder_file_videos as $folder_file){
                array_push($videoIds , $folder_file->media_id);
            }
            $videos = Media::whereIn('id' , $videoIds)->active()->get();

            $audioIds = [];
            $folder_file_audios = FolderFile::where('folder_id' , $folder->id)->where('type' , 'audio')->get();
            foreach ($folder_file_audios as $folder_file){
                array_push($audioIds , $folder_file->media_id);
            }
            $audios = Media::whereIn('id' , $audioIds)->active()->get();

            $articleIds = [];
            $folder_file_articles = FolderFile::where('folder_id' , $folder->id)->where('type' , 'article')->get();
            foreach ($folder_file_articles as $folder_file){
                array_push($articleIds , $folder_file->media_id);
            }
            $articles = Media::whereIn('id' , $articleIds)->active()->get();

            $bookIds = [];
            $folder_file_books = FolderFile::where('folder_id' , $folder->id)->where('type' , 'book')->get();
            foreach ($folder_file_books as $folder_file){
                array_push($bookIds , $folder_file->media_id);
            }
            $books = Media::whereIn('id' , $bookIds)->active()->get();

            $questionIds = [];
            $folder_file_questions = FolderFile::where('folder_id' , $folder->id)->where('type' , 'question')->get();
            foreach ($folder_file_questions as $folder_file){
                array_push($questionIds , $folder_file->question_id);
            }
            $questions = Question::whereIn('id' , $questionIds)->active()->get();

            return view('frontend.folder.folder_single' ,compact('folder' , 'videos' ,
                'audios' , 'articles' , 'books' , 'questions'));
        }else{
            return redirect()->back();
        }
    }
}
