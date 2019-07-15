@extends('layouts.main')

@section('title','Room Meeting List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                                
                        <div class="d-flex">
                            <h4 class="card-title">รายการห้องประชุม</h4>
                        <div class="ml-auto">
                                <div class="form-group">
                                     <button type="button" class="btn btn-info btn-rounded" id="add-room">เพิ่มห้องประชุม</button>
                                </div>

                        </div>
                                            
                                            
                        </div>
                        <div class="table-responsive m-t-40">
                            <table  id="room-table"  class="table display  table-striped">
                                <thead>
                                    <tr>
                                        
                                        <th>ชื่อห้อง</th>
                                        <th>ชั้นที่</th>
                                        <th>อาคาร</th>
                                        <th>ความจุ</th>
                                        <th>อุปกรณ์ภายใน </th>
                                        <th>สถานะ</th>
                                        <th>Action</th> 
                                    </tr>                               
                                </thead>                                        
                            </table>
                        </div>
                                <!-- modal create -->
                                <div id="modal-create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="display:none;" id="adds">เพิ่มห้องประชุม</button>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="display:none;"id="edits">แก้ไขห้องประชุม</button>
                                                    <h4 class="modal-title" id="myModalLabel"></h4> 
                                            </div>
                                                <div class="modal-body">
                                                    <form id ="form-room-meeting" class=" form m-t-40" > 
                                                                {!! csrf_field() !!}
                                                        <div class="col-md-12 m-b-20 " >
                                                        <label for="rooms_name">ชื่อห้อง</label>
                                                            <div class="input-group" >                     
                                                                <input type="text" class="form-control" id="rooms_name" placeholder="ชื่อห้อง" name="rooms_name">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 m-b-20"> 
                                                        <label for="rooms_size">ความจุคน</label>  
                                                            <div class="input-group" >
                                                                <input type="text" class="form-control" placeholder="ความจุคน" id="rooms_size" name='rooms_size'> 
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-12 m-b-20">
                                                        <label for="rooms_equipment">อุปกรณ์ภายใน</label>  
                                                            <div class="input-group" >    
                                                                <input type="text" class="form-control" placeholder="อุปกรณ์ภายใน" id="rooms_equipment"name='rooms_equipment'>
                                                            </div>
                                                        </div> 

                                                        <div class="col-md-12 m-b-20">
                                                        <label for="rooms_detail">รายละเอียดห้อง</label>  
                                                            <div class="input-group" >    
                                                                <input type="text" class="form-control" placeholder="รายละเอียดห้อง" id="rooms_detail"name='rooms_detail'>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-12 m-b-20">
                                                        <label for="building_id">อาคาร</label> 
                                                            <div class="input-group" >    
                                                                <select class="form-control" id="building_id"  name='building_id'>
                                                                <option value ="">เลือกอาคาร</option>
                                                                @foreach($buildings as $building)
                                                                    <option value="{{ $building->id }}">{{ $building->buildings_name }}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 m-b-20"> 
                                                        <label for="rooms_size">ชั้นที่</label>  
                                                            <div class="input-group" >
                                                                <input type="text" class="form-control" placeholder="ชั้นที่" id="building_floor" name='building_floor'> 
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-12 m-b-20">
                                                        <label for="users_id">ผู้ดูแลห้องประชุม</label> 
                                                        <div class="input-group">
                                                            <input   type="text"  class="form-control"  placeholder="กรุณาเลือกผู้ดูแล" 
                                                              id="users_id"  name ="users_id"readonly="readonly">
                                                           
                                                            <span id="from_create">
                                                                <button class="input-group-addon" id="btn-select">เลือก </button>
                                                            </span>
                                                            <span id="from_edit">
                                                                <button class="input-group-addon" id="btn-select_edit">เลือก </button>
                                                            </span>
                                                        
                                                        </div>
                                                        <input type="hidden" id="users_room" name = "users_room">
                                                        </div>

                                                      

                                                        <div class="col-md-12 ">
                                                        <label for="rooms_status">สถานะ</label> 
                                                            <div class="input-group" >    
                                                                <select class="form-control" id="rooms_status"  name='rooms_status'>
                                                                    <option value ="">เลือกสถานะการใช้งาน</option>
                                                                    <option value ="1">ใช้งาน</option>
                                                                    <option value ="2 ">ไม่ใช้งาน</option>
                                                                </select>
                                                            </div>
                                                        </div> 
                                                         <!--  
                                                                     <div class="col-md-12 m-b-20">  
                                                                     <div class="form-group" >  
                                                                      
                                                                            <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Upload Contact Image</span>
                                                                                <input type="file" class="upload"> </div>
                                                                    </div>      
                                                                    </div> -->
                                                    </form>
                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-info waves-effect"  id="btn-action" style="display:none;">บันทึกข้อมูล</button>
                                                                    <button type="button" class="btn btn-success " id="btn-update" style="display:none;">แก้ไขข้อมูล</button>
                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">ยกเลิก</button>
                                                                </div>
                                        </div>
                                                        <!-- /.modal-content -->
                                    </div>
                                </div>
                                <!-- modal create -->


                                                        <!-- modal create -->
                                                        <div id="modal-user" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">เลือกผู้ดูแลห้องประชุม</button>
                                                                        <h4 class="modal-title" id="myModalLabel"></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <table id="user-table" class="table table-brodered" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>เลือก</th>
                                                                                    <th>รายชื่อ</th>
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                            
                                                                        </table>
                                                                        <div class="ml-auto">
                                                                            <div class="form-group">
                                                                                <button type="button" class="btn btn-success" id="button-select" value="">บันทึก</button>
                                                                               
                                                                            </div>

                                                                    </div>

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
<script type="text/javascript" charset="utf-8">
    $("#room-table").DataTable({
        
        language: {
            "sEmptyTable":     "ไม่มีข้อมูลในตาราง",
            "sInfo":           "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty":      "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered":   "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "แสดง _MENU_ แถว",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing":     "กำลังดำเนินการ...",
            "sSearch":         "ค้นหา: ",
            "sZeroRecords":    "ไม่พบข้อมูล",
            "oPaginate": {
                "sFirst":    "หน้าแรก",
            "sPrevious": "ก่อนหน้า",
                "sNext":     "ถัดไป",
            "sLast":     "หน้าสุดท้าย"
            },
            "oAria": {
                "sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
            "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
        },
        processing : true,
        serverSide : true,
        ajax: "{!! route('room-datatables') !!}",
       
        columns : [
          
            {data : 'rooms_name' , name: 'rooms_name'},
            {data : 'building_floor' , name: 'building_floor'},
            {data : 'building' , name: 'building'},
            {data : 'rooms_size' , name: 'rooms_size'},
            {data : 'rooms_equipment' , name: 'rooms_equipment'},
            {data : 'rooms_status' , name: 'rooms_status'},
            {data : 'action' , name: 'action',orderable:false,searchable:false}

        ]
    });

    $(document).ready(function(e){
        $("#from_create").hide();
        $("#from_edit").hide();
        $("#add-room").click(function(e){
            $("#modal-create").modal('show');
            $("#adds").show();
            $("#edits").hide();
            $("#btn-action").show();
            $("#btn-update").hide();
            $("#from_create").show();
            $("#from_edit").hide();
        });

        $("#btn-action").click(function(e){
           var form =$("#form-room-meeting");
           $.ajax({
                url:"{!! route('create-room-post') !!}",
                method: 'POST',
                data: form.serialize(),
                success: function(response)
                    {
                    if(response.type == "success"){
                        console.log(response.id);
                        $("#modal-create").modal('hide');
                        document.getElementById("form-room-meeting").reset();
                        $("#room-table").DataTable().ajax.reload();
                        swal("สำเร็จ", "เพิ่มห้องประชุมเรียบร้อย", "success");
                    }
                },
                error: function(xhr){
                  var errors = xhr.responseJSON;
                   if(errors['rooms_name'])
                   {
                       var inputGroup = $("#rooms_name").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger')
                        .after('<p class="text-danger">'+errors['rooms_name'][0]+'</p>');
                        
                   }
                
                   if(errors['rooms_size'])
                   {
                       var inputGroup = $("#rooms_size").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['rooms_size'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['rooms_size'][0]+'</p>');
                   }
                   if(errors['   rooms_equipment'])
                   {
                       var inputGroup = $("#   rooms_equipment").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['   rooms_equipment'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['   rooms_equipment'][0]+'</p>');
                   }

                   if(errors['rooms_status'])
                   {
                       var inputGroup = $("#rooms_status").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['rooms_status'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['rooms_status'][0]+'</p>');
                   }

                  
                }

           });
           e.preventDefault();
        });


        /////////////////////////////////////////////////////////////////////////////
        var selectUser = [];
        var selectUsername = [];

        $("#user-table").on("change",'input[type="checkbox"]',function(e){
            var name = $(this).val().split('_');
            if($(this).is(':checked'))
            {
                selectUser.push(name[0]);
                selectUsername.push(name[1]);
            }
            else
            {
                removeA(selectUser, name[0]);
                removeA(selectUsername, name[1]);
            }
        });

        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }


        $("#button-select").click(function(){
            $("#modal-user").modal("hide");
            //ชื่อ
            $("#users_id").val(selectUsername);
            //id
            $("#users_room").val(selectUser);
        });
        
        $("#room-table").on("click",".btn-edit",function(e){
            $("#modal-create").modal('show');
            $("#btn-update").show();
            $("#btn-action").hide();
            $("#from_create").hide();
            $("#from_edit").show();
            $("#adds").hide();
            $("#edits").show();
           
            
            $.ajax({            
                url: $(this).attr('value'),
                method: 'GET',
                success: function(response){
                    var str_name = [];
                    for(let key in response) {
                        if(response[key].name != undefined){
                            str_name.push(response[key].name);
                        }
                    }
                    var link = "{!! route('room-update',':id') !!}";
                    link = link.replace(':id',response.id);
                    $("#rooms_name").val(response.rooms_name);
                    $("#rooms_size").val(response.rooms_size);
                    $("#rooms_status").val(response.rooms_status);
                    $("#building_id").val(response.building_id);
                    $("#building_floor").val(response.building_floor);
                    $("#users_id").val(response.users_id);
                    $("#users_id").val(str_name.join(','));
                    
                    $("#rooms_detail").val(response.rooms_detail);
                    $("#rooms_equipment").val(response.rooms_equipment);
                    $("#form-room-meeting").attr('action',link);
                }
            });
            $('#modal-create').on('hidden.bs.modal', function() {
                $('#rooms_name').val('');
                $('#rooms_size').val('');
                $('#building_floor').val('');
                $('#rooms_equipment').val('');
                $('#users_id').val('');
                $('#users_room').val('');
               
            });
        });

        $("#room-table").on("click",".btn-delete",function(e){
            var id = $(this).attr('id');
            if(confirm("ยืนยันการลบข้อมูล"))
            {
                $.ajax({
                    url:"{!! route('room-destroy') !!}",
                    method: 'GET',
                    data:{id:id},
                   
                    success: function(response){
                    if(response.type == "success")
                    {
                        swal("ลบข้อมูล", "กรุณาตรจสอบข้อมูล", "success");
                        $('#room-table').DataTable().ajax.reload();
                    }
                },
                error: function(response){
                    swal("ผิดพลาด", "กรุณาตรจสอบข้อมูลการจองห้องประชุม", "error");
                }
                })
            }
            else{
                return false;
            }
        });
     
        
        $("#btn-update").click(function(e){
           var form = $("#form-room-meeting");
           $.ajax({
                url: form.attr('action'),
                method: 'PUT',
                data: form.serialize(),
                success: function(response)
                    {
                    if(response.type == "success"){
                        $("#modal-create").modal('hide');
                        document.getElementById("form-room-meeting").reset();
                        $("#room-table").DataTable().ajax.reload();
                        swal("สำเร็จ", "แก้ไขข้อมูลห้องประชุมเรียบร้อย", "success");
                   
                    }
                },
                error : function(xhr){
                var errors = xhr.responseJSON;
                   if(errors['rooms_name'])
                   {
                       var inputGroup = $("#rooms_name").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger')
                        .after('<p class="text-danger">'+errors['rooms_name'][0]+'</p>');
                        
                   }

                   if(errors['rooms_size'])
                   {
                       var inputGroup = $("#rooms_size").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['rooms_size'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['rooms_size'][0]+'</p>');
                   }
                   if(errors['rooms_equipment'])
                   {
                       var inputGroup = $("#rooms_equipment").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['rooms_equipment'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['rooms_equipment'][0]+'</p>');
                   }
                 

                   if(errors['rooms_status'])
                   {
                       var inputGroup = $("#rooms_status").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['rooms_status'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['rooms_status'][0]+'</p>');
                   }
                   if(errors['building_floor'])
                   {
                       var inputGroup = $("#building_floor").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['building_floor'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['building_floor'][0]+'</p>');
                   }
            }
           })
           
            e.preventDefault();
        });



        $('#btn-select').click(function(e) {
            e.preventDefault();  
            selectUser = [];
            selectUsername = [];
            $("#modal-user").modal("show");
                $("#user-table").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatables-modal') !!}',
                columns: [
                    {data: 'check',name:'check',orderable:false,searchable:false},
                    {data: 'name', name:'name'}
                
                
                ]
            });
        });

        $('#btn-select_edit').click(function(e) {
            e.preventDefault();    
            selectUser = [];
            selectUsername = [];
            var id = $('.btn-delete').attr('id');
            var link = "{!! route('datatables-modal-edit',':id') !!}";
                link = link.replace(':id',id);

            $("#modal-user").modal("show");
                $("#user-table").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax:link,
                "initComplete":function(settings, json){
                    $("input[name='check[]']:checked").each(function(){
                        var name = $(this).val().split('_');
                        selectUser.push(name[0]);
                        selectUsername.push(name[1]);
                        console.log(selectUser);
                    });
                },
                columns: [
                    {data: 'check',name:'check',orderable:false,searchable:false},
                    {data: 'name', name:'name'}
                
                
                ]
            
            });

            
        });
        



    });
</script>

@endsection