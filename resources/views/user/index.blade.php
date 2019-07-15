@extends('layouts.main')

@section('title','จัดการผู้ใช้งาน')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                                
                        <div class="d-flex">
                            <h4 class="card-title">รายการผู้ใช้งาน</h4>
                        <div class="ml-auto">
                                <div class="form-group">
                                     <button type="button" class="btn btn-info btn-rounded" id="add-user">เพิ่มผู้ใช้งาน</button>
                                     
                                </div>

                        </div>
                                            
                                            
                    </div>
                        <div class="table-responsive m-t-40">
                            <table  id="user-table"  class="table display  table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ชื่อผู้ใช้งาน</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>สถานะ</th>
                                        <th>Action</th> 
                                    </tr>                               
                                </thead>                                        
                            </table>
                        </div>
                          
                        
    <div class="modal fade" id="modal-user">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" style="display:none;" id="adds">เพิ่มผู้ใช้งาน</h4>
                <h4 class="modal-title"style="display:none;"  id="edits">แก้ไขผู้ใช้งาน</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="form-user" >
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="name" >ชื่อผู้ใช้งาน</label>
                        <div>
                            <input id="name" type="text" class="form-control" name="name" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" >Username</label>
                        <div>
                            <input id="username" type="text" class="form-control" name="username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-Mail </label>

                        <div>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">รหัสผ่าน</label>

                        <div>
                            <input id="password" type="password" class="form-control" name="password" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role">สถานะ</label>

                        <div>
                            <select name="role" id="role" class="form-control">
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-warning" id="btn-edit" >แก้ไขข้อมูล</button>
                <button type="submit" class="btn btn-primary" id="btn-add" > เพิ่มรายชื่อ </button>
                               
                                   
            </div>
        </div> 
        
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
                               
                            
            </div>
        </div>
                              
    </div>
</div>

@endsection


@section('script')
<script>
  $("#user-table").DataTable({
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
    processing: true,
    serverSide: true,
    ajax: '{!! route('user-datatables') !!}',
    columns: [
      {data: 'id' , name:'id'},
      {data: 'name', name:'name'},
      {data: 'username', name:'username'},
      {data: 'email', name:'email'},
      {data: 'role',name:'role',orderable:false,searchable:false},
      {data: 'action',name:'action',orderable:false,searchable:false}
    ]
  });
        //////////////////////////////////////////////////////////
  $(document).ready(function(e){
        //////////////////////////////////////////////////////////        
    $("#add-user").click(function(e){
        document.getElementById("form-user").reset();
            $("#modal-user").modal('show');
            $("#btn-add").show();
            $("#btn-edit").hide();
            $("#adds").show();
            $("#edits").hide();
        });

        //////////////////////////////////////////////////////////
        $("#btn-add").click(function(e){
           var form =$("#form-user");
           $.ajax({
                url:"{!! route('create-user-post') !!}",
                method: 'POST',
                data: form.serialize(),
                success: function(response)
                    {
                    if(response.type == "success"){
                        $("#modal-user").modal('hide');
                        document.getElementById("form-user").reset();
                        $("#user-table").DataTable().ajax.reload();
                        swal("สำเร็จ", "เพิ่มรายชื่อเรียบร้อย", "success");
                    }
                },
                error: function(xhr){
                  var errors = xhr.responseJSON;
                   if(errors['name'])
                   {
                       var inputGroup = $("#name").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger')
                        .after('<p class="text-danger">'+errors['name'][0]+'</p>');
                        
                   }

                   if(errors['username'])
                   {
                       var inputGroup = $("#username").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['username'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['username'][0]+'</p>');
                   }

                   if(errors['email'])
                   {
                       var inputGroup = $("#email").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['email'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['email'][0]+'</p>');
                   }
                   if(errors['password'])
                   {
                       var inputGroup = $("#password").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['password'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['password'][0]+'</p>');
                   }

                  
                }

           });
           e.preventDefault();
        });




    $("#user-table").on('click','.btn-edit',function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            method: 'GET',
            success: function(response){
                $("#name").val(response.name);
                $("#username").val(response.username);
                $("#email").val(response.email);
                
                $("#role").val(response.role);

                var url = "{!! url('/') !!}"+"/user/update/"+response.id;
                $("#btn-edit").val(url);
            }
        });
        $("#modal-user").modal("show");
        $("#btn-add").hide();
        $("#btn-edit").show();
        $("#edits").show();
            $("#adds").hide();
    });

    $("#btn-edit").click(function(e){
        e.preventDefault();
        var form = $("#form-user");
        $.ajax({
            url: $(this).attr('value'),
            method: 'POST',
            data: form.serialize(),
            success: function(response){
                if(response.type == "success")
                {
                    $("#user-table").DataTable().ajax.reload();
                    $("#modal-user").modal('hide');
                    swal({
                        title: "ยินดีด้วยครับ",
                        text: response.text,
                        type: response.type,
                        confirmButtonText: "OK",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }else
                {
                    swal({
                        title: "ผิดพลาด",
                        text: response.text,
                        type: response.type,
                        confirmButtonText: "OK",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr){
               
                var errors = xhr.responseJSON;
                if(errors['name'])
                {
                    var inputGroup = $("#name").closest('.form-group');
                    inputGroup.next('.text-danger').remove();
                    inputGroup
                        .addClass('has-error')
                        .after('<p class="text-danger">'+errors['name'][0]+'</p>');
                }

                if(errors['username'])
                {
                    var inputGroup = $("#username").closest('.form-group');
                    inputGroup.next('.text-danger').remove();
                    inputGroup
                        .addClass('has-error')
                        .after('<p class="text-danger">'+errors['username'][0]+'</p>');
                }
                
                if(errors['email'])
                {
                    var inputGroup = $("#email").closest('.form-group');
                    inputGroup.next('.text-danger').remove();
                    inputGroup
                        .addClass('has-error')
                        .after('<p class="text-danger">'+errors['email'][0]+'</p>');
                }

            }
        });
    })

    $("#user-table").on("click",".btn-delete",function(e){
            var id = $(this).attr('id');
            if(confirm("ยืนยันการลบข้อมูล"))
            {
                $.ajax({
                    url:"{!! route('user-destroy') !!}",
                    method: 'GET',
                    data:{id:id},
                    success:function(data)
                    {
                        swal("ลบข้อมูล", "กรุณาตรจสอบข้อมูล", "success");
                        $('#user-table').DataTable().ajax.reload();
                    }
                })
            }
            else{
                return false;
            }
        });
  });
</script>
@endsection
