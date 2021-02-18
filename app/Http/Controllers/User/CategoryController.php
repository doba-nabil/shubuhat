<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryQuestion;
use App\Models\Media;
use App\Models\Question;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try{
            $allcategories = Category::active()->orderBy('id' , 'desc')->get();
            $categories = Category::active()->orderBy('id' , 'desc')->whereNull('parent_id')->get();
            return view('frontend.category.categories' , compact('categories' , 'allcategories'));
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
    public function show($slug)
    {
       $category = Category::where('slug' , $slug)->first();
        $videos = Media::active()->where('category_id' , $category->id)->where('type' , 'video')->get();
        $audios = Media::active()->where('category_id' , $category->id)->where('type' , 'audio')->get();
        $books = Media::active()->where('category_id' , $category->id)->where('type' , 'book')->get();
        $articles = Media::active()->where('category_id' , $category->id)->where('type' , 'article')->get();
       if(isset($category)){

           $queIds = [];
           $question_categories = CategoryQuestion::where('category_id' ,$category->id)->get();
           foreach($question_categories as $que_cat){
               array_push($queIds , $que_cat->question_id);
           }
           $questions = Question::active()->answered()->whereIn('id' , $queIds)->get();

            $categories = Category::active()->orderBy('id' , 'desc')->where('parent_id' , $category->id)->get();
            return view('frontend.category.category_single' , compact('category' , 'categories' ,
                'questions','videos' , 'audios' , 'books' , 'articles'));
        }else{
           return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function catSearch(Request $request)
    {
        try{
            $catIds = [];
            $question_categories = CategoryQuestion::all();
            foreach ($question_categories as $cat) {
                array_push($catIds, $cat->category_id);
            }
            $categories = Category::active()->whereIn('id', $catIds)->get();

            $keyword = $request->word;

            $questions = Question::where('mini_question', 'like', "%$keyword%")->orWhere('question', 'like', "%$keyword%")
                ->orWhere('id', 'like', "%$keyword%")->active()->answered();
            $questions = $questions->get();
            return view('frontend.question_search', compact('questions', 'categories' , 'keyword'));
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
}
