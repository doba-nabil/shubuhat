<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Media;
use PDF;
use Illuminate\Http\Request;
use Session;

class ArticleController extends Controller
{
    public function index()
    {
        try{
            $articles = Media::active()->orderBy('id' , 'desc')->where('type' , 'article')->get();
            return view('frontend.article.articles' , compact('articles'));
        }catch (\Exception $e){
            return redirect()->back();
        }
    }
    public function show($slug)
    {
        try{
            $article = Media::active()->orderBy('id' , 'desc')->where('slug' , $slug)->first();
            $Key = 'blog' . $article->id;
            if (!Session::has($Key)) {
                $articlo = Media::find($article->id);
                $articlo->views = $articlo->views+1;
                $articlo->save();
                Session::put($Key, 1);
            }
            return view('frontend.article.article_single' , compact('article'));
        }catch (\Exception $e){
            return redirect()->back();
        }
    }
    public function downloadPDF($id) {
        $article = Media::active()->where('id' , $id)->first();
        $pdf= PDF::loadView('frontend.article.article_pdf', compact('article'));
        return $pdf->download($article->title . '.pdf');
    }
}
