<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryQuestion;
use App\Models\Comment;
use App\Models\Moderator;
use App\Models\Question;
use App\Models\Favourite;
use App\Notifications\UsercommNotification;
use App\User;
use http\Exception;
use PDF;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Request as Re;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class QuestionController extends Controller
{
    public function index()
    {
        try {
            $catIds = [];
            $question_categories = CategoryQuestion::all();
            foreach ($question_categories as $cat) {
                array_push($catIds, $cat->category_id);
            }
            $categories = Category::active()->whereIn('id', $catIds)->get();
            $questions = Question::active()->answered()->orderBy('id', 'desc')->get();
            return view('frontend.question.questions', compact('questions', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function show($slug)
    {
        $question = Question::active()->where('slug', $slug)->first();
        if (isset($question)) {
            $Key = 'question' . $question->id;
            if (!Session::has($Key)) {
                $questiono = Question::find($question->id);
                $questiono->views = $questiono->views+1;
                $questiono->save();
                Session::put($Key, 1);
            }
            return view('frontend.question.question_single', compact('question'));
        } else {
            return redirect()->back()->with('error', 'سؤال غير موجود ....');
        }
    }

    public function comment()
    {
        $comment = new Comment();
        $comment->comment = Re::input('comment');
        $comment->question_id = $adID = Re::input('adID');
        $comment->user_id = Auth::user()->id;
        $comment->save();
        /********* notify main moderator **********/
        $moIds = [];
        $permissions = DB::table('model_has_roles')->where('role_id' , 2)->get();
        foreach($permissions as $per){
            array_push($moIds , $per->model_id);
        }
        $moderators = Moderator::whereIn('id' , $moIds)->get();
        foreach ($moderators as $moderator){
            $moderator->notify(new UsercommNotification($comment));
        }

        $comment->question_id;
        $question = Question::find($comment->question_id);
        if(isset($question->user_id)){
            $user = User::find($question->user_id);
            $user->notify(new UsercommNotification($comment));
        }

        return response()->json(['status' => 'success'], 201);
    }

    public function catSearch(Request $request)
    {
        try {
            $catIds = [];
            $question_categories = CategoryQuestion::all();
            foreach ($question_categories as $cat) {
                array_push($catIds, $cat->category_id);
            }
            $categories = Category::active()->whereIn('id', $catIds)->get();

            $catId = $request->category_id;
            if ($catId == 0) {
                $questions = Question::active()->orderBy('id', 'desc')->get();
            } else {
                $question_categories = CategoryQuestion::where('category_id', $catId)->get();
                $questionIds = [];
                foreach ($question_categories as $cat) {
                    array_push($questionIds, $cat->question_id);
                }
                $questions = Question::active()->orderBy('id', 'desc')->whereIn('id', $questionIds)->get();
            }
            return view('frontend.question.questions', compact('questions', 'categories', 'catId'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function downloadPDF($id) {
        $question = Question::active()->where('id' , $id)->first();
        $pdf= PDF::loadView('frontend.question.question_pdf', compact('question'));
        return $pdf->download($question->mini_question . '.pdf');
    }
    /*********** favourit ************/
    public function favourite_add(Request $request)
    {
        $adID = $request->input('adID');
        $userID = Auth::user()->id;
        $likee = Favourite::where('user_id', $userID)->where('question_id', $adID)->count();

        if ($likee > 0) {
            Favourite::where('user_id', $userID)->where('question_id', $adID)->delete();
            return response()->json(['status' => 'error'], 500);
        } else {
            $like = new Favourite();
            $like->question_id = $adID;
            $like->user_id = $userID;
            $like->save();
            return response()->json(['status' => 'success'], 201);
        };

    }
}
