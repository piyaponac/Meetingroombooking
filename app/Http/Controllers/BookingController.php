<?php

namespace App\Http\Controllers;


use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Room;
use App\User_room;
use App\User;
use App\Building;
use Illuminate\Support\Facades\DB;

use App\Booking;




class BookingController extends Controller
{


    protected function check_time_period($startTime,$endTime,$chkStartTime,$chkEndTime)
    {
                if($chkStartTime > $startTime && $chkEndTime < $endTime)
                {
                    return true;
                    //echo "ช่วงเวลาที่ต้องการเช็คอยู่ในช่วง เวลาเริ่มต้น-สิ้นสุด ทั้งหมด";
                }
                elseif(($chkStartTime > $startTime && $chkStartTime < $endTime) || ($chkEndTime > $startTime && $chkEndTime < $endTime))
                {
                    return true;
                    //echo "ช่วงเวลาที่ต้องการเช็คมีบางช่วงอยู่ในช่วงของ เวลาเริ่มต้น-สิ้นสุด";
                }
                elseif($chkStartTime==$startTime || $chkEndTime==$endTime)
                {
                    return true;
                // echo "ช่วงเวลาที่ต้องการเช็คอยู่บนขอบของ เวลาเริ่มต้น-สิ้นสุด";
                }
                elseif($startTime > $chkStartTime && $endTime < $chkEndTime)
                {
                    return true;
                // echo "ช่วงเวลาเริ่มต้น-สิ้นสุด อยู่ในช่วงเวลาที่ต้องการเช็คทั้งหมด";
                }
                else
                {
                    return false;
                // echo "ช่วงเวลาที่ต้องการเช็ค กับ ช่วงเวลาเริ่มต้น-สิ้นสุด ไม่ได้มีการคาบเกี่ยวกัน";
                }
    }
   

    public function building()
    {
        $building = Building::where('status',1)
      
        ->get();
        return Datatables::of($building)
                    ->addColumn('action',function($building){

                        return "<button class='btn btn-sm btn-info btn-select'
                                value = '".route('select-building',$building->id)."'> 
                                <i class='fa fa-check'></i>เลือก
                                </button>";
                    })
                    ->make(true);

    }



    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      if($request->from_time != '' && $request->to_time != '' && $request->booking_dates != '')
      {
    //    $data = DB::table('bookings')
    //      ->whereBetween('booking_date', array($request->from_date, $request->to_date))
    //      ->get();
   

            $bookings = Booking::select('rooms_id','booking_begin','booking_end')
            ->where(['booking_date'=> $request->booking_dates])
            ->get();
            $rooms_id = [];
            foreach($bookings as $booking)
            {
            if($this->check_time_period(date('H:i',strtotime($booking->booking_begin)),date('H:i',strtotime($booking->booking_end)),$request->from_time,$request->to_time))
            {
                    $rooms_id[] = $booking->rooms_id;
            }
            }
           
            if($request->buildings_id != ''){
                $buil     = DB::table('buildings')
                ->join('rooms','buildings.id','=','rooms.building_id')
                 ->where('buildings.id', $request->buildings_id)
                ->select(['rooms.rooms_name','buildings_name','rooms.rooms_equipment','rooms.rooms_size'])
                ->whereNotIn('rooms.id',$rooms_id)
                ->groupBy('rooms.rooms_name','buildings_name','rooms.rooms_equipment','rooms.rooms_size')
                ->get();
            }else{
                $buil   = DB::table('buildings')
                ->join('rooms','buildings.id','=','rooms.building_id')
                ->select(['rooms.rooms_name','buildings_name','rooms.rooms_equipment','rooms.rooms_size'])
                ->whereNotIn('rooms.id',$rooms_id)
                ->groupBy('rooms.rooms_name','buildings_name','rooms.rooms_equipment','rooms.rooms_size')
                ->get();
            }   

            if($request->buildings_id != '' && $request->room_id != ''){
                $buil  = DB::table('buildings')
                ->join('rooms','buildings.id','=','rooms.building_id')
                 ->where('rooms.id', $request->room_id)
                ->select(['rooms.rooms_name','buildings_name','rooms.rooms_equipment','rooms.rooms_size'])
                ->whereNotIn('rooms.id',$rooms_id)
                ->groupBy('rooms.rooms_name','buildings_name','rooms.rooms_equipment','rooms.rooms_size')
                ->get();
            }
               
        
            // $data = Room::where('rooms_status',1)
            //     // ->where('building_id',$building)
            //     ->whereNotIn('id',$rooms_id)
            //     ->get();
        }
     
     return response($buil);
     }
    }

    
    public function room($date,$time_begin,$time_end,$building)
    {
    

    $bookings = Booking::select('rooms_id','booking_begin','booking_end')
        ->where(['booking_date'=> $date])
        ->get();
        $rooms_id = [];
        foreach($bookings as $booking)
        {
           if($this->check_time_period(date('H:i',strtotime($booking->booking_begin)),date('H:i',strtotime($booking->booking_end)),$time_begin,$time_end))
           {
                $rooms_id[] = $booking->rooms_id;
           }
       }

        $room = Room::where('rooms_status',1)
            ->where('building_id',$building)
            ->whereNotIn('id',$rooms_id)
            ->get();
        return Datatables::of($room)
                        ->addColumn('action',function($room){

                            return "<button class='btn btn-sm btn-info btn-select'
                                    value = '".route('select-room',$room->id)."'> 
                                    <i class='fa fa-check'></i>เลือก
                                    </button>";
                        })
                        ->make(true);
       
    }

    public function selectRoom($id)
    {
        $room=Room::findOrFail($id);
        return response()->json($room);
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkUser($id)
    {
        $check = Booking::where(['id' => $id,'user_id' => Auth::user()->id,'booking_status' => 2])->first();
                    
        if(!empty($check->id))
        {
            return response()->json(['check'=>true]);
        }
        else 
        {
            return response()->json(['check'=>false]);
        }
       
    }
    public function index()
    {
      
        // dd($checkUser);
        // $buildings = Building::all()->where('status',1);
        $listsUser = Booking::all();
        if(!Auth::guest()){
        $lists = Booking::all()->whereNotIn('user_id',Auth::user()->id);
        $listsUser = Booking::all()->where('user_id',Auth::user()->id);
        }
       
        
        $events = [];
        if(!Auth::guest()){

             $status_color = [
            0 => '#f9aea2', //red จางงงงงง
            1 => '#8ae28a', //green
            2 => '#ffdbb7' //orange
           
        ];
        }  
            $status_color2 = [
            0 => '#f56954', //red
            1 => '#00CC00', //green
            2 => '#FF9933' //orange
        ];
        if(!Auth::guest()){
        foreach($lists as $list)
        {
         
            $day_s = $list->booking_date.' '.$list->booking_begin;
            $day_e = $list->booking_date.' '.$list->booking_end;

            $name =  $list->user_id;
            $users = DB::table('users')
            ->select('name')->where(['id' => $name ])->first();
         
            $events[] = [
                'id' => $list->id,
                'title' =>  $list->booking_title,
                'name' =>  $users->name,
                'start' =>  $day_s,
                'end'   => $day_e,  
                'num'   => $list->booking_num,
                'room'  => $list->rooms->rooms_name,
                'time'  => date('H:i',strtotime($list->booking_begin)).' - '.date('H:i',strtotime($list->booking_end)),
                'backgroundColor' => $status_color[$list->booking_status],
                'borderColor'  => $status_color[$list->booking_status] 
            ];
           
            }
          
        }
        
        foreach($listsUser as $list)
        {
         
            $day_s = $list->booking_date.' '.$list->booking_begin;
            $day_e = $list->booking_date.' '.$list->booking_end;

            $name =  $list->user_id;
            $users = DB::table('users')
            ->select('name')->where(['id' => $name ])->first();
         
            $events[] = [
                'id' => $list->id,
                'title' =>  $list->booking_title,
                'name' =>  $users->name,
                'start' =>  $day_s,
                'end'   => $day_e,  
                'num'   => $list->booking_num,
                'room'  => $list->rooms->rooms_name,
                'time'  => date('H:i',strtotime($list->booking_begin)).' - '.date('H:i',strtotime($list->booking_end)),
                'backgroundColor' => $status_color2[$list->booking_status],
                'borderColor'  => $status_color2[$list->booking_status] 
            ];
         
            

          
      
    }   
        
         
         $buildings = Building::all()->where('status',1);
        return view('booking.index',compact('events','buildings'));
    }
     public function selectRoombuilding(Request $request)
    {
        $building =  $request->get('select');
        $result   =  array();
        $room     = DB::table('buildings')
                    ->join('rooms','buildings.id','=','rooms.building_id')
                    ->select(['rooms.rooms_name','rooms.id'])
                    ->where('buildings.id', $building)
                    ->groupBy('rooms.rooms_name','rooms.id')
                    ->get();
                    $output = ' <option value ="">เลือกห้อง</option>';
                    foreach($room as $row){
                    $output.='<option value="'.$row->id.'">'.$row->rooms_name.'</option>';
                    }
                   
           return response($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buildings = Building::all()->where('status',1);
        return view('booking.create',compact('buildings'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\BookingRequest $request)
    {
        $input = $request->all();
        $input['user_id']= Auth::user()->id;
        $booking = Booking::create($input);
        
        $booking->update(['booking_owner_id' => $booking->id]);
        return response()->json([
            'type' => 'success',
            'text' => 'บันทึกข้อมูลการจองห้องประชุมเรียบร้อย'
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
        
        $booking = Booking::findOrFail($id);
        $buildings = Building::all()->where('status',1);
      
        return view('booking.edit',compact('booking','buildings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\BookingRequest $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $input = $request->all();
        $booking->update($input);
        Booking::where('id')->update([
            'booking_date' => $input['booking_date'],
            'booking_begin' => $input['booking_begin'],
            'rooms_id' => $input['rooms_id'],
            
            'booking_end' => $input['booking_end'],
            'building_id' => $input['building_id'],
            'booking_title' => $input['booking_title'],
            'booking_num' => $input['booking_num'],
            'booking_detail' => $input['booking_detail'],
        ]);
      
        return response()->json([
            'type' => 'success',
            'text' => 'แก้ไขข้อมูลเรียบร้อยแล้วครับ'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        Booking::where('booking_owner_id',$booking->booking_owner_id)->delete();
        return response()->json([
            'type' => 'success',
            'text' => 'คุณได้ทำการลบเรียบร้อยแล้ว'
        ]);
    }

    public function addDay($id)
    {
        $buildings = Building::all()->where('status',1);
        $booking = Booking::findOrFail($id);
        $list_day = Booking::where('booking_owner_id',$booking->booking_owner_id)->get();
        return view('booking.add_day',compact('booking','list_day','buildings'));

    }

    public function addDayPost(Requests\BookingRequest $request, $id)
    {
        $input = $request->all();
        $id_owner = Booking::where('id',$id)->first();
        $check_unique_date = Booking::where([
            'booking_owner_id' => $id_owner->booking_owner_id,
            'booking_date'     => $input['booking_date']
        ])->first();

        if(empty($check_unique_date))
        {
        $input['user_id'] = Auth::user()->id;
        $input['booking_status'] = 2;
        $input['booking_owner_id'] = $id_owner->booking_owner_id;

        Booking::create($input);
        return response()->json([
            'type' => 'success',
            'text' => 'เพิ่มวันเรียบร้อย'
        ]);
        }else
            {
            return response()->json([
                'type' => 'error',
                'text' => 'จองวันซ้ำ กรุณาทำรายการใหม่'   
            ]);
        }

        
    }

    public function approve()
    {
        return view('booking.approve');
    }

     public function approveData()
    {
        $checkRoles = DB::table('user_roles')->select('user_roles.role_id')->where('user_roles.user_id',Auth::user()->id)->get();
        if($checkRoles[0]->role_id == 1){
            $booking = Booking::with(['rooms','user_room'])->select('bookings.*',)->where(['booking_status' => 2]);
        }else{
            $userRoom = User_room::select('rooms_id')->where('users_id',Auth::user()->id)->get();
            $rooms = array();
            foreach($userRoom as $key => $value){
                array_push($rooms, $userRoom[$key]->rooms_id);
            }
            $booking = Booking::with(['rooms','user_room'])->select('bookings.*',)->whereIn('rooms_id', $rooms)->where(['booking_status' => 2]);
        }
        return Datatables::of($booking)
                        ->addColumn('action',function($booking){
                            return "<button  value='".route('approve-booking',['id'=>$booking->id,'status'=>1])."'
                                    class='btn btn-sm btn-success btn-approve' title='อนุมัติ'>
                                    <i class='fa fa-check'></i>
                                    </button>
                                    
                                    <button value='".route('approve-booking',['id'=>$booking->id,'status'=>0])."'
                                    class='btn btn-sm btn-danger btn-not-approve'title='ไม่อนุมัติ' >
                                    <i class='fa fa-close'></i>
                                    </button>
                                    
                                    <button value='".route('approve-room',[
                                        'id' => $booking->id,
                                        'date' => $booking->booking_date,
                                        'begin' => $booking->booking_begin,
                                        'end' => $booking->booking_end
                                    ])."'
                                    class='btn btn-sm btn-info btn-room'title='เปลี่ยนห้อง'> 
                                    <i class='fa fa-refresh'></i> 
                                    </button> 
                                    
                                    <button value='".route('approve-delete',['id' => $booking->id ])."'
                                       
                                    class='btn btn-sm btn-warning btn-cancel' title='ลบห้อง'> 
                                    <i class='fa fa-close'></i>
                                    </button>";
                        })



                        
                        ->addColumn('check',function($booking){
                            return '<div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="'.$booking->id.'" name="check[]">
                                            <span class="custom-control-indicator"></span>
                                           
                                        </label>
                                    </div>
                           ';
                        })
                        ->addColumn('booking_time',function($booking){
                            return date('H:i',strtotime($booking->booking_begin)).' - '.
                                    date('H:i',strtotime($booking->booking_end));
                        })
                        ->editColumn('booking_date',function($booking){
                            return date('d/m/Y',strtotime($booking->booking_date));
                        })
                        ->editColumn('user_id',function($booking){
                            $name = $booking->user_id;
                            $users = DB::table('users')
                            ->select('name')->where(['id' => $name ])->first();
               
                            return $users->name; 
                              
                       })
                        ->rawColumns(['action','booking_date','booking_time','check'])
                        ->make(true);
    }

    public function approveAll(Request $request)
    {  $name = Auth::user()->name;
        Booking::whereIn('id',$request->data)->update(['booking_status' => $request->status,'approve_name' => $name]);
      
      
        $res = [];
        if($request->status == 1)
        {
            $res = [
                'type' => 'success',
                'title' => 'อนุมัติรายการจอง',
                'text' => 'อนุมัติรายการจองเรียบร้อย'
            ];
        }
        else 
        {
            $res = [
                'type' => 'success',
                'title' => 'ไม่อนุมัติรายการจอง',
                'text' => 'ไม่อนุมัติรายการจองเรียบร้อย'
            ];
        }
        return response()->json($res);
    }

    public function approveDeleteAll(Request $request)
    {
        
       Booking::where('booking_owner_id',$request->data)->delete(['id' => $request->status]);
       
       $res = [];
       if($request->status == 2)
       {
           $res = [
               'type' => 'success',
               'title' => 'ลบรายการจองห้องประชุม',
               'text' => 'ลบรายการจองเรียบร้อย'
           ];
       }
       return response()->json($res);
    }


    public function approveDelete($id)
    {
        $booking = Booking::findOrFail($id);
        Booking::where('booking_owner_id',$booking->booking_owner_id)->delete();
        return response()->json([
            'type' => 'success',
            'text' => 'คุณได้ทำการลบเรียบร้อยแล้ว'
        ]);
    }

    public function approveBooking($id,$status)
    {
        $name = Auth::user()->name;
        Booking::findOrFail($id)->update(['booking_status' => $status,'approve_name' => $name]);
        $text = "";
        if($status == 1)
        {
            $text = 'คุณได้ทำการอนุมัติการจองเรียบร้อยแล้วครับ';
        }
        else 
        {
            $text = 'คุณได้ทำการไม่อนุมัติการจองเรียบร้อยแล้วครับ';
        }
        return response()->json([
            'type' => 'success',
            'text' => $text
        ]);
    }
    public function approveRoom($id,$date_,$begin,$end)


    {   

        $checkRoles = DB::table('user_roles')->select('user_roles.role_id')->where('user_roles.user_id',Auth::user()->id)->get();

        $bookings = Booking::select('rooms_id','booking_begin','booking_end')->where(['booking_date' => $date_])->get();
        $rooms_id = [];

        foreach($bookings as $booking)
        {
            if($this->check_time_period($booking->booking_begin,$booking->booking_end,$begin,$end))
            {
                $rooms_id[] = $booking->rooms_id;
            }
        }
        if($checkRoles[0]->role_id == 1){

            $room = Room::where('rooms_status',1)->whereNotIn('id',$rooms_id)->get();

        }else{
            $userRoom = User_room::select('rooms_id')->where('users_id',Auth::user()->id)->get();
            $rooms = array();
            foreach($userRoom as $key => $value){
                array_push($rooms, $userRoom[$key]->rooms_id);
            }
            $room = Room::where('rooms_status',1)->whereNotIn('id',$rooms_id)->whereIn('id',$rooms)->get();
            // $booking = Booking::with(['rooms','user_room'])->select('bookings.*',)->whereIn('rooms_id', $rooms)->where(['booking_status' => 2]);
        }

        
        
      
        

      
        return Datatables::of($room)
                            ->addColumn('action',function($query) use ($id){
                                return '
                                    <button   class="btn btn-sm btn-info btn-change"
                                        value="'.route('booking-change-room',['id' => $id,'rooms_id'=>$query->id]).'" >
                                        <i class="fa fa-check"></i>
                                    </button>';
                            })
                            ->make(true);
    }

    public function roomChange(Request $request)    
    {
        
        Booking::where('id',$request->id)->update(['rooms_id' => $request->rooms]);
        return response()->json([
            'type' => 'success',
            'text' => 'คุณได้ทำการเปลี่ยนห้องประชุมเรียบร้อยแล้ว'
        ]);
    }

     

   
    

    
}
