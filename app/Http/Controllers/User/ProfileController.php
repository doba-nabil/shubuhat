<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\UserQuestionRequest;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Media;
use App\Models\Moderator;
use App\Notifications\OrderNotification;
use DB;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        try{
            $user = Auth::user();
            $likeIds = [];
            $favourites = Favourite::where('user_id', $user->id)->get();
            foreach ($favourites as $fav){
                array_push($likeIds , $fav->question_id);
            }
            $like_questions = Question::active()->orderBy('id' , 'desc')->whereIn('id' , $likeIds)->get();

            $comments = Comment::where('user_id' , $user->id)->orderBy('id' , 'desc')->get();
            $answered_questions = Question::active()->orderBy('id' , 'desc')->answered()->where('user_id' , Auth::user()->id)->get();
            $not_answered_questions = Question::active()->orderBy('id' , 'desc')->notAnswered()->where('user_id' , Auth::user()->id)->get();
            return view('frontend.profile.profile' , compact('user' , 'answered_questions' ,
                'not_answered_questions' , 'like_questions' , 'comments'));
        }catch (\Exception $e){
            return redirect()->back();
        }
    }
    public function editprofile(EditProfileRequest $request)
    {
        try{
            $user = Auth::user();
            $user->name = $user->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->social_status = $request->social_status;
            $user->religion = $request->religion;
            $user->gender = $request->gender;
            $user->complete = 1;
            $user->save();
            return redirect()->back()->with('done' , 'تم التعديل بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
    public function delete_question($id)
    {
        try {
            $question = question::find($id);
            $question->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
    public function delete_comment($id)
    {
        try {
            $comment = Comment::find($id);
            $comment->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
    public function email(Request $request)
    {
        try{
            $user = Auth::user();
            $user->email = $request->email;
            $user->save();
            return redirect()->back()->with('error' , 'تم تسجيل عنوان البريد بنجاح يرجى التفعيل');
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'حدث خطأ يرجى المحاولة مرة اخرى');
        }
    }
    public function accept_terms()
    {
        try{
            $user = Auth::user();
            $user->terms = 1;
            $user->save();
            return redirect()->back()->with('done' , 'يمكنك ارسال السؤال');
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'حدث خطأ يرجى المحاولة مرة اخرى');
        }
    }
    public function send_question(UserQuestionRequest $request)
    {
        try{
            $user = Auth::user();
            $question = new Question();
            $question->mini_question = $request->mini_question;
            $question->user_id = $user->id;
            $question->question = $request->question;
            $question->save();
            $user->terms = 1;
            $user->save();
            /********* notify main moderator **********/
            $moIds = [];
            $permissions = DB::table('model_has_roles')->where('role_id' , 2)->get();
            foreach($permissions as $per){
                array_push($moIds , $per->model_id);
            }
            $moderators = Moderator::whereIn('id' , $moIds)->get();
            foreach ($moderators as $moderator){
                $moderator->notify(new OrderNotification($question));
            }
            return redirect()->back()->with('done' , 'تم ارسال السؤال بنجاح سيتم الاطلاع وارسال الاجابة قريبا');
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'حدث خطأ يرجى المحاولة مرة اخرى');
        }
    }
}
