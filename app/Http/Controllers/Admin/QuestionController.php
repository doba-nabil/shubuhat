<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\CategoryQuestion;
use App\Models\Moderator;
use App\Models\Question;
use App\Notifications\answernotification;
use App\Notifications\SendQuestionNotification;
use App\Traits\UploadTrait;
use App\User;
use App\Models\File;
use Auth;
use Illuminate\Http\Request;
use App\Models\Category;

class QuestionController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:question-list|question-show|question-create|question-edit|question-delete', ['only' => ['index']]);
        $this->middleware('permission:question-show', ['only' => ['show']]);
        $this->middleware('permission:question-create', ['only' => ['create','store']]);
        $this->middleware('permission:question-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:question-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $questions = Question::orderBy('id', 'DESC')->get();
            return view('backend.questions.index', compact('questions'));
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
            return view('backend.questions.create' , compact('categories'));
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
    public function store(QuestionRequest $request)
    {
        try{
            $question = new Question();
            $question->moderator_id = Auth::user()->id;
            $question->question = $request->question;
            $question->mini_question = $request->mini_question;
            if ($request->active) {
                $question->active = 1;
            } else {
                $question->active = 0;
            }
            $question->save();
            if($request->category_ids){
                foreach ($request->category_ids as $category_id){
                    $category = new CategoryQuestion();
                    $category->category_id = $category_id;
                    $category->question_id = $question->id;
                    $category->save();
                }
            }
            return redirect()->route('questions.index')->with('done', 'تم الاضافة بنجاح');
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
    public function show($slug)
    {
        $question = Question::where('slug' ,$slug)->first();
        if(isset($question)){
            $moderators = Moderator::all();
            return view('backend.questions.show', compact('question' , 'moderators'));
        } else {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $question = Question::where('slug', $slug)->first();
        if (isset($question)) {
            $categories = Category::whereNull('parent_id')->get();
            $cat_questions = CategoryQuestion::where('question_id' , $question->id)->get();
            return view('backend.questions.edit', compact('question' , 'categories' , 'cat_questions'));
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
    public function update(QuestionRequest $request, $id)
    {
        try{
            $question = Question::find($id);
//          $question->moderator_id = Auth::user()->id;
            $question->question = $request->question;
            $question->mini_question = $request->mini_question;
            if ($request->active) {
                $question->active = 1;
            } else {
                $question->active = 0;
            }
            $question->save();
            if($request->category_ids){
                $cat_questions = CategoryQuestion::where('question_id' , $id)->get();
                foreach($cat_questions as $cat_qu){
                    $cat_qu->delete();
                }
                foreach ($request->category_ids as $category_id){
                    $category = new CategoryQuestion();
                    $category->category_id = $category_id;
                    $category->question_id = $question->id;
                    $category->save();
                }
            }
            return redirect()->route('questions.index')->with('done', 'تم التعديل بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function send_question_moderator(Request $request)
    {
        try{
            $moderator = Moderator::find($request->moderator_id);
            $question = Question::find($request->question_id);
            $moderator->notify(new SendQuestionNotification($question));

            return redirect()->back()->with('done', 'تم الارسال بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function question_moderator($slug)
    {
        $question = Question::where('slug' ,$slug)->first();
        if(isset($question)){
            $moderators = Moderator::all();
            return view('backend.questions.moderator_answer', compact('question' , 'moderators'));
        } else {
            return redirect()->route('backend-home')->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
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
            $question = Question::find($id);
            $question->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function delete_questions()
    {
        try {
            $questions = Question::all();
            if (count($questions) > 0) {
                foreach ($questions as $question) {
                    $question->delete();
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
    public function delete_video($id)
    {
        try {
            $video = File::find($id);
            @unlink('pictures/video/' . $video->file);
            $video->delete();
             return redirect()->back()->with('done', 'تم حذف الفيديو بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function mini_question(Request $request)
    {
        try{
            $question = Question::find($request->question_id);
            $question->mini_question = $request->mini_question;
            $question->save();
            return redirect()->back()->with('done', 'تم تعديل اختصار السؤال بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function mini_answer(Request $request)
    {
        try{
            $question = Question::find($request->question_id);
            $question->mini_answer = $request->mini_answer;
            $question->sources = $request->sources;
            $question->kind = $request->kind;
            $question->answered = 1;
            $question->save();
            if ($request->hasFile('file') || $request->link) {
                if($request->kind == 0){
                    $this->editFile($request->link, 'pictures/video', $question->id , Question::class, $question->kind);
                }elseif($request->kind == 1){
                    $this->editFile($request->file, 'pictures/video', $question->id , Question::class, $question->kind);
                }
            }
            return redirect()->back()->with('done', 'تم اضافة ملخص الاجابة بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

}
