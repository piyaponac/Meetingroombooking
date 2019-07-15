@extends('layouts.main')

@section('title','Approve List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                                
                        <div class="d-flex">
                            <h4 class="card-title">รายการจองห้องประชุม</h4>
                           
                        <div class="ml-auto">
                                <div class="form-group">
                                     <button type="button" class="btn btn-success" id="button-approve" value="1">อนุมัติ</button>
                                      <button type="button" class="btn btn-danger" id="button-not-approve"value="0">ไม่อนุมัติ</button>
                                      <button type="button" class="btn btn-warning " id="button-cancel" value="2">ยกเลิก</button>
                                </div>

                        </div>
                                            
                                            
                    </div>
                        <div class="table-responsive m-t-20">
                            <table  id="approve-table"  class="table">
                                <thead>
                                    <tr>
                                         <th >
                                              <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"  name="check_all">
                                                <span class="custom-control-indicator"></span>
                                              </label>
                                         </th> 
                                        <th>ห้องประชุม</th>
                                        <th>วันที่</th>
                                        <th>ผู้จอง</th>
                                        <th>เวลา</th>
                                        <th>จำนวนคน</th>
                                        <th>Action</th> 
                                    </tr>                               
                                </thead>                                        
                            </table>
                        </div>
                               
                        
                                
                            
            </div>
        </div>
                              
    </div>
</div>
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

@endsection

@section('script')
<script>
     var table = $("#approve-table").DataTable({
        processing : true,
        serverSide : true,
        ajax: "{!! route('booking-approve-data') !!}",
       
        columns : [
            {data : 'check' , name: 'check',orderable:false,searchable:false},
            {data : 'rooms.rooms_name' , name: 'rooms.rooms_name'},
            {data : 'booking_date' , name: 'booking_date'},
            {data : 'user_id', name: 'user_id'},
            {data : 'booking_time' , name: 'booking_time'},
            {data : 'booking_num' , name: 'booking_num'},
            {data : 'action' , name: 'action',orderable:false,searchable:false}

        ]
        });
    $(document).ready(function(e){
        var selectBooking = [];

        $("input[name='check_all']").on('change',function(e){
            e.preventDefault();
            var rows = table.cells().nodes();
            $(rows).find(':checkbox').prop('checked',$(this).is(':checked'));
            if($(this).is(':checked'))
            {
                table.$('input[type="checkbox"]').each(function(){
                    selectBooking.push($(this).val());
                });
            }
            else
            {
                selectBooking = [];
            }
            
           
        });

        $("#approve-table").on("change",'input[type="checkbox"]',function(e){
            
            if($(this).is(':checked'))
            {
                selectBooking.push($(this).val());
            }
            else
            {
                selectBooking.splice($.inArray($(this).val(),selectBooking),1);
            }
         
           // selectBooking.splice($.inArray("on",selectBooking),1);
            console.log(selectBooking);
        });
        $("#button-approve").click(function(e){
            e.preventDefault();
            //console.log(selectBooking);
            $.ajax({
                url: "{!! route('booking-approve-all') !!}",
                method: 'GET',
                data: {
                    status : $(this).attr('value'),
                    data: selectBooking
                },
                success: function(response){
                    $("#approve-table").DataTable().ajax.reload();
                    swal({
                        type: response.type,
                        title: response.title,
                        text: response.text,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
            selectBooking = [];
        });


        $("#button-not-approve").click(function(e){
            e.preventDefault();
            //console.log(selectBooking);
            $.ajax({
                url: "{!! route('booking-approve-all') !!}",
                method: 'GET',
                data: {
                    status : $(this).attr('value'),
                    data: selectBooking
                },
                success: function(response){
                    $("#approve-table").DataTable().ajax.reload();
                    swal({
                        type: response.type,
                        title: response.title,
                        text: response.text,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
            selectBooking = [];
        });

        $("#button-cancel").click(function(e){
            e.preventDefault();
            //console.log(selectBooking);
            $.ajax({
                url: "{!! route('booking-approve-delete-all') !!}",
                method: 'GET',
                data: {
                    status : $(this).attr('value'),
                    data: selectBooking
                },
                success: function(response){
                    $("#approve-table").DataTable().ajax.reload();
                    swal({
                        type: response.type,
                        title: response.title,
                        text: response.text,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
            selectBooking = [];
        });

        $("#approve-table").on('click','.btn-approve',function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('value'),
                method: 'GET',
                success:function(response){
                    $("#approve-table").DataTable().ajax.reload();
                    swal({
                        type: response.type,
                        title: 'สำเร็จ',
                        text: response.text,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });

        $("#approve-table").on('click','.btn-not-approve',function(e){
            e.preventDefault();
            var url = $(this).attr('value');
            swal({
                title: "ยืนยันการไม่อนุมัติ",
                text: "คุณต้องการไม่อนุมัติรายการนี้ !",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url: url,
                    method: 'GET',
                    success:function(response){
                        $("#approve-table").DataTable().ajax.reload();
                        swal({
                            type: response.type,
                            title: 'สำเร็จ',
                            text: response.text,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
            
        });

        $("#approve-table").on('click','.btn-room',function(e){
            e.preventDefault();
            $("#room-table").DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: $(this).attr('value'),
                columns: [
                    {data: 'rooms_name', name: 'rooms_name'},
                    {data: 'action', name: 'action', orderable:false,searchable:false}
                ]
            });
            $("#modal-room").modal("show");
        });
            //เปลี่ยนห้อง
        $("#room-table").on('click','.btn-change',function(e){
            e.preventDefault();
           $.ajax({
               url: $(this).attr('value'),
               method: 'GET',
               success: function(response){
                   if(response.type == "success")
                   {
                    $("#approve-table").DataTable().ajax.reload(); 
                    $("#modal-room").modal('hide');
                        swal({
                            type: 'success',
                            title: 'สำเร็จ',
                            text: response.text,
                            timer: 2000,
                           
                        });
                   
                   }
               }
           })
          
        });

        $("#approve-table").on('click','.btn-cancel',function(e){
            e.preventDefault();
            var url = $(this).attr('value');
            swal({
                title: "ยืนยันการลบ",
                text: "คุณต้องกาลบรายการนี้ !",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url: url,
                    method: 'GET',
                    success:function(response){
                        $("#approve-table").DataTable().ajax.reload();
                        swal({
                            type: response.type,
                            title: 'สำเร็จ',
                            text: response.text,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
            
        });
      

    });

       
   
</script>

@endsection