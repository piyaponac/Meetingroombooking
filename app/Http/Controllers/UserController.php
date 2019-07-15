<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('user.index',compact('roles'));
    }

    public function datatables()
    {
        $users = User::select('users.id','users.name','users.username','users.email','roles.name as role')
                        ->join('user_roles','user_roles.user_id','users.id')
                        ->join('roles','roles.id','user_roles.role_id')
                        ->orderBy('users.id');
        return Datatables::of($users)
                        ->addColumn('action',function($user){
                            // return '<a href="'.route('user-edit',['id'=>$user->id]).'" 
                            //             class="btn btn-sm btn-warning btn-edit">
                            //             <i class="fa fa-edit"></i> แก้ไข
                            //         </a>
                            //         <a href="'.route('user-destroy',['id'=>$user->id]).'" 
                            //         class="btn btn-sm btn-danger .btn-delete">
                            //         <i class="fa fa-edit"></i> ลบ
                            //         </a>
                            //         ';
                            return "<button 
                                    class='btn btn-sm btn-warning btn-edit'
                                    href = '".route('user-edit',['id'=>$user->id])."'> 
                                   <span class='btn-label'><i class='fa fa-pencil'></i></span>แก้ไข
                                   </button>  
                                        <button 
                                   class='btn btn-sm btn-danger btn-delete'
                                    id ='".$user->id."'> 
                                  <span class='btn-label'><i class='fa fa-pencil'></i></span>ลบ
                                  </button>";
                        })
                        ->make(true);
    }

    public function edit($id)
    {
        $user = User::select('users.id','users.name','users.username','users.email','roles.id as role')
                        ->join('user_roles','user_roles.user_id','users.id')
                        ->join('roles','roles.id','user_roles.role_id')
                        ->where('users.id',$id)
                        ->first();
        return response()->json($user);
    }

    public function update(Requests\UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $role = Role::findOrFail($request->role);
        $old_pass = $user->password;
        $input = $request->all();
        if((!Hash::check($input['password'],$old_pass)) && ($input['password'] != ''))
        //เช็คว่าค่าที่ใส่มา เหมือน password เก่า มั้ย ถ้าไม่เหมือนเข้า if

        {
            
            $input['password'] = bcrypt($input['password']);
      
        }
        if($role->id == 1){
            $input['description'] = 'superadmin';
        }elseif($role->id == 2){
            $input['description'] = 'admin';
        }else{
            $input['description'] = 'user';
        }
       
        $user->update($input);
        $user->roles()->detach();
        $user->roles()->attach($role);
        return response()->json([
            'type' => 'success',
            'text' => 'คุณได้ทำการแก้ไขข้อมูลผู้ใช้เรียบร้อยแล้ว'
        ]);
        
    }

    public function create(Requests\UserCreateRequest $request)
    { 
       
      
        $role = Role::findOrFail($request->role);
       
        $input = $request->all();
        if($role->id == 1){
            $input['description'] = 'superadmin';
        }elseif($role->id == 2){
            $input['description'] = 'admin';
        }else{
            $input['description'] = 'user';
        }

        $input['password'] = bcrypt($input['password']);
        
        $user = User::create($input);

       
       
        $user->roles()->attach($role);
        return response()->json([
            'type' => 'success',
            'text' => 'ระบบได้เพิ่มข้อมูลเรียบร้อย'
        ]);
         
     
      
        
    } 
    public function destroy(Request $request)
    {
        $room = User::find($request->input('id'));
        if($room->delete()){
            echo 'ลบข้อมูลเรียบร้อย';
        }
       
       
    }
}
