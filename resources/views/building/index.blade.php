@extends('layouts.main')

@section('title','Building List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                                
                        <div class="d-flex">
                            <h4 class="card-title">รายการอาคาร</h4>
                        <div class="ml-auto">
                                <div class="form-group">
                                     <button type="button" class="btn btn-info btn-rounded" id="add-buildings">เพิ่มอาคาร</button>
                                </div>

                        </div>
                                            
                                            
                    </div>
                        <div class="table-responsive m-t-40">
                            <table  id="building-table"  class="table display  table-striped">
                                <thead>
                                    <tr>
                                       
                                        <th>ชื่ออาคาร</th>
                                        <th>สถานะการใช้งาน</th> 
                                        <th>Action</th> 
                                    </tr>                               
                                </thead>                                        
                            </table>
                        </div>
                                <!-- modal create -->
                                <div id="modal-create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">จัดการรายการอาคาร</button>
                                                    <h4 class="modal-title" id="myModalLabel"></h4> 
                                            </div>
                                                <div class="modal-body">
                                                    <form id ="form-building" class=" form m-t-40" > 
                                                                {!! csrf_field() !!}
                                                        <div class="col-md-12 m-b-20 " >
                                                            <div class="input-group" >                     
                                                                <input type="text" class="form-control" id="buildings_name" placeholder="ชื่ออาคาร" name="buildings_name">
                                                            </div>
                                                        </div>

                                                        <!-- <div class="col-md-12 m-b-20">   
                                                            <div class="input-group" >
                                                                <input type="text" class="form-control" placeholder="Sizeroom" id="rooms_size" name='rooms_size'> 
                                                            </div>
                                                        </div> 

                                                        <div class="col-md-12 m-b-20">
                                                            <div class="input-group" >    
                                                                <input type="text" class="form-control" placeholder="Detailroom" id="rooms_detail"name='rooms_detail'>
                                                            </div>
                                                        </div>  -->

                                                        <div class="col-md-12 ">
                                                            <div class="input-group" >    
                                                                <select class="form-control" id="status"  name='status'>
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
                        
                                
                            
            </div>
        </div>
                              
    </div>
</div>

@endsection

@section('script')
<script>
    $("#building-table").DataTable({
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
        ajax: "{!! route('building-datatables') !!}",
       
        columns : [
           
            {data : 'buildings_name' , name: 'buildings_name'},
           
            {data : 'status' , name: 'status'},
            {data : 'action' , name: 'action',orderable:false,searchable:false}

        ]
    });

    $(document).ready(function(e){
        $("#add-buildings").click(function(e){
            $("#modal-create").modal('show');
            $("#btn-action").show();
            $("#btn-update").hide();
        });

        $("#btn-action").click(function(e){
           var form =$("#form-building");
           $.ajax({
                url:"{!! route('create-building-post') !!}",
                method: 'POST',
                data: form.serialize(),
                success: function(response)
                    {
                        console.log(response);
                    if(response.type == "success"){
                        $("#modal-create").modal('hide');
                        document.getElementById("form-building").reset();
                        $("#building-table").DataTable().ajax.reload();
                        swal("สำเร็จ", "เพิ่มห้องประชุมเรียบร้อย", "success");
                    }
                },
                error: function(xhr){
                  var errors = xhr.responseJSON;
                   if(errors['buildings_name'])
                   {
                       var inputGroup = $("#buildings_name").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger')
                        .after('<p class="text-danger">'+errors['buildings_name'][0]+'</p>');
                        
                   }

                
                   if(errors['status'])
                   {
                       var inputGroup = $("#status").closest('.input-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger','<p class="text-danger">'+errors['status'][0]+'</p>')
                        .after('<p class="text-danger">'+errors['status'][0]+'</p>');
                   }

                  
                }

           });
           e.preventDefault();
        });
        
        $("#building-table").on("click",".btn-edit",function(e){
            $("#modal-create").modal('show');
            $("#btn-update").show();
            $("#btn-action").hide();
           
            
            $.ajax({            
                url: $(this).attr('value'),
                method: 'GET',
                success: function(response){

                    var link = "{!! route('building-update',':id') !!}";
                    link = link.replace(':id',response.id);
                   
                    $("#buildings_name").val(response.buildings_name);
                  
                    $("#form-building").attr('action',link);
                }
            });
        });

        $("#building-table").on("click",".btn-delete",function(e){
            var id = $(this).attr('id');
            if(confirm("ยืนยันการลบข้อมูล"))
            {
                $.ajax({
                    url:"{!! route('building-destroy') !!}",
                    method: 'GET',
                    data:{id:id},
                    success:function(data)
                    {
                        swal("ลบข้อมูล", "กรุณาตรจสอบข้อมูล", "success");
                        $('#building-table').DataTable().ajax.reload();
                    }
                })
            }
            else{
                return false;
            }
        });
     
        
        $("#btn-update").click(function(e){
           var form = $("#form-building");
           $.ajax({
                url: form.attr('action'),
                method: 'PUT',
                data: form.serialize(),
                success: function(response)
                    {
                    if(response.type == "success"){
                        $("#modal-create").modal('hide');
                        document.getElementById("form-building").reset();
                        $("#room-table").DataTable().ajax.reload();
                        swal("สำเร็จ", "แก้ไขข้อมูลห้องประชุมเรียบร้อย", "success");
                   
                    }
                },
                error : function(xhr){
                var errors = xhr.responseJSON;
                   if(errors['buildings_name'])
                   {
                       var inputGroup = $("#buildings_name").closest('.form-group');
                        inputGroup.next('.text-danger').remove();
                       inputGroup
                        .addClass('has-danger')
                        .after('<p class="text-danger">'+errors['buildings_name'][0]+'</p>');
                        
                   }

                  

            }
           })
           
            e.preventDefault();
        });
        
        
    });
</script>

@endsection