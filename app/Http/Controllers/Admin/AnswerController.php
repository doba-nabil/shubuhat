<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Notifications\answernotification;
use App\User;
use Auth;
use Carbon\Carbon;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->back()->with('error', 'صفحة غير موجودة');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back()->with('error', 'صفحة غير موجودة');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        try{
            $answer = new Answer();
            $answer->answer = $request->answer;
            $answer->title = $request->title;
            $answer->order = $request->order;
            $answer->question_id = $request->question_id;
            $answer->save();

            $question = Question::find($request->question_id);
            if($question->answered != 1){
                $user = User::find($question->user_id);
                if(isset($user)){
                    $user->notify(new answernotification($question));
                }
            }

            $question->answered = 1;
            $question->answered_by = Auth::user()->name;
            $question->answered_date = Carbon::now()->format('d-m-Y') ;
            $question->save();

            $qu_slug = $question->slug;
            return redirect()->route('question_moderator' , $qu_slug)->with('done', 'تم الاضافة بنجاح');
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
        try{
            $answer = Answer::find($id);
            return view('backend.answers.show', compact('answer'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->back()->with('error', 'صفحة غير موجودة');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerRequest $request, $id)
    {
        try{
            $answer = Answer::find($id);
            $answer->answer = $request->answer;
            $answer->title = $request->title;
            $answer->order = $request->order;
            $answer->question_id = $request->question_id;
            $answer->save();

            $question = Question::find($request->question_id);
            $question->answered = 1;
            $question->save();
            $qu_slug = $question->slug;
            return redirect()->route('questions.show' , $qu_slug)->with('done', 'تم تعديل العنصر بنجاح');
        }catch (\Exception $e){
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
            $answer = Answer::find($id);
            $answer->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    public function delete_answers()
    {
        try {
            $answers = Answer::all();
            if (count($answers) > 0) {
                foreach ($answers as $answer) {
                    $answer->delete();
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
