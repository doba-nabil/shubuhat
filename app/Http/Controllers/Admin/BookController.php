<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Media;
use App\Models\Category;
use App\Traits\UploadTrait;

class BookController extends Controller
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
            $books = Media::where('type' , 'book')->orderBy('id', 'desc')->get();
            return view('backend.books.index', compact('books'));
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
            return view('backend.books.create' , compact('categories'));
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
    public function store(BookRequest $request)
    {
        try{
            $book = new Media();
            $book->title = $request->title;
            $book->body = $request->body;
            $book->type = 'book';
            $book->category_id = $request->category_id;
            if ($request->active) {
                $book->active = 1;
            } else {
                $book->active = 0;
            }
            $book->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/media', $book->id , Media::class, 'main');
            }
            if ($request->hasFile('file')) {
                $this->saveFile($request->file, 'pictures/books', $book->id , Media::class, 1);
            }
            return redirect()->route('books.index')->with('done', 'تم الاضافة بنجاح');
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
        $book = Media::where('slug', $slug)->first();
        if (isset($book)) {
            $categories = Category::whereNull('parent_id')->get();
            return view('backend.books.edit', compact('book' , 'categories'));
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
    public function update(BookRequest $request, $id)
    {
        try {
            $book = Media::find($id);
            $book->title = $request->title;
            $book->body = $request->body;
            $book->type = 'book';
            $book->category_id = $request->category_id;
            if ($request->active) {
                $book->active = 1;
            } else {
                $book->active = 0;
            }
            $book->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/media', $book->id , Media::class, 'main');
            }
            if ($request->hasFile('file')) {
                $this->editFile($request->file, 'pictures/books', $book->id , Media::class, 1);
            }
            return redirect()->route('books.index')->with('done', 'تم التعديل بنجاح');
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
            $book = Media::find($id);
            $this->deleteimages($book->id , 'pictures/media/', Media::class);
            $this->deletefiles($book->id , 'pictures/books/');
            $book->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function delete_books()
    {
        try {
            $books = Media::orderBy('id' , 'desc')->where('type' , 'book')->get();
            if (count($books) > 0) {
                foreach ($books as $book) {
                    $this->deleteimages($book->id , 'pictures/media/', Media::class);
                    $this->deletefiles($book->id , 'pictures/books/');
                    $book->delete();
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
