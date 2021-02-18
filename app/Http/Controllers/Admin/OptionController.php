<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Option;
use App\Traits\UploadTrait;

class OptionController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:option-edit', ['only' => ['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        //
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
    public function edit($id)
    {
        $option = Option::find(1);
        if (isset($option)) {
            return view('backend.options.edit', compact('option'));
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
    public function update(OptionRequest $request, $id)
    {
        try {
            $option = Option::find($id);
            $option->title = $request->title;
            $option->email = $request->email;
            $option->phone = $request->phone;
            $option->whatsapp = $request->whatsapp;
            $option->banner_title = $request->banner_title;
            $option->banner_link = $request->banner_link;
            $option->footer_text = $request->footer_text;
            $option->facebook = $request->facebook;
            $option->twitter = $request->twitter;
            $option->terms = $request->terms;
            $option->insta = $request->insta;
            $option->youtube = $request->youtube;
            $option->start_at = $request->start_at;
            $option->end_at = $request->end_at;
            $option->folders_link = $request->folders_link;
            $option->save();
            if ($request->hasFile('image')) {
                $this->editimage($request->image, 'pictures/options', 1 , Option::class, 'banner_image');
            }
            if ($request->hasFile('folder_ad')) {
                $this->editimage($request->folder_ad, 'pictures/options', 1 , Option::class, 'folder_ad_image');
            }
            return redirect()->route('options.edit' , 1)->with('done', 'تم التعديل بنجاح');
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
        //
    }
}
