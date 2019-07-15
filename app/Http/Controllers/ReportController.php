<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use PDF;
use App\Booking;
use App\Room;
use App\User;
use App\User_room;




class ReportController extends Controller
{

   
    

  

    public function pdf()
    {
       
        return view('report.pdf');
    }
    
   
    function fetch_data(Request $request)
    {
   
        $checkRoles = DB::table('user_roles')->select('user_roles.role_id')->where('user_roles.user_id',Auth::user()->id)->get();
        
    $bookingQuery = Booking::query();
        
            $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
            $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

            if($start_date && $end_date){

            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            
            $bookingQuery-> whereBetween('booking_date',array($start_date,$end_date))->get();
            }
            
        if($checkRoles[0]->role_id == 1){
            $booking = $bookingQuery->with(['rooms','user_room'])->select('*')->
            where('booking_status', '!=' , 2)->get();
            
            
        }else{
            $userRoom = User_room::select('rooms_id')->where('users_id',Auth::user()->id)->get();
            $rooms = array();
            foreach($userRoom as $key => $value){
                array_push($rooms, $userRoom[$key]->rooms_id);
            }
          
            $booking = $bookingQuery->with(['rooms','user_room','buildings'])->select('*')
            ->where(['booking_status' => 1 ])->whereIn('rooms_id', $rooms)
             ->orWhere('booking_status',0);
        }
    

   
    return Datatables::of($booking)
        ->addColumn('booking_time',function($booking){
            return date('H:i',strtotime($booking->booking_begin)).' - '.
                    date('H:i',strtotime($booking->booking_end));
        })
        ->editColumn('booking_date',function($booking){
            return date('d/m/Y',strtotime($booking->booking_date));
        })
        ->editColumn('booking_status',function($booking){
            return $booking->booking_status == 1 ? 'อนุมัติ' : 'ไม่อนุมัติ';
        })
        ->editColumn('user_id',function($booking){
             $name = $booking->user_id;
             $users = DB::table('users')
             ->select('name')->where(['id' => $name ])->first();

             return $users->name; 
               
        })
        ->editColumn('buildings',function($booking){
            $name = $booking->building_id;
            $buildings = DB::table('buildings')
            ->select('buildings_name')->where(['id' => $name ])->first();
             
            $names = $booking->rooms_id;
            $building_floor = DB::table('rooms')
            ->select('building_floor')->where(['id' => $names ])->first();

            return $buildings->buildings_name.' -ชั้นที่ '.$building_floor->building_floor; 
              
       }) 
      
       
        
        ->rawColumns(['booking_date','booking_time','check','user_id'])
        ->make(true);
    }
}
