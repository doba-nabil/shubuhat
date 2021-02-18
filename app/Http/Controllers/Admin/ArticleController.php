<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Media;
use App\Models\Category;

class ArticleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:media-list|media-create|media-edit|media-delete', ['only' => ['index','show']]);
        $this->middleware('permission:media-create', ['only' => ['create','store']]);
        $this->middleware('permission:media-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:media-delete', ['only' => ['destroy' , 'delete_articles']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $articles = Media::where('type' , 'article')->orderBy('id', 'desc')->get();
            return view('backend.articles.index', compact('articles'));
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
            return view('backend.articles.create' , compact('categories'));
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
    public function store(ArticleRequest $request)
    {
        try{
            $article = new Media();
            $article->title = $request->title;
            $article->body = $request->body;
            $article->type = 'article';
            $article->category_id = $request->category_id;
            if ($request->active) {
                $article->active = 1;
            } else {
                $article->active = 0;
            }
            $article->save();
            return redirect()->route('articles.index')->with('done', 'تم الاضافة بنجاح');
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
        $article = Media::where('slug', $slug)->first();
        if (isset($article)) {
            $categories = Category::whereNull('parent_id')->get();
            return view('backend.articles.edit', compact('article' , 'categories'));
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
    public function update(ArticleRequest $request, $id)
    {
        try {
            $article = Media::find($id);
            $article->title = $request->title;
            $article->body = $request->body;
            $article->type = 'article';
            $article->category_id = $request->category_id;
            if ($request->active) {
                $article->active = 1;
            } else {
                $article->active = 0;
            }
            $article->save();
            return redirect()->route('articles.index')->with('done', 'تم التعديل بنجاح');
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
            $article = Media::find($id);
            $article->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function delete_articles()
    {
        try {
            $articles = Media::orderBy('id' , 'desc')->where('type' , 'article')->get();
            if (count($articles) > 0) {
                foreach ($articles as $article) {
                    $article->delete();
                }
                return response()->json([
                    'success' => 'Record deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'error' => 'NO Articles TO DELETE'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
}
