@extends('layouts.main') 
@section('title','Add Room booking') 
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">


            <div class="box-primary">
                <div class="box-header with-border">
                <h4 class="card-title">รายการวันจอง</h4>
                </div>
                    <div class="box-body">
                        @foreach($list_day as $id)
                        <p>
                       <b>วันที่จอง</b>  <strong class="text-danger">{{ date('d/m/Y',strtotime($id->booking_date)) }}</strong>
                        {{ date('H:i',strtotime($id->booking_begin)) }} <b>ถึง</b>  {{ date('H:i',strtotime($id->booking_end)) }} <b>ห้อง</b>  {{ $booking->rooms->rooms_name }}
                        </p>
                        @endforeach
                    </div>
                <hr>
            </div>
            
                <h4 class="card-title">เพิ่มวันการประชุม</h4>

                <form role="form" id="form-booking">
                {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-6">

                            <label class="m-t-20">วันที่จอง</label>
                            <div class="input-group">
                                <input  
                                class="form-control mydatepicker " 
                                 id="booking_date"
                                 name="booking_date"
                                 value = "{{ $booking->booking_date }}" >
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
                                            
                                                value = "{{ $booking->booking_begin }}"
                                              >
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
                                             
                                                value = "{{ $booking->booking_end }}">
                                                <span class="input-group-addon"> 
                                                    <span class="fa fa-clock-o"></span> </span>
                                            </div>
                                        </div>
                                    </div>


                                                            <label class="m-t-20" style="padding:0px;">เลือกอาคาร</label>
                                                            <div class="input-group" >
                                                                <input 
                                                                type="text" 
                                                                class="form-control" 
                                                                id="building_id"
                                                                name="building_name"
                                                                value = "{{ $booking->rooms->building->buildings_name }}" 
                                                                readonly="readonly">
                                                                <span class="input-group-addon"> 
                                                                <span class="fa fa-address-book-o"></span> </span>
                                                            </div>
                                                            <input type="hidden" id="room" name = "building_id" value = "{{ $booking->building_id }}">
                               
                             

                            <label class="m-t-20" for = "rooms_id">เลือกห้องประชุม</label>
                            <div class="input-group">
                                <input 
                                type="text" 
                                class="form-control" 
                                placeholder="กรุณาเลือกห้องประชุม" 
                                id="rooms_id" 
                                name ="rooms_name"
                                readonly="readonly"
                                value = "{{ $booking->rooms->rooms_name }}"
                                 >
                                 
                                <span>
                                    <button class="input-group-addon" id="btn-select">เลือก </button>
                                </span>
                               
                            </div>
                            <input type="hidden" id="room" name = "rooms_id" value = "{{ $booking->rooms_id }}">
                            

                        </div>
                        
                        <div class="col-md-6">
                            <label class="m-t-20" style="padding:0px;">เรื่องการประชุม</label>
                            <div class="input-group" >
                                <input 
                                type="text" 
                                class="form-control" 
                                id="booking_title"
                                name="booking_title" 
                                readonly="readonly"
                                value = "{{ $booking->booking_title }}">
                                <span class="input-group-addon"> 
                                <span class="fa fa-bookmark-o"></span> </span>
                            </div>

                            <label class="m-t-20" style="padding:0px;">จำนวนคนประชุม</label>
                            <div class="input-group" >
                                <input 
                                type="text" 
                                class="form-control" 
                                id="booking_num"
                                name="booking_num"
                                value = "{{ $booking->booking_num }}" 
                                readonly="readonly">
                                <span class="input-group-addon"> 
                                <span class="fa fa-address-book-o"></span> </span>
                            </div>

                        

                            <label class="m-t-20">รายละเอียด</label>
                            <div class="input-group">
                                <textarea class="form-control"readonly="readonly" id="booking_detail" name="booking_detail" placeholder="Now" rows="6"
                                 >{{ $booking->booking_detail }}
                                
                                </textarea>
                            </div>

                        </div>
                        
                       

                    </div>
                    <hr>
                    <div class="button-box m-t-20">
                        <button type="button" id="btn-create" class="btn btn-info" title="{{ $booking->id }}" >บันทึกข้อมูล</button>
                        

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

    @endsection
     @section('script')
    <script>
        $(document).ready(function(e) {

            $('#btn-select').click(function(e) {
                e.preventDefault();
                var b_date = $("#booking_date").val();
                var b_begin = $("#booking_begin").val();
                var b_end = $("#booking_end").val();
                if (b_date != "" && b_begin != "" && b_end != "") 
                {
                    $("#modal-room").modal("show");
                    var url = "{!! url('/') !!}"+"/booking/room/"+b_date+"/"+b_begin+"/"+b_end;

                    $("#room-table").DataTable({
                        processing : true,
                        serverSide : true,
                        destroy    : true,
                        ajax: url,
                    
                        columns : [                           
                            {data : 'rooms_name' , name: 'rooms_name'},                       
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
            var link = "{!! url('/') !!}"+"/booking/add-day/"+$(this).attr('title');
            $.ajax({
                url: link,
                method: 'POST',
                data: form.serialize(),
                success: function(response){
                    if(response.type == "success")
                    {
                        document.getElementById("form-booking").reset();
                        
                        swal({
                            title: "เรียบร้อย",
                            text: response.text,
                            type: response.type,
                            confirmButtonText: "OK",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        window.location = "{!! route('booking-index') !!}"
                    }else
                    {
                        swal({
                            title: "เกิดข้อผิดผลาด",
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