<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\subscribe;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class subscriberController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:subscriber-list|subscriber-delete', ['only' => ['subscribers','emailForm' ,
            'emailsend']]);
        $this->middleware('permission:subscriber-delete', ['only' => ['deleteSub']]);
    }
    public function subscribers()
    {
        $subscribers = Subscriber::all();
        return view('backend.subscribers.index', compact('subscribers'));
    }
    public function deleteSub($subid)
    {
        try {
            $subscribers = Subscriber::find($subid);
            $subscribers->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ يرجى المحاولة مرة اخرى');
        }
    }
    public function emailForm()
    {
        return view('backend.subscribers.email');
    }
    public function emailsend(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'msg' => 'required',
        ]);
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber){
            Mail::to($subscriber)->send(new subscribe($request->title, $request->msg));
        }
         session()->flash('done','Sent Successfully');
        return redirect()->back();
    }
}
