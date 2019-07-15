<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id')->unsigned()->comment('อาคาร');
            $table->foreign('building_id')->references('id')->on('buildings');
            $table->string('rooms_name')->uniqid()->comment('ชื่อห้องประชุม');
            $table->string('rooms_size')->comment('ขนาดห้องประชุม');
            $table->text('rooms_detail')->comment('รายละเอียด');
            $table->integer('rooms_status')->default(1)->comment('สถานะ 0 ยกเลิก 1 ใช้งาน');
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
        Schema::table('rooms',function(Blueprint $table){
            $table->dropForeign(['building_id']);
        });
        Schema::dropIfExists('rooms');
    }
}
