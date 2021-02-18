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
$option = \App\Models\Option::find(1);
if($option->active == 1){
    

    Auth::routes(['reset' => false]);
View::creator('frontend.layout.master', function ($view) {
    $view->with('option' , \App\Models\Option::find(1));
});
View::creator('frontend.layout.header', function ($view) {
    $view->with('option' , \App\Models\option::find(1));
    $view->with('categories' , \App\Models\Category::whereNull('parent_id')->orderBy('id' , 'desc')->paginate(5));
    /***** date ****/
    date_default_timezone_set('Africa/Cairo');
    setlocale(LC_TIME, 'ar.utf8');
    $date = Carbon\Carbon::now();
    $view->with('date' , \Alkoumi\LaravelHijriDate\Hijri::DateMediumFormat('ar',$date) . ' - ' . $date->formatLocalized('%d / %m / %Y'));
    /*** end date *****/
});
View::creator('frontend.layout.footer', function ($view) {
    $view->with('option' , \App\Models\option::find(1));
    $view->with('pages' , \App\Models\Page::where('id' , '!=' , 1)->active()->orderBy('id' , 'desc')->get());
});
Route::group(['namespace' => 'User'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('login', 'HomeController@index')->name('home');
    Route::get('register', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');
    /** articles **/
    Route::resource('article', 'ArticleController');
    Route::get('/download/Article/{id}','ArticleController@downloadPDF')->name('article_pdf');
    /** audios **/
    Route::resource('audio', 'AudioController');
    /** audios **/
    Route::resource('video', 'VideoController');
    /** books **/
    Route::resource('book', 'BookController');
    /** contact **/
    Route::get('contact', 'HomeController@contact_page')->name('contact_page');
    Route::post('contact/form', 'HomeController@contact_form')->name('contact_form');
    /** folders **/
    Route::resource('folder', 'FolderController');
    Route::get('pagination/folders', 'FolderController@folders');
    /** questions **/
    Route::resource('question', 'QuestionController');
    Route::post('questions/search', 'QuestionController@catSearch')->name('cat_search');
    Route::get('/download/Question/{id}','QuestionController@downloadPDF')->name('question_pdf');
    Route::post('/comment', 'QuestionController@comment');
    Route::post('favourite_add', 'QuestionController@favourite_add')->name('favourite_add');
    /** categories **/
    Route::resource('category', 'CategoryController');
    Route::post('search/category', 'CategoryController@catSearch')->name('catSearch');
    /** profile **/
    Route::get('profile', 'ProfileController@profile')->name('profile');
    Route::get('terms', 'ProfileController@accept_terms')->name('terms');
    Route::post('send_question', 'ProfileController@send_question')->name('send_question');
    Route::patch('email', 'ProfileController@email')->name('email');
    Route::patch('editprofile', 'ProfileController@editprofile')->name('editprofile');
    Route::delete('/delete/question/{id}', 'ProfileController@delete_question')->name('delete_question');
    Route::delete('/delete/comment/{id}', 'ProfileController@delete_comment')->name('delete_comment');
    /** subscribe **/
    Route::post('/subscribe', 'HomeController@send_email')->name('send');
    /** subscribe **/
    Route::get('/page/{slug}', 'HomeController@page')->name('web_page');
});
 /************ verify ************/
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

}
Route::get('shutdown', 'User\HomeController@shutdown');

 //Clear route cache:
 Route::get('/route-cache', function() {
     $exitCode = Artisan::call('route:cache');
     return 'Routes cache cleared';
 });

 //Clear config cache:
 Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 }); 

// Clear application cache:
 Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return 'Application cache cleared';
 });

 // Clear view cache:
 Route::get('/view-clear', function() {
     $exitCode = Artisan::call('view:clear');
     return 'View cache cleared';
 });

