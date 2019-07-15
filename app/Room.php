<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    public function Booking(){
        return $this->hasMany(Booking::class);
    }
    public function Building(){
        return $this->belongsTo(Building::class);
    }

}
