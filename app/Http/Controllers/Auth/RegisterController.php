<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\Models\Moderator;
use App\Notifications\UserNotification;
use App\Providers\RouteServiceProvider;
use App\User;
use App\VerifyUser;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        session()->flash('done', 'تم التسجيل بنجاح يرجى اكمال البيانات في الصفحة الشخصية');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
        \Mail::to($user->email)->send(new VerifyMail($user));

        $moIds = [];
        $permissions = DB::table('model_has_roles')->where('role_id' , 1)->get();
        foreach($permissions as $per){
            array_push($moIds , $per->model_id);
        }
        $moderators = Moderator::whereIn('id' , $moIds)->get();
        foreach ($moderators as $moderator){
            $moderator->notify(new UserNotification($user));
        }

        return $user;

        return $user;
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->email_verified_at = Carbon::now();
                $verifyUser->user->save();
                $status = " البريد الخاص بك مفعل يمكنك تسجيل الدخول.";
            } else {
                $status = "بريدك مفعل من قبل يمكنك تسجيل الدخول";
            }
        } else {
            return redirect('/')->with('error', "بريد خاطئ.");
        }
        return redirect('/')->with('done', $status);
    }

    protected function registered()
    {
        $this->guard()->logout();
        return redirect('/')->with('done', 'تم ارسال كود التفعيل يرجى التأكد من بريدك الخاص');
    }
}
