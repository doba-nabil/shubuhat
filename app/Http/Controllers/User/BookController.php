<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Session;

class BookController extends Controller
{
    public function index()
    {
        try{
            $books = Media::active()->orderBy('id' , 'desc')->where('type' , 'book')->get();
            return view('frontend.book.books' , compact('books'));
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
    public function show($slug)
    {
        $book = Media::active()->where('slug' , $slug)->where('type' , 'book')->first();
        if(isset($book)){
            $Key = 'blog' . $book->id;
            if (!Session::has($Key)) {
                $booko = Media::find($book->id);
                $booko->views = $booko->views+1;
                $booko->save();
                Session::put($Key, 1);
            }
            return view('frontend.book.book_single' , compact('book'));
        }else {
            return redirect()->back()->with('error' , 'كتاب غير موجود');
        }
    }
}
