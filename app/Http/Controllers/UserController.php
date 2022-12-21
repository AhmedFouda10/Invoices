<?php
    
namespace App\Http\Controllers;
    
use DB;
use Hash;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Notifications\CreateUser;
use Spatie\Permission\Models\Role;
use App\Notifications\Add_User_New;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','ASC')->paginate(5);
        return view('users.show_users',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.Add_user',compact('roles'));
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
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles_name' => 'required'
            ],[
               'name.required' => 'برجاء ادخال الاسم',
               'email.required' => 'برجاء ادخال الجيميل',
               'email.unique' => 'هذا الايميل مسجل مسبقا',
               'password.required'=> 'برجاء ادخال الباسورد',
               'password.same' => 'يجب ان يكون نفس الباسورد',
               'roles_name.required' => 'برجاء ادخال نوع الصلاحيه',
            ]);
        
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
        
            $user = User::create($input);
            $user->assignRole($request->input('roles_name'));
    
            // notification users
            // $users=User::latest()->first();
            // $user_all=User::get();
            // Notification::send($user_all,new Add_User_New($users));
            Notification::send($user,new CreateUser($user));
            return redirect()->route('users.index')
                            ->with('success','User created successfully');
        }catch(\Exception $ex){
            return $ex;
            return redirect()->route('users.index')
                            ->with('error','User created successfully');
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
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','تم التعديل بنجاح');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user=User::find($request->user_id);
        $user->delete();
        return redirect()->route('users.index')
                        ->with('success','تم حذف هذا المستخدم بنجاح');
    }
}