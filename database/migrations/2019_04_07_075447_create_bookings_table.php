<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id')->unsigned()->comment('อาคารห้องประชุม');
            $table->integer('rooms_id')->unsigned()->comment('ห้องประชุม');
            $table->integer('user_id')->unsigned()->comment('ผู้จอง');
            $table->string('approve_name')->comment('ผู้อนุมัติ');
            $table->date('booking_date')->comment('วันที่จอง');
            $table->time('booking_begin')->comment('เวลาเริ่ม');
            $table->time('booking_end')->comment('เวลาจบ');
            $table->string('booking_title')->comment('เรื่องประชุม');
            $table->string('booking_num')->comment('จำนวนคน');
            $table->text('booking_detail')->nullable()->comment('รายละเอียดเพิ่มเติม');
            $table->integer('booking_status')->default(2)->comment('สถานะ 0-ยกเลิก 1-อนุมัติ 2-รออนุมัติ');
            $table->integer('booking_owner_id')->unsigned()->default(0)->comment('การจอกหลัก');
            $table->foreign('building_id')->references('id')->on('buildings');
            $table->foreign('rooms_id')->references('id')->on('rooms');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('booking_owner_id')->references('id')->on('bookings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings',function(Blueprint $table){
            $table->dropForeign(['rooms_id','user_id','building_id']);
        });
        Schema::dropIfExists('bookings');
    }
}
