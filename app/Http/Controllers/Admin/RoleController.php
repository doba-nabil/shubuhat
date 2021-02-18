<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $roles = Role::orderBy('id','DESC')->get();
            return view('backend.roles.index',compact('roles'));
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error','حدث خطأ يرجى المحاولة مرة اخرى');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $permissions = Permission::all();
            return view('backend.roles.create',compact('permissions'));
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error','حدث خطأ يرجى المحاولة مرة اخرى');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'name' => 'required',
                'permission' => 'required',
            ]);


            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));


            return redirect()->route('roles.index')
                ->with('done','تم الاضافة بنجاح');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error','حدث خطأ يرجى المحاولة مرة اخرى');
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
        try{
            $role = Role::find($id);
            $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
                ->where("role_has_permissions.role_id",$id)
                ->get();
            return view('backend.roles.show',compact('role','rolePermissions'));
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error','حدث خطأ يرجى المحاولة مرة اخرى');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $role = Role::find($id);
            $permission = Permission::get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();
            return view('backend.roles.edit',compact('role','permission','rolePermissions'));
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error','حدث خطأ يرجى المحاولة مرة اخرى');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request, [
                'name' => 'required',
                'permission' => 'required',
            ]);

            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();

            $role->syncPermissions($request->input('permission'));

            return redirect()->route('roles.index')
                ->with('done','تم التعديل بنجاح');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error','حدث خطأ يرجى المحاولة مرة اخرى');
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
        try{
            DB::table("roles")->where('id',$id)->where('id' , '!=',2)->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => 'Error try again!'
            ]);
        }
    }
}