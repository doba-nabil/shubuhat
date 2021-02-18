<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\Media;
use App\Models\Category;
use App\Traits\UploadTrait;

class VideoController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:media-list|media-create|media-edit|media-delete', ['only' => ['index','show']]);
        $this->middleware('permission:media-create', ['only' => ['create','store']]);
        $this->middleware('permission:media-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:media-delete', ['only' => ['destroy' , 'delete_books']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $videos = Media::where('type' , 'video')->orderBy('id', 'desc')->get();
            return view('backend.videos.index', compact('videos'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $categories = Category::whereNull('parent_id')->get();
            return view('backend.videos.create' , compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        try{
            $video = new Media();
            $video->title = $request->title;
            $video->body = $request->body;
            $video->type = 'video';
            $video->kind = $request->kind;
            $video->category_id = $request->category_id;
            if ($request->active) {
                $video->active = 1;
            } else {
                $video->active = 0;
            }
            $video->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/media', $video->id , Media::class, 'main');
            }
            if($request->kind == 0){
                $this->saveFile($request->link, 'pictures/video', $video->id , Media::class, $video->kind);
            }elseif($request->kind == 1){
                $this->saveFile($request->file, 'pictures/video', $video->id , Media::class, $video->kind);
            }
            return redirect()->route('videos.index')->with('done', 'تم الاضافة بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $video = Media::where('slug', $slug)->first();
        if (isset($video)) {
            $string     =  $video->file->link ;
            $search     = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
            $replace    = "youtube.com/embed/$1";
            $url = preg_replace($search,$replace,$string);

            $categories = Category::whereNull('parent_id')->get();
            return view('backend.videos.edit', compact('video' , 'categories' , 'url'));
        } else {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, $id)
    {
        try {
            $video = Media::find($id);
            $video->title = $request->title;
            $video->body = $request->body;
            $video->type = 'video';
            $video->kind = $request->kind;
            $video->category_id = $request->category_id;
            if ($request->active) {
                $video->active = 1;
            } else {
                $video->active = 0;
            }
            $video->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/media', $video->id , Media::class, 'main');
            }
            if ($request->hasFile('file') || $request->link) {
                if($request->kind == 0){
                    $this->editFile($request->link, 'pictures/video', $video->id , Media::class, $video->kind);
                }elseif($request->kind == 1){
                    $this->editFile($request->file, 'pictures/video', $video->id , Media::class, $video->kind);
                }
            }

            return redirect()->route('videos.index')->with('done', 'تم التعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $video = Media::find($id);
            $this->deleteimages($video->id , 'pictures/media/', Media::class);
            $this->deletefiles($video->id , 'pictures/video/');
            $video->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function delete_videos()
    {
        try {
            $videos = Media::orderBy('id' , 'desc')->where('type' , 'video')->get();
            if (count($videos) > 0) {
                foreach ($videos as $video) {
                    $this->deleteimages($video->id , 'pictures/media/', Media::class);
                    $this->deletefiles($video->id , 'pictures/video/');
                    $video->delete();
                }
                return response()->json([
                    'success' => 'Record deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'error' => 'NO Pages TO DELETE'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
     public function delete_image($imgID)
    {
        try{
            $this->deleteimage($imgID , 'pictures/media');
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
}
