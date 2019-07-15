@extends('layouts.main') @section('title','Room booking') @section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                        <div class="d-flex">
                            <h4 class="card-title">รายการห้องประชุม</h4>
                            <div class="ml-auto">
                                <div class="row">
                                    <div class="col-md-4" align="right"><b><span ></span>วันที่</b></div>
                                        <div class="col-md-5">
                                            <div class="input-group input-daterange">
                                            
                                                <input type="text" name="start_date" id="start_date" readonly class="form-control mydatepicker" />
                                                <div class="input-group-addon">to</div>
                                                <input type="text" name="end_date" id="end_date" readonly class="form-control mydatepicker" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                            <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">กรองข้อมูล</button>
                                            <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                                            </div>
                                            
                                        </div>
                                </div>
                            </div>
                        
                                            
                                            
                        </div>
                        <div class="table-responsive m-t-40">
                            <table  id="report-table"  class="table display  table-striped">
                            {!! csrf_field() !!}
                                <thead>
                                    <tr>
                                        <th>ชื่ออาคาร</th>
                                        <th>ชื่อห้องประชุม</th>
                                        <th>เรื่องการประชุม</th>
                                        <th>วันที่ประชุม(ว/ด/ป)</th>
                                        <th>เวลาเริ่มต้น-สิ้นสุด</th>
                                        <th>ผู้จองห้องประชุม</th>
                                        <th>ผู้ดำเนินการ</th>
                                        <th>สถานะ</th>
                                        
                                    </tr>                               
                                </thead>                                        
                            </table>
                        </div>
              

               </div>   
            </div>
        </div>
    </div>

    @endsection 
    @section('script')
   
 

        <script type="text/javascript" charset="utf-8">
      
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                


            $('#report-table').DataTable({
                
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
        order: [[ 3, "desc" ]] ,
                processing : true,
                serverSide : true,  
                destroy    : true,
                    ajax: { 
                    url: "{!! route('pdf-fetch_data') !!}",
                    type: 'GET',
                    data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                      }
                    },
                    columns: [
                            { data: 'buildings', name: 'buildings' },
                            { data: 'rooms.rooms_name', name: 'rooms.rooms_name' },
                            { data: 'booking_title', name: 'booking_title' },
                            { data: 'booking_date', name: 'booking_date' },
                            { data: 'booking_time', name: 'booking_time' },
                            { data: 'user_id', name: 'user_id' },
                            { data: 'approve_name', name: 'approve_name' },
                            { data: 'booking_status', name: 'booking_status' }

                            
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'excel', 'pdf', 'print',
                        
                        ],
                       
                        
                });
               
           

            $('#filter').click(function(){
                $('#report-table').DataTable().draw(true);
            });

            $('#refresh').click(function() {
                $('#start_date').val('');
                $('#end_date').val('');
              
            });
          
           
       
        </script>

    @endsection