@extends('layouts.main')

@section('title','Room Meeting List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                                
                        <div class="d-flex">
                            <h4 class="card-title">รายการห้องประชุม</h4>
                            
                                            
                        </div>
                        <div class="table-responsive m-t-40">
                            <table  id="rooms-table"  class="table display  table-striped">
                                <thead>
                                    <tr>
                                    
                                        <th>ชื่อห้อง</th>
                                        <th>อาคาร</th>
                                        <th>ความจุคน</th>
                                        <th>อุปกรณ์ภายใน</th>
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
<script>
    $("#rooms-table").DataTable({
        processing : true,
        serverSide : true,
        ajax: "{!! route('room-datatables') !!}",
       
        columns : [
           
            {data : 'rooms_name' , name: 'rooms_name'},
            {data : 'building' , name: 'building'},
            {data : 'rooms_size' , name: 'rooms_size'},
            {data : 'rooms_equipment' ,name: 'rooms_equipment'},
            {data : 'rooms_status' , name: 'rooms_status'},
           
        ]
    });

</script>

@endsection