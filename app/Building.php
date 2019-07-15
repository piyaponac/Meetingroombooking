<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'buildings';
    
    public function Booking(){
        return $this->hasMany(Booking::class);
    }
  
    public function rooms(){
        return $this->belongsTo(Room::class);
    }
   
}
