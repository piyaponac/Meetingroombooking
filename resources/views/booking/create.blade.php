@extends('layouts.main') 
@section('title','Room booking') 
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">จองห้องประชุม</h4>

                <form role="form" id="form-booking">
                {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-6">

                            <label class="m-t-20">วันที่จอง</label>
                            <div class="input-group">
                                <input  
                                class="form-control mydatepicker " 
                                 id="booking_date"
                                 name="booking_date" >
                                <span class="input-group-addon"> 
                                            <span class="icon-calender"></span> </span>
                            </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="m-t-20" style="padding:0px;">เวลาที่เริ่มต้น</label>
                                            <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                                <input 
                                                type="text" 
                                                class="form-control" 
                                                id="booking_begin"  
                                                name="booking_begin" 
                                                readonly="readonly">
                                                <span class="input-group-addon"> 
                                                    <span class="fa fa-clock-o"></span> </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="m-t-20" style="padding:0px;">เวลาที่สิ้นสุด</label>
                                            <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                                <input 
                                                type="text" 
                                                class="form-control" 
                                                id="booking_end" 
                                                name="booking_end"
                                                readonly="readonly" >
                                                <span class="input-group-addon"> 
                                                    <span class="fa fa-clock-o"></span> </span>
                                            </div>
                                        </div>
                                    </div>
                                <label class="m-t-20" for = "building_id">เลือกอาคาร</label>
                                <div class="input-group" >    
                                                            <select class="form-control" id="building_id"  name='building_id'>
                                                            <option value ="">เลือกอาคาร</option>
                                                            @foreach($buildings as $building)
                                                                <option value="{{ $building->id }}">{{ $building->buildings_name }}</option>
                                                            @endforeach
                                                            </select>
                                </div>


                            <label class="m-t-20" for = "rooms_id">เลือกห้องประชุม</label>
                            <div class="input-group">
                                <input 
                                type="text" 
                                class="form-control" 
                                placeholder="กรุณาเลือกห้องประชุม" 
                                id="rooms_id" 
                                name ="rooms_name"
                                readonly="readonly"
                                 >
                                 
                                <span>
                                    <button class="input-group-addon" id="btn-select">เลือก </button>
                                </span>
                               
                            </div>
                            <input type="hidden" id="room" name = "rooms_id">
                            

                        </div>
                        
                        <div class="col-md-6">
                            <label class="m-t-20" style="padding:0px;">เรื่องการประชุม</label>
                            <div class="input-group" >
                                <input 
                                type="text" 
                                class="form-control" 
                                id="booking_title"
                                name="booking_title" >
                                <span class="input-group-addon"> 
                                <span class="fa fa-bookmark-o"></span> </span>
                            </div>

                            <label class="m-t-20" style="padding:0px;">จำนวนคนประชุม</label>
                            <div class="input-group" >
                                <input 
                                type="text" 
                                class="form-control" 
                                id="booking_num"
                                name="booking_num" >
                                <span class="input-group-addon"> 
                                <span class="fa fa-address-book-o"></span> </span>
                            </div>

                        

                            <label class="m-t-20">รายละเอียด</label>
                            <div class="input-group">
                                <textarea class="form-control" id="booking_detail" name="booking_detail" placeholder="Now" rows="6">
                                </textarea>
                            </div>

                        </div>
                        
                       

                    </div>
                    <hr>
                    <div class="button-box m-t-20">
                        <a type="button" id="btn-create" class="btn btn-info" href="#">จองห้องประชุม</a>
                        

                    </div>
                </form>

                <!-- modal create -->
                <div id="modal-room" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">เลือกห้องประชุม</button>
                                <h4 class="modal-title" id="myModalLabel"></h4>
                            </div>
                            <div class="modal-body">
                                <table id="room-table" class="table table-brodered" >
                                    <thead>
                                        <tr>
                                            <th>ห้องประชุม</th>
                                            <th>อุปกรณ์</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
                <!-- modal create -->
            </div>
        </div>
    </div>
</div>

    @endsection
     @section('script')
    <script>
        $(document).ready(function(e) {

            $('#btn-select').click(function(e) {
                e.preventDefault();
                var b_date = $("#booking_date").val();
                var b_begin = $("#booking_begin").val();
                var b_end = $("#booking_end").val();
                var building = $("#building_id").val();
               
                if (b_date != "" && b_begin != "" && b_end != ""&& building != "") 
                {
                    $("#modal-room").modal("show");
                    var url = "{!! url('/') !!}"+"/booking/room/"+b_date+"/"+b_begin+"/"+b_end+"/"+building;

                    $("#room-table").DataTable({
                        processing : true,
                        serverSide : true,
                        destroy    : true,
                        ajax: url,
                    
                        columns : [                           
                            {data : 'rooms_name' , name: 'rooms_name'},   
                            {data : 'rooms_equipment' , name: 'rooms_equipment'},                    
                            {data : 'action' , name: 'action',order:false,search:false}
                        ]
                    
                    });
                } else {
                    swal("พบข้อมูลผิดพลาด", "กรุณาตรจสอบข้อมูล", "error");

                }
            });

            $("#room-table").on("click",".btn-select",function(e){
                $.ajax({
                    method : 'GET',
                    url: $(this).attr('value'),
                    success: function(response){
                        $("#rooms_id").val(response.rooms_name);
                        $("#room").val(response.id);
                        $("#modal-room").modal("hide");
                    }
                });
            });
            $("#btn-create").click(function(e){
            e.preventDefault();
            var form = $("#form-booking");
            $.ajax({
                url: "{!! route('booking-create-post') !!}",
                method: 'POST',
                data: form.serialize(),
                success: function(response){
                    if(response.type == "success")
                    {
                        document.getElementById("form-booking").reset();
                        
                        swal({
                            title: "ยินดีด้วยครับ",
                            text: response.text,
                            type: response.type,
                            confirmButtonText: "OK",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr){
                    console.log(xhr);
                    var errors = xhr.responseJSON;
                    if(errors['booking_date'])
                    {
                        var inputGroup = $("#booking_date").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                        inputGroup
                            .addClass('has-error')
                            .after('<p class="text-danger">'+errors['booking_date'][0]+'</p>');
                    }

                    if(errors['booking_begin'])
                    {
                        var inputGroup = $("#booking_begin").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                        inputGroup
                            .addClass('has-error')
                            .after('<p class="text-danger">'+errors['booking_begin'][0]+'</p>');
                    }

                    if(errors['booking_end'])
                    {
                        var inputGroup = $("#booking_end").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                        inputGroup
                            .addClass('has-error')
                            .after('<p class="text-danger">'+errors['booking_end'][0]+'</p>');
                    }

                    if(errors['booking_title'])
                    {
                        var inputGroup = $("#booking_title").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                        inputGroup
                            .addClass('has-error')
                            .after('<p class="text-danger">'+errors['booking_title'][0]+'</p>');
                    }

                    if(errors['booking_num'])
                    {
                        var inputGroup = $("#booking_num").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                        inputGroup
                            .addClass('has-error')
                            .after('<p class="text-danger">'+errors['booking_num'][0]+'</p>');
                    }
                        if(errors['building_id'])
                        {
                            var inputGroup = $("#rooms_id").closest('.input-group');
                            inputGroup.next('.text-danger').remove();
                            inputGroup
                                .addClass('has-error')
                                .after('<p class="text-danger">'+errors['rooms_id'][0]+'</p>');
                        }

                    if(errors['rooms_id'])
                    {
                        var inputGroup = $("#rooms_id").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                        inputGroup
                            .addClass('has-error')
                            .after('<p class="text-danger">'+errors['rooms_id'][0]+'</p>');
                    }
                }
            });
        });
        });
    </script>

    @endsection