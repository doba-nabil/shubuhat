<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonRequest;
use App\Models\City;
use App\Models\Country;
use App\Traits\UploadTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy' , 'delete_persons']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $persons = User::orderBy('id', 'desc')->get();
            return view('backend.persons.index', compact('persons'));
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
            return view('backend.persons.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        try{
            $person = new User();
            $person->name = $request->name;
            $person->email = $request->email;
            $person->phone = $request->phone;
            $person->password = Hash::make($request->password);
            if ($request->active) {
                $person->active = 1;
                $person->email_verified_at = Carbon::now();
                $person->verified = 1;
            } else {
                $person->active = 0;
            }
            $person->save();
            return redirect()->route('persons.index')->with('done', 'تم اضافة المستخدم بنجاح');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = User::where('id' , $id)->first();
        if(isset($person)) {
            return view('backend.persons.edit' , compact('person'));
        } else {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, $id)
    {
        try{
            $person = User::find($id);
            $person->name = $request->name;
            $person->email = $request->email;
            $person->phone = $request->phone;
            if($request->password){
                $person->password = Hash::make($request->password);
            }
            if ($request->active) {
                $person->active = 1;
            } else {
                $person->active = 0;
            }
            $person->save();
            return redirect()->route('persons.index')->with('done', 'تم تعديل المستخدم بنجاح');
        }catch (\Exception $e){
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $person = User::find($id);
            $person->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
    public function delete_persons()
    {
        try {
            $persons = User::orderBy('id' , 'desc')->get();
            if (count($persons) > 0) {
                foreach ($persons as $person) {
                    $person->delete();
                }
                return response()->json([
                    'success' => 'Record deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'error' => 'NO persons TO DELETE'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
}
