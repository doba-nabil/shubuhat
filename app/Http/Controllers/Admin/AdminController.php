<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Media;
use App\Models\Moderator;
use App\Models\Question;
use App\Notification;
use App\User;
use Request;
use Response;

class AdminController extends Controller
{
    public function index()
    {
        $answered = Question::where('answered' , 1)->orderBy('id', 'desc')->get();
        $unanswered = Question::where('answered' , 0)->orderBy('id', 'desc')->get();
        $videos = Media::where('type' , 'video')->orderBy('id', 'desc')->get();
        $articles = Media::where('type' , 'aricle')->orderBy('id', 'desc')->get();
        $sounds = Media::where('type' , 'sound')->orderBy('id', 'desc')->get();
        $books = Media::where('type' , 'book')->orderBy('id', 'desc')->get();
        $moderators = Moderator::orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->get();
        return view('backend.home' , compact('answered' , 'unanswered' , 'videos' , 'articles' ,
            'sounds' , 'books' , 'moderators' , 'users'));
    }

    public function getsubcategories()
    {
        $category_id = Request::input('category_id');
        $subcategories = Category::where('parent_id', $category_id)->get();
        return Response::json($subcategories);
    }
    public function getsubsubcategories()
    {
        $subcategory_id = Request::input('subcategory_id');
        $subsubcategories = Category::where('parent_id', $subcategory_id)->get();
        return Response::json($subsubcategories);
    }
    public function getcities()
    {
        $country_id = Request::input('country_id');
        $cities = City::where('country_id', $country_id)->get();
        return Response::json($cities);
    }
    public function darkmode()
    {
        $adID = Request::input('adID');
        $user= Moderator::find($adID);
        if($user->dark_mode == 1){
            $user->dark_mode = 0;
            $user->save();
            return response()->json(['status' => 'error'], 500);
        }else{
            $user->dark_mode = 1;
            $user->save();
            return response()->json(['status' => 'succes'], 201);
        }
    }

    /************ delete not *********/
    public function readNotification()
    {
        $notificationID = Request::input('notificationID');
        $notification = Notification::where('id', $notificationID)->first();
        $notification->delete();
        return response()->json(['status' => 'success'], 201);
    }
}
