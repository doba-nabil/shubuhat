<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FolderRequest;
use App\Models\Category;
use App\Models\Folder;
use App\Models\FolderFile;
use App\Models\Media;
use App\Models\Question;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    use UploadTrait ;
    function __construct()
    {
        $this->middleware('permission:folders-list|folders-show|folders-create|folders-edit|folders-delete', ['only' => ['index','show']]);
        $this->middleware('permission:folders-show', ['only' => ['show']]);
        $this->middleware('permission:folders-create', ['only' => ['create','store']]);
        $this->middleware('permission:folders-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:folders-delete', ['only' => ['destroy' , 'delete_folders']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $folders = Folder::orderBy('id' , 'desc')->get();
            return view('backend.folders.index' , compact('folders'));
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $categories = Category::whereNull('parent_id')->get();
            return view('backend.folders.create' , compact('categories'));
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FolderRequest $request)
    {
        try{
            $folder = new Folder();
            $folder->title = $request->title;
            $folder->body = $request->body;
            $folder->startDate = $request->startDate;
            if($request->endDate){
                $folder->endDate = $request->endDate;
            }else{
                $folder->endDate = '9000-01-20';
            }
            if($request->active){$folder->active = 1;}else{$folder->active = 0;}
            $folder->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/folders', $folder->id , Folder::class, 'main');
            }
            return redirect()->route('folders.index')->with('done' , 'تم الاضافة بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $folder = Folder::where('slug' , $slug)->first();
        if(isset($folder)){
            /** articles */
            $article_ids =[];
            $article_files = FolderFile::where('type' , 'article')->where('folder_id' , $folder->id)->get();
            foreach ($article_files as $file){
                array_push($article_ids , $file->media_id);
            }
            $articles = Media::whereIn('id' ,$article_ids)->get();
            /** videos */
            $video_ids =[];
            $video_files = FolderFile::where('type' , 'video')->where('folder_id' , $folder->id)->get();
            foreach ($video_files as $file){
                array_push($video_ids , $file->media_id);
            }
            $videos = Media::whereIn('id' ,$video_ids)->get();
            /** audios */
            $audio_ids =[];
            $audio_files = FolderFile::where('type' , 'audio')->where('folder_id' , $folder->id)->get();
            foreach ($audio_files as $file){
                array_push($audio_ids , $file->media_id);
            }
            $audios = Media::whereIn('id' ,$audio_ids)->get();
            /** books */
            $book_ids =[];
            $book_files = FolderFile::where('type' , 'book')->where('folder_id' , $folder->id)->get();
            foreach ($book_files as $file){
                array_push($book_ids , $file->media_id);
            }
            $books = Media::whereIn('id' ,$book_ids)->get();
            /** questions */
            $question_ids =[];
            $question_files = FolderFile::where('type' , 'question')->where('folder_id' , $folder->id)->get();
            foreach ($question_files as $file){
                array_push($question_ids , $file->question_id);
            }
            $questions = Question::whereIn('id' ,$question_ids)->get();
            return view('backend.folders.show' , compact('folder' , 'articles' , 'videos' , 'audios' ,
                'books' , 'questions'));
        }else{
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $folder = Folder::where('slug' , $slug)->first();
        if(isset($folder)){
            $categories = Category::whereNull('parent_id')->get();
            return view('backend.folders.edit' , compact('folder' , 'categories'));
        }else{
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FolderRequest $request, $id)
    {
        try{
            $folder = Folder::find($id);
            $folder->title = $request->title;
            $folder->body = $request->body;
            $folder->startDate = $request->startDate;
            if($request->endDate){
                $folder->endDate = $request->endDate;
            }else{
                $folder->endDate = '9000-01-20';
            }
            if($request->active){$folder->active = 1;}else{$folder->active = 0;}
            $folder->save();
            if ($request->hasFile('image')) {
                $this->editimage($request->image , 'pictures/folders' , $folder->id , Folder::class , 'main');
            }
            return redirect()->route('folders.index')->with('done' , 'تم التعديل بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $folder = Folder::find($id);
            $this->deleteimages($folder->id , 'pictures/folders/' , Folder::class);
            $folder->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }

    }

    public function delete_folders()
    {
        try{
            $folders = Folder::all();
            if(count($folders) > 0){
                foreach ($folders as $folder){
                    $this->deleteimages($folder->id , 'pictures/folders/', Folder::class);
                    $folder->delete();
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
