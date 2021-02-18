<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AudioRequest;
use App\Models\Media;
use App\Models\Category;
use App\Traits\UploadTrait;

class AudioController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:media-list|media-create|media-edit|media-delete', ['only' => ['index','show']]);
        $this->middleware('permission:media-create', ['only' => ['create','store']]);
        $this->middleware('permission:media-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:media-delete', ['only' => ['destroy' , 'delete_audios']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $audios = Media::where('type' , 'audio')->orderBy('id', 'desc')->get();
            return view('backend.audios.index', compact('audios'));
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
            return view('backend.audios.create' , compact('categories'));
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
    public function store(AudioRequest $request)
    {
        try{
            $audio = new Media();
            $audio->title = $request->title;
            $audio->body = $request->body;
            $audio->type = 'audio';
            $audio->kind = $request->kind;
            $audio->category_id = $request->category_id;
            if ($request->active) {
                $audio->active = 1;
            } else {
                $audio->active = 0;
            }
            $audio->save();
            if($request->kind == 0){
                $this->saveFile($request->link, 'pictures/audio', $audio->id , Media::class, $audio->kind);
            }elseif($request->kind == 1){
                $this->saveFile($request->file, 'pictures/audio', $audio->id , Media::class, $audio->kind);
            }
            return redirect()->route('audios.index')->with('done', 'تم الاضافة بنجاح');
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
        $audio = Media::where('slug', $slug)->first();
        if (isset($audio)) {
            $categories = Category::whereNull('parent_id')->get();
            return view('backend.audios.edit', compact('audio' , 'categories'));
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
    public function update(AudioRequest $request, $id)
    {
        try {
            $audio = Media::find($id);
            $audio->title = $request->title;
            $audio->body = $request->body;
            $audio->type = 'audio';
            $audio->kind = $request->kind;
            $audio->category_id = $request->category_id;
            if ($request->active) {
                $audio->active = 1;
            } else {
                $audio->active = 0;
            }
            $audio->save();
            if ($request->hasFile('file') || $request->link) {
                if($request->kind == 0){
                    $this->editFile($request->link, 'pictures/audio', $audio->id , Media::class, $audio->kind);
                }elseif($request->kind == 1){
                    $this->editFile($request->file, 'pictures/audio', $audio->id , Media::class, $audio->kind);
                }
            }

            return redirect()->route('audios.index')->with('done', 'تم التعديل بنجاح');
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
            $audio = Media::find($id);
            $this->deletefiles($audio->id , 'pictures/audio/');
            $audio->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function delete_audios()
    {
        try {
            $audios = Media::orderBy('id' , 'desc')->where('type' , 'audio')->get();
            if (count($audios) > 0) {
                foreach ($audios as $audio) {
                    $this->deletefiles($audio->id , 'pictures/audio/');
                    $audio->delete();
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
}
