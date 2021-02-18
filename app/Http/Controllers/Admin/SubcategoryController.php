<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryRequest;
use App\Models\Category;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    use UploadTrait ;
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:category-list', ['only' => ['index','show']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy' , 'delete_categories']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $categories = Category::whereNotNull('parent_id')->orWhere('parent_id' , '!=' , 0)->orderBy('id' , 'desc')->get();
            return view('backend.subcategories.index' , compact('categories'));
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
            $parents = Category::all();
            return view('backend.subcategories.create' , compact('parents'));
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
    public function store(SubcategoryRequest $request)
    {
        try{
            $category = new Category();
            $category->title = $request->title;
            $category->subtitle = $request->subtitle;
            $category->body = $request->body;
            $category->parent_id = $request->parent_id;
            if($request->active){$category->active = 1;}else{$category->active = 0;}
            $category->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/categories', $category->id , Category::class, 'main');
            }
            return redirect()->route('subcategories.index')->with('done' , 'تم الاضافة بنجاح');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::where('slug' , $slug)->first();
        if(isset($category)){
            $parents = Category::all();
            return view('backend.subcategories.edit' , compact('category' , 'parents'));
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
    public function update(SubcategoryRequest $request, $id)
    {
        try{
            $category = Category::find($id);
            $category->title = $request->title;
            $category->subtitle = $request->subtitle;
            $category->body = $request->body;
            $category->parent_id = $request->parent_id;
            if($request->active){$category->active = 1;}else{$category->active = 0;}
            $category->save();
            if ($request->hasFile('image')) {
                $this->editimage($request->image , 'pictures/categories' , $category->id , Category::class , 'main');
            }
            return redirect()->route('subcategories.index')->with('done' , 'تم التعديل بنجاح');
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
            $category = Category::find($id);
            $this->deleteimages($category->id , 'pictures/categories/', Category::class);
            $category->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }

    }

    public function delete_categories()
    {
        try{
            $categories = Category::whereNotNull('parent_id')->get();
            if(count($categories) > 0){
                foreach ($categories as $category){
                    $this->deleteimages($category->id , 'pictures/categories/', Category::class);
                    $category->delete();
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
