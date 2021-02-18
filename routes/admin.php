<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
/*******************************************************/
View::creator('backend.layout.navbar', function ($view) {
//    $view->with('eventcount' , \App\Models\Event::count());
});
View::creator('backend.layout.header', function ($view) {
    $view->with('send_question_no', \App\Notification::where('notifiable_type', 'App\Models\Moderator')->
    where('type', 'App\Notifications\SendQuestionNotification')->where('notifiable_id', Auth::user()->id)->count());

    $view->with('question_no', \App\Notification::where('notifiable_type', 'App\Models\Moderator')->
    where('type', 'App\Notifications\OrderNotification')->where('notifiable_id', Auth::user()->id)->count());

    $view->with('comment_no', \App\Notification::where('notifiable_type', 'App\Models\Moderator')->
    where('type', 'App\Notifications\UsercommNotification')->where('notifiable_id', Auth::user()->id)->count());

    $view->with('user_no', \App\Notification::where('notifiable_type', 'App\Models\Moderator')->
    where('type', 'App\Notifications\UserNotification')->where('notifiable_id', Auth::user()->id)->count());

    $view->with('contact_no', \App\Notification::where('notifiable_type', 'App\Models\Moderator')->
    where('type', 'App\Notifications\contactnotification')->where('notifiable_id', Auth::user()->id)->count());

    $view->with('message_no', \App\Notification::where('notifiable_type', 'App\Models\Moderator')->
    where('type', 'App\Notifications\newMessage')->where('notifiable_id', Auth::user()->id)->count());
});
/*************** backend routes *************/
Route::get('admin/login', 'Admin\AdminauthController@showLoginFrom')->name('backendLogin');
Route::post('admin/login', 'Admin\AdminauthController@login');
Route::get('admin', 'Admin\AdminauthController@showLoginFrom');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth:moderator'], function () {
    /****************** auth routes ****************/
    Route::get('/', 'AdminController@index')->name('backend-home');
    /*********** category route ***********/
    Route::resource('categories', 'CategoryController', ['except' => ['show']]);
    Route::get('delete_categories', 'CategoryController@delete_categories')->name('delete_categories');
    Route::get('tree/categories', 'CategoryController@tree')->name('tree_category');
    /*********** end category route ***********/
    /*********** subcategory route ***********/
    Route::resource('subcategories', 'SubcategoryController', ['except' => ['show']]);
    Route::get('delete_subcategories', 'SubcategoryController@delete_categories')->name('delete_subcategories');
    /*********** end category route ***********/
    /*********** subcategory route ***********/
    Route::resource('subsubcategories', 'SubsubcategoryController', ['except' => ['show']]);
    Route::get('delete_subsubcategories', 'SubsubcategoryController@delete_categories')->name('delete_subsubcategories');
    /*********** end category route ***********/
    /*********** comments route ***********/
    Route::resource('comments', 'CommentController', ['only' => ['index', 'show', 'destroy']]);
    Route::get('delete_comments', 'CommentController@delete_comments')->name('delete_comments');
    /*********** end comments route ***********/
    /*********** video route ***********/
    Route::resource('videos', 'VideoController', ['except' => ['show']]);
    Route::get('delete_videos', 'VideoController@delete_videos')->name('delete_videos');
    Route::get('delete_video_image/{imgID}', 'VideoController@delete_image')->name('delete_video_image');
    /*********** end video route ***********/
    /*********** audio route ***********/
    Route::resource('audios', 'AudioController', ['except' => ['show']]);
    Route::get('delete_audios', 'AudioController@delete_audios')->name('delete_audios');
    /*********** end audio route ***********/
    /*********** audio route ***********/
    Route::resource('books', 'BookController', ['except' => ['show']]);
    Route::get('delete_books', 'BookController@delete_books')->name('delete_books');
    Route::get('delete_book_image/{imgID}', 'BookController@delete_image')->name('delete_book_image');
    /*********** end audio route ***********/
    /***********  persons route ***********/
    Route::resource('persons', 'PersonController', ['except' => ['show']]);
    Route::get('delete_persons', 'PersonController@delete_users')->name('delete_persons');
    /*********** end persons route ***********/
    /*********** audio route ***********/
    Route::resource('articles', 'ArticleController', ['except' => ['show']]);
    Route::get('delete_articles', 'ArticleController@delete_articles')->name('delete_articles');
    /*********** end audio route ***********/
    /*********** folders route ***********/
    Route::resource('folders', 'FolderController');
    Route::get('delete_folders', 'FolderController@delete_folders')->name('delete_folders');
    /** displayed files */
    Route::get('folderfiles/{id}/page', 'FolderFileController@create_page')->name('folderfiles_page');
    Route::post('folderfiles/{id}/form', 'FolderFileController@store_form')->name('folderfiles_form');
    Route::resource('folderfiles', 'FolderFileController', ['only' => ['destroy']]);
    Route::get('delete_folderfiles/{id}', 'FolderFileController@delete_folderfiles')->name('delete_folderfiles');
    /*********** end folders route ***********/
    /***********  pages route ***********/
    Route::resource('pages', 'PageController', ['except' => ['show']]);
    Route::get('delete_pages', 'PageController@delete_pages')->name('delete_pages');
    /*********** end pages route ***********/
    /*********** questions route ***********/
    Route::resource('questions', 'QuestionController');
    Route::post('mini_question', 'QuestionController@mini_question')->name('mini_question');
    Route::post('mini_answer', 'QuestionController@mini_answer')->name('mini_answer');
    Route::get('delete_video/{id}', 'QuestionController@delete_video')->name('delete_video');
    Route::get('delete_questions', 'QuestionController@delete_questions')->name('delete_questions');
    /** answers */
    Route::resource('answers', 'AnswerController', ['except' => ['index', 'create', 'edit']]);
    Route::get('delete_answers', 'AnswerController@delete_answers')->name('delete_answers');
    /*********** end questions route ***********/
    /***********  contact route ***********/
    Route::resource('contacts', 'ContactController', ['only' => ['index', 'show', 'destroy']]);
    Route::get('new/contacts', 'ContactController@newContact')->name('new_contact');
    Route::get('delete_contacts', 'ContactController@delete_contacts')->name('delete_contacts');
    /*********** end contact route ***********/
    /***********  options route ***********/
    Route::resource('options', 'OptionController', ['only' => ['edit', 'update']]);
    /*********** end options route ***********/
    /********** subscribe **********/
    Route::get('subscribers', 'subscriberController@subscribers')->name('subscribers');
    Route::get('subscriber/delete/{subid}', 'subscriberController@deleteSub')->name('deleteSub');
    Route::get('email/new', 'subscriberController@emailForm')->name('emailForm');
    Route::post('email/new', 'subscriberController@emailsend');
    //***********  moderator route ***********/
    Route::resource('moderators', 'ModeratorController', ['except' => ['show']]);
    //***********  moderator route ***********/
    //***********  roles route ***********/
    Route::resource('roles', 'RoleController');
    //***********  roles route ***********/
    //***********  roles route ***********/
    Route::post('send_question_moderator', 'QuestionController@send_question_moderator')->name('send_question_moderator');
    //***********  roles route ***********//
    ///***********  question_moderator route ***********/
    Route::get('question_moderator/{slug}', 'QuestionController@question_moderator')->name('question_moderator');
    //***********  question_moderator route ***********/
});
/************* ajax select routes ******************/
Route::get('/ajax-subcats', 'Admin\AdminController@getsubcategories');
Route::post('/dark_mode', 'Admin\AdminController@darkmode');
Route::post('read', 'Admin\AdminController@readNotification');

Route::get('logoutt', function ()
{
    auth()->logout();
    Session()->flush();
    return Redirect::to('admin/login');
})->name('logoutt');

