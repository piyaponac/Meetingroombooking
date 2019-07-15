@extends('layouts.main') 
@section('title','Booking Calendar') 
@section('content')
<div class="row">
                    <div class="col-lg-12">
                    <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">ตรวจสอบห้องประชุมว่าง</h4>
                            <div class="form m-t-40 row">
                                <div class="form-group col-md-2 m-t-20" >
                                    <div class="input-group">
                                        <input  
                                       
                                        class="form-control mydatepicker " 
                                        placeholder="วันที่"
                                        id="booking_dates"
                                        name="booking_dates" >
                                        <span class="input-group-addon"> 
                                                    <span class="icon-calender"></span> </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                <div class="input-group">
                                            <input  type="text"  placeholder="เวลาเริ่ม" id="from_time" name="from_time" class="form-control input-group clockpicker"  data-placement="bottom" data-align="top" data-autoclose="true"> <span class="input-group-addon"> <span class="">ถึง</span> </span>
                                            <input type="text"   placeholder="เวลาสิ้นสุด" id="to_time" name="to_time" class="form-control input-group clockpicker"  data-placement="bottom" data-align="top" data-autoclose="true"> <span class="input-group-addon"> <span class="fa fa-clock-o"></span> </span>
                                        </div>
                                </div>

                                <div class="form-group col-md-2 m-t-20">

                                    <select class="form-control" id="buildings_id" name='building_id'>
                                        <option value="">กรุณาเลือกอาคาร</option>
                                            
                                                @foreach($buildings as $building)
                                                <option value="{{ $building->id }}">{{ $building->buildings_name }}</option>
                                                @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-md-2 m-t-20">

                                    <select class="form-control" id="room_id" name='room_id'>
                                        <option value="{{ $building->id }}">กรุณาเลือกห้องประชุม
                                            <option>
                                                <option value="{{ $building->id }}">{{ $building->buildings_name }}</option>

                                    </select>
                                </div>
                               

                             
                           

                                <div class="form-group col-md-2 m-t-20">
                                    <button type="button" name="filter" id="filter" class="btn btn-info ">ค้นหา</button>
                                    <button type="button" name="refresh" id="refresh" class="btn btn-warning ">Refresh</button>
                                </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                    <table class="table full-color-table full-muted-table hover-table">
                                    
                                    <thead>
                                        <tr>
                                            <th >รายการห้องว่าง</th>
                                            <th>ชื่อห้อง</th>
                                            <th >ความจุที่นั่ง</th>
                                            <th>อุปกรณ์ภายใน</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        
                                    </tbody>
                            </table>
                            </div>
                    </div>
                    </div>

 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            
                   
                                <h4 class="card-title">รายการห้องประชุม</h4>
                                <div id="calendar"></div>
                               
                                <div class="text-center">
                                    <ul class="list-inline">
                                        <li>
                                            <h5 style="color:#00CC00;" ><i class="fa fa-circle font-10 m-r-10 "></i>ผ่านการอนุมัติ</h5> </li>
                                        <li>
                                            <h5  class="text-warning"><i class="fa fa-circle font-10 m-r-10"></i>รอการอนุมัติ</h5> </li>
                                        <li>
                                            <h5 class="text-danger"><i class="fa fa-circle font-10 m-r-10"></i>ยกเลิก</h5> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                </div>
                @if(!Auth::guest())
                                <!-- sample modal create -->
                                <div id="modal-create" class="modal fade" tabindex="-1" role="dialog" >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">รายระเอียดการจอง</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="row">
                                                    <div class="col-12">
                                                    
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
                                                                                            <div class="input-group"  data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                                <input 
                                                                                                step="900"
                                                                                                type="time" 
                                                                                                class="form-control" 
                                                                                                id="booking_begin"  
                                                                                                name="booking_begin" 
                                                                                                style="padding: .3rem .0rem .3rem .9rem;"
                                                                                               >
                                                                                                <span class="input-group-addon"> 
                                                                                                    <span class="fa fa-clock-o"></span> </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <label class="m-t-20" style="padding:0px;">เวลาที่สิ้นสุด</label>
                                                                                            <div class="input-group  " data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                                <input 
                                                                                                type="time" 
                                                                                                class="form-control" 
                                                                                                id="booking_end" 
                                                                                                name="booking_end"
                                                                                                style="padding: .3rem .0rem .3rem .9rem;"
                                                                                             >
                                                                                                <span class="input-group-addon"> 
                                                                                                    <span class="fa fa-clock-o"></span> </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <label class="m-t-20" for = "building_id">เลือกห้องประชุม</label>
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
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                                <a href="" id="btn-edit" class ="btn btn-warning" style ="display:none;">แก้ไขข้อมูล</a>
                                                <a href="" id="btn-add-day" class = "btn btn-primary"style ="display:none;">เพิ่มวัน</a>
                                                <a href="" id="btn-delete" class = "btn btn-danger"style ="display:none;">ลบการจอง</a>
                                            </div> -->
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            
                @endif

               



             
                                <!-- sample modal content -->
                                <div id="Modal" class="modal fade" tabindex="-1" role="dialog" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">รายระเอียดการจอง</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                               <div id="content">


                                               </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                                <a href="" id="btn-edit" class ="btn btn-warning" style ="display:none;">แก้ไขข้อมูล</a>
                                                <a href="" id="btn-add-day" class = "btn btn-primary"style ="display:none;">เพิ่มวัน</a>
                                                <a href="" id="btn-delete" class = "btn btn-danger"style ="display:none;">ลบการจอง</a>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                               

@endsection
@section('script')
<script>
$(document).ready(function() {
    $('#buildings_id').on('change',function(){
  
        if($(this).val()!=''){
            var  select= $(this).val();
            var _token=$('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('filter-calendar') }}",
                method: "post",
                data:{select:select,_token:_token},
                success:function(result){
                    $('#room_id').html(result);
                }
            })
        }
    })
       

    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();

    
    $('#calendar').fullCalendar({
            height: 650,
            locale:'th',
            lang: 'th',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
            today: 'today',
            month: 'month',
            week : 'week',
            day  : 'day'
            },
            eventLimit: true, // for all non-TimeGrid views
                views: {
                    timeGrid: {
                    eventLimit: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                    }
            },
   
            dayClick: function(date, jsEvent, view) {
                 $("#booking_date").val(date.format());  
                 $("#modal-create").modal('show');
                },
            eventClick: function(event){
                    $(".closon").click(function() {
                        $('#calendar').fullCalendar('removeEvents',event._id);
                    });
                }, 
            events    : {!! json_encode($events) !!},
           
            eventClick: function(calEvent, jsEvent) {
                var html_v = "<table class='table table-bordered'>";
                html_v += "<tr><td>วาระประชุม</td><td>"+calEvent.title+"</td></tr>";
                html_v += "<tr><td>ผู้จองห้องประชุม</td><td>"+calEvent.name+"</td></tr>";
                html_v += "<tr><td>เวลา</td><td>"+calEvent.time+"</td></tr>";
                html_v += "<tr><td>จำนวนผู้เข้าร่วมประชุม</td><td>"+calEvent.num+"</td></tr>";
                html_v += "<tr><td>ห้องประชุม</td><td>"+calEvent.room+"</td></tr>";
                html_v +="</table>";
                var url = "{{ url('/') }}"+"/booking/check-user/"+calEvent.id;
                    $.get(url,function(response){
                    console.log(response.check);
                    if(response.check)
                    {
                        
                        var link_add = "{{ url('/') }}"+"/booking/add-day/"+calEvent.id;
                        var link_edit = "{{ url('/') }}"+"/booking/edit/"+calEvent.id;
                        var link_delete = "{{ url('/') }}"+"/booking/delete/"+calEvent.id;
                        $("#btn-add-day").attr("href",link_add);
                        $("#btn-edit").attr("href",link_edit);
                        // $("#btn-delete").attr("href",link_delete);
                        $("#btn-delete").click(function(e){
                            e.preventDefault();
                            swal({
                                title: "ยืนยันการลบ",
                                text: "คุณต้องการลบรายการนี้ !",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes",
                                closeOnConfirm: false
                            },
                            function(){
                               
                                $.ajax({
                                    url: link_delete,
                                    method: 'GET',
                                    success:function(response){
                                       
                                        swal({
                                            type: response.type,
                                            title: 'สำเร็จ',
                                            text: response.text,
                                            timer: 2000,
                                            showConfirmButton: false
                                        });
                                        $('#calendar').fullCalendar('removeEvents',calEvent.id);
                                          $("#Modal").modal("hide");
                                    }
                                   
                                });
                               
                            });
                        });
                        
                      
          

                        $("#btn-add-day").show();
                        $("#btn-edit").show();
                        $("#btn-delete").show();
                    }
                    else
                    {
                        $("#btn-add-day").hide();
                        $("#btn-edit").hide();
                        $("#btn-delete").hide();
                    }
                    });

                
                $("#Modal").modal('show')
                           .find("#content")
                           .html(html_v);


        },
        
       
    });




   
   
   
       

    
    

    
        
$('.clockpicker').clockpicker();


        ////////////////////////////////////////
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
                    $("#modal-create").modal("hide");
                    window.location = "{!! route('booking-index') !!}"

                    if(response.type == "success")
                    {
                        document.getElementById("form-booking").reset();
                        
                        swal({
                            title: "สำเร็จ",
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
                                var date = new Date();

                     

                        var _token = $('input[name="_token"]').val();

                        fetch_data();

                        function fetch_data(from_time = '', to_time = '', booking_dates = '', room_id = '', buildings_id = '')
                        {
                        $.ajax({
                        url:"{{ route('fetch_data') }}",
                        method:"POST",
                        data:{from_time:from_time, to_time:to_time, booking_dates:booking_dates, _token:_token, room_id:room_id, buildings_id:buildings_id},
                        dataType:"json",
                        success:function(data)
                        {
                        var output = '';
                        $('#total_records').text(data.length);
                        for(var count = 0; count < data.length; count++)
                        {
                            output += '<tr>';
                            output += '<td>' + data[count].buildings_name + '</td>';
                            output += '<td>' + data[count].rooms_name + '</td>';
                            output += '<td>' + data[count].rooms_size + '</td>';
                            output += '<td>' + data[count].rooms_equipment + '</td></tr>';
                        }
                        $('#tbody').html(output);
                        }
                        })
                        }

                        $('#filter').click(function(){
                        var from_time = $('#from_time').val();
                        var to_time = $('#to_time').val();
                        var booking_dates = $('#booking_dates').val();
                        var room_id = $('#room_id').val();
                        var buildings_id = $('#buildings_id').val();
                        if(from_time != '' &&  to_time != '')
                        {
                        fetch_data(from_time, to_time, booking_dates, room_id, buildings_id);
                        }
                        else
                        {
                        alert('Both time is required');
                        }
                        });

                        $('#refresh').click(function(){
                        $('#from_time').val('');
                        $('#to_time').val('');
                        $('#buildings_id').val('');
                        $('#booking_dates').val('');
                        fetch_data();
                        });


    
});

</script>
@endsection