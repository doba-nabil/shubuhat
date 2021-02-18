<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Traits\UploadTrait;

class PageController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index','show']]);
        $this->middleware('permission:page-create', ['only' => ['create','store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy' , 'delete_pages']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $pages = Page::orderBy('id', 'desc')->get();
            return view('backend.pages.index', compact('pages'));
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
            return view('backend.pages.create');
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
    public function store(PageRequest $request)
    {

        try{
            $page = new page();
            $page->title = $request->title;
            $page->text = $request->text;
            if ($request->active) {
                $page->active = 1;
            } else {
                $page->active = 0;
            }
            $page->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/pages', $page->id , page::class, 'main');
            }
            return redirect()->route('pages.index')->with('done', 'تم الاضافة بنجاح');
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
        $page = Page::where('slug', $slug)->first();
        if (isset($page)) {
            return view('backend.pages.edit', compact('page'));
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
    public function update(PageRequest $request, $id)
    {
        try {
            $page = Page::find($id);
            $page->title = $request->title;
            $page->text = $request->text;
            if ($request->active) {
                $page->active = 1;
            } else {
                $page->active = 0;
            }
            $page->save();
            if ($request->hasFile('image')) {
                $this->editimage($request->image , 'pictures/pages' , $page->id , Page::class , 'main');
            }
            return redirect()->route('pages.index')->with('done', 'تم التعديل بنجاح');
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
            $page = Page::where('id' , '!=' , 1)->where('id' , $id)->first();
            if($page->id != 1){
                $this->deleteimages($page->id , 'pictures/pages/' , Page::class);
                $page->delete();
            }
           
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }

    }

    public function delete_pages()
    {
        try {
            $pages = Page::where('id' , '!=' , 1)->get();
            if (count($pages) > 0) {
                foreach ($pages as $page) {
                    $this->deleteimages($page->id , 'pictures/pages/' , Page::class);
                    $page->delete();
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
