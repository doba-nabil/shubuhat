<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserContactRequest;
use App\Models\Contact;
use App\Models\Folder;
use App\Models\Media;
use App\Models\Moderator;
use App\Models\Option;
use App\Models\Page;
use App\Models\Question;
use App\Models\Subscriber;
use App\Notifications\contactnotification;
use App\Notifications\newMessage;
use Carbon\Carbon;
use Request as Re;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $option = Option::find(1);
        $videos = Media::active()->where('type' , 'video')->orderBy('id' , 'desc')->paginate(5);
        $articles = Media::active()->where('type' , 'article')->orderBy('id' , 'desc')->paginate(5);
        $audios = Media::active()->where('type' , 'audio')->orderBy('id' , 'desc')->paginate(5);
        $books = Media::active()->where('type' , 'book')->orderBy('id' , 'desc')->paginate(5);
        $questions = Question::active()->answered()->orderBy('id' , 'desc')->paginate(50);
        $folders = Folder::active()->where('startDate' , '<=' , Carbon::now())
            ->where('endDate' , '>=' , Carbon::now())->orderBy('id' , 'desc')->get();
        return view('frontend.home' , compact('questions' , 'videos' , 'articles' , 'audios' ,
            'books','folders' , 'option'));
    }
    public function contact_page()
    {
        return view('frontend.contact');
    }
    public function page($slug)
    {
        $page = Page::where('slug' , $slug)->first();
        if(isset($page)){
            return view('frontend.page' ,compact('page'));
        }else {
            return redirect()->back()->with('error', 'حدث خطأ يرجى المحاولة مرة اخرى....');
        }
    }
    public function contact_form(UserContactRequest $request)
    {
        try{
            $contact = new Contact();
            $contact->email = $request->email;
            $contact->name = $request->name;
            $contact->title = $request->title;
            $contact->kind = $request->kind;
            $contact->message = $request->message;
            $contact->save();

            /********* notify main moderator **********/
            $moIds = [];
            $permissions = DB::table('model_has_roles')->where('role_id' , 2)->get();
            foreach($permissions as $per){
                array_push($moIds , $per->model_id);
            }
            $moderators = Moderator::whereIn('id' , $moIds)->get();
            foreach ($moderators as $moderator){
                $moderator->notify(new contactnotification($contact));
            }

            return redirect()->back()->with('done' , 'تم الإرسال بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'حدث خطأ يرجى المحاولة مرة اخرى....');
        }

    }
    /*************** subscribe ************/
    public function send_email()
    {
        $emaill = Re::input('email');
        $found = Subscriber::where('email', $emaill)->get();
        if(count($found) > 0){
            return response()->json(['status' => 'error'], 500);
        }else{
            $email = new Subscriber();
            $email->email = $emaill;
            $email->save();

            /********* notify main moderator **********/
            $moIds = [];
            $permissions = DB::table('model_has_roles')->where('role_id' , 2)->get();
            foreach($permissions as $per){
                array_push($moIds , $per->model_id);
            }
            $moderators = Moderator::whereIn('id' , $moIds)->get();
            foreach ($moderators as $moderator){
                $moderator->notify(new newMessage($email));
            }

            return response()->json(['status' => 'success'], 201);
        }
    }
    
    public function shutdown()
    {
        $option = Option::find(1);
        if($option->active == 1){
            $option->active= 0;
            $option->save();
            return 'shutdown';
        }else{
            $option->active= 1;
            $option->save();
            return 'work normally';
        }
    }
}
