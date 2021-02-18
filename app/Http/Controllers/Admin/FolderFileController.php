<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\FolderFile;
use App\Models\Media;
use App\Models\Question;
use Illuminate\Http\Request;

class FolderFileController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:question-show', ['only' => ['create_page' , 'store_form' ,
            'delete_folderfiles' , 'destroy']]);
    }
    public function create_page($id)
    {
        $folder = Folder::where('id' , $id)->first();
        if(isset($folder)){
            $article_ids =[];
            $article_files = FolderFile::where('type' , 'article')->where('folder_id' , $folder->id)->get();
            foreach ($article_files as $file){
                array_push($article_ids , $file->media_id);
            }
            /** videos */
            $video_ids =[];
            $video_files = FolderFile::where('type' , 'video')->where('folder_id' , $folder->id)->get();
            foreach ($video_files as $file){
                array_push($video_ids , $file->media_id);
            }
            /** audios */
            $audio_ids =[];
            $audio_files = FolderFile::where('type' , 'audio')->where('folder_id' , $folder->id)->get();
            foreach ($audio_files as $file){
                array_push($audio_ids , $file->media_id);
            }
            /** books */
            $book_ids =[];
            $book_files = FolderFile::where('type' , 'book')->where('folder_id' , $folder->id)->get();
            foreach ($book_files as $file){
                array_push($book_ids , $file->media_id);
            }
            /** questions */
            $question_ids =[];
            $question_files = FolderFile::where('type' , 'question')->where('folder_id' , $folder->id)->get();
            foreach ($question_files as $file){
                array_push($question_ids , $file->question_id);
            }

           $articles = Media::whereNotIn('id' , $article_ids)->where('type' , 'article')->get();
           $videos = Media::whereNotIn('id' , $video_ids)->where('type' , 'video')->get();
           $audios = Media::whereNotIn('id' , $audio_files)->where('type' , 'audio')->get();
           $books = Media::whereNotIn('id' , $book_ids)->where('type' , 'book')->get();
           $questions = Question::whereNotIn('id' , $question_ids)->get();
            return view('backend.folderfiles.create' , compact('folder' , 'articles' , 'videos' , 'audios' ,
                'books' , 'questions'));
        }else{
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function store_form(Request $request , $id)
    {
        try{
            $folder = Folder::find($id);
            if($request->video_ids){
                foreach ($request->video_ids as $videoId){
                    $video_file = new FolderFile();
                    $video_file->type = 'video';
                    $video_file->folder_id = $folder->id;
                    $video_file->media_id = $videoId;
                    $video_file->save();
                }
            }
            if($request->audio_ids){
                foreach ($request->audio_ids as $audioId){
                    $audio_file = new FolderFile();
                    $audio_file->type = 'audio';
                    $audio_file->folder_id = $folder->id;
                    $audio_file->media_id = $audioId;
                    $audio_file->save();
                }
            }
            if($request->book_ids){
                foreach ($request->book_ids as $bookId){
                    $book_file = new FolderFile();
                    $book_file->type = 'book';
                    $book_file->folder_id = $folder->id;
                    $book_file->media_id = $bookId;
                    $book_file->save();
                }
            }
            if($request->article_ids){
                foreach ($request->article_ids as $articleId){
                    $article_file = new FolderFile();
                    $article_file->type = 'article';
                    $article_file->folder_id = $folder->id;
                    $article_file->media_id = $articleId;
                    $article_file->save();
                }
            }
            if($request->question_ids){
                foreach ($request->question_ids as $questionId){
                    $question_file = new FolderFile();
                    $question_file->type = 'question';
                    $question_file->folder_id = $folder->id;
                    $question_file->question_id = $questionId;
                    $question_file->save();
                }
            }
            return redirect()->route('folders.show' , $folder->slug)->with('done' , 'تم الاضافة بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function destroy($id)
    {
        try{
            $folder_file = FolderFile::find($id);
            $folder_file->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function delete_folderfiles($id)
    {
        try{
            $folderfiles = FolderFile::where('folder_id' , $id)->get();
            if(count($folderfiles) > 0){
                foreach ($folderfiles as $folderfile){
                    $folderfile->delete();
                }
                return response()->json([
                    'success' => 'Record deleted successfully!'
                ]);
            }else{
                return response()->json([
                    'error' => 'NO EVENTS TO DELETE'
                ]);
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
}
