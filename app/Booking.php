<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'building_id',
        'rooms_id',
        'user_id',     
        'booking_date',
        'booking_begin',
        'booking_end',
        'booking_title',
        'booking_num',
        'approve_name',
        'booking_owner_id',
        'booking_detail',
        'booking_status',
       
    ];
    public function rooms(){
        return $this->belongsTo(Room::class);
    }
    public function buildings(){
        return $this->belongsTo(Building::class);
    }


    public function user_room(){
        return $this->belongsTo(User_room::class);
    }
    public function users()
    {
        return $this->belongsToMany('App\User','name');
        
    }

  
    
    
   
    
    
}
