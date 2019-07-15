<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Room;
use App\User;
use App\Building;
use App\User_room;
use App\Http\Requests;

class RoomMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        return Datatables::of(Room::query())
        ->rawColumns(['rooms_status','action'])
        ->addColumn('action', function($room) 
        {
            return "<button 
                class='btn btn-sm btn-warning btn-edit'
                value = '".route('room-edit',$room->id)."'> 
               <span class='btn-label'><i class='fa fa-pencil'></i></span>แก้ไข
               </button>  
                    <button 
               class='btn btn-sm btn-danger btn-delete'
                id ='".$room->id."'> 
              <span class='btn-label'><i class='fa fa-pencil'></i></span>ลบ
              </button>";
        })
        ->addColumn('building', function(Room $room) 
        {
            return $room->building->buildings_name;
        })     
        ->addColumn('rooms_status', function ($room) 
        {
            return $room->rooms_status == 1 ? '<label class="label label-success">ใช้งาน</label>' : '<label class="label label-danger">ไม่ใช้งาน</label>';
        })
        
        ->make(true);
    }


    public function index()
    {
       
       $buildings = Building::all();
       return view('room-meeting.index',compact('buildings'));
    }
    public function detail()
    {
       
       $buildings = Building::all();
       return view('room-meeting.room-detail',compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* โมเดล เลือกผู้ดูแลห้อง*/ 
    public function datatables()
    {
        $users = User::select('users.id','users.name','users.username','users.email','roles.name as role')->where('roles.id',2)
                        ->join('user_roles','user_roles.user_id','users.id')
                        ->join('roles','roles.id','user_roles.role_id')
                        ->orderBy('users.id');
        return Datatables::of($users)
                        ->addColumn('check',function($users){
                            return '<div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="'.$users->id.'_'.$users->name.'" name="check[]">
                                            <span class="custom-control-indicator"></span>
                                        
                                        </label>
                                    </div>
                        ';
                        })
                        ->rawColumns(['check'])
                        ->make(true);
    }

    public function datatables_edit($id)
    {
        $users = User::select('users.id','users.name','users.username','users.email','roles.name as role')->where('roles.id',2)
                ->join('user_roles','user_roles.user_id','users.id')
                ->join('roles','roles.id','user_roles.role_id')
                ->orderBy('users.id')->get();
        $user = DB::table('users')->select('users.name','users.id')->join('user_room','users.id','=','user_room.users_id')
                ->where('rooms_id',$id)->get();

        $user = $user->toArray();
        $checkUser = array();
        foreach($user as $key2 => $value2){
            array_push($checkUser, $user[$key2]->name);
        }

        // $users->push($checkUser);

        return Datatables::of($users)
                ->addColumn('check',function($users) use ($checkUser){
                    return '<div class="form-check">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="'.$users->id.'_'.$users->name.'" name="check[]" '.$this->addChecked($users->name,$checkUser).'>
                                    <span class="custom-control-indicator"></span>
                                
                                </label>
                            </div>
                ';
                })
                ->rawColumns(['check'])
                ->make(true);
    }

    public function addChecked($name,$checkUser){
        if (in_array($name, $checkUser)){
            return "checked";
        }else{
            return "";
        }
    }

    public function store(Requests\RoomMeetingCreateRequest $request)
    {
      
        $room_meeting = new Room();
        $room_meeting->rooms_name   = $request->rooms_name;
        $room_meeting->rooms_size   = $request->rooms_size;
        $room_meeting->rooms_detail = $request->rooms_detail;
        $room_meeting->rooms_equipment = $request->rooms_equipment;
        $room_meeting->rooms_status = $request->rooms_status;
        $room_meeting->building_id = $request->building_id;
        $room_meeting->building_floor = $request->building_floor;
        $room_meeting->save();

        $user_id = array();
        $user_id = explode(",",$request->users_room);

        foreach($user_id as $key => $value){
            $user_room = new User_room();
            $user_room->users_id = $value;
            $user_room->rooms_id = $room_meeting->id;
            $user_room->save();
        }

        return response()->json([
            'type' => 'success',
            'text' => 'ระบบได้เพิ่มข้อมูลเรียบร้อย'
        ]);
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
        $room = Room::findOrFail($id);
        $user = DB::table('users')->select('users.name','users.id')->join('user_room','users.id','=','user_room.users_id')
        ->where('rooms_id',$id)->get();
        $merge = array_merge($room->toArray(), $user->toArray());
        return response()->json($merge);
        // return response()->json($user);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\RoomUpdateRequest $request, $id)
    {  
        $room = Room::findOrFail($id);
        $room->rooms_name   =  $request->rooms_name;
        $room->rooms_size   =  $request->rooms_size;
        $room->rooms_equipment =  $request->rooms_equipment;
        $room->rooms_detail =  $request->rooms_detail; 
        $room->rooms_status =  $request->rooms_status;
        $room->building_floor = $request->building_floor;
        $room->save();
       
        DB::table('user_room')->where('rooms_id', $id)->delete();

        $user_id = array();
        $user_id = explode(",",$request->users_room);

        foreach($user_id as $key => $value){
            $user_room = new User_room();
            $user_room->users_id = $value;
            $user_room->rooms_id = $room->id;
            $user_room->save();
        }

    return response()->json([
            'type' => 'success',
            'text' => 'ระบบได้แก้ไขข้อมูลเรียบร้อย'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $room = room::find($request->input('id'));
        if($room->delete()){
           return response()->json([
            'type' => 'success',
            'text' => 'ระบบได้ลบเรียบร้อย'
        ]);
        }else{
            return response()->json([
                'type' => 'error',
               
            ]);
        }
       
       
    }
}
