<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','BookingController@index');
Route::get('/logout','loginController@logout');


Route::get('/layout', function () {
    return view('layouts.main');
});



Route::prefix('room-meeting')->group(function(){
   
    //หน้า เพิ่มห้องประชุม
    Route::get('/',[
        'uses' => 'RoomMeetingController@index',
        'as'   => 'room-meeting',
        'middleware' => 'roles',
        'roles'      => ['superadmin']
     //datatable   ห้องประชุม 
    ]);
    Route::get('/detail',[
        'uses' => 'RoomMeetingController@detail',
        'as'   => 'room-detail-meeting',
       
       
     //datatable   ห้องประชุม 
    ]);
    Route::get('/data',[
        'uses' => 'RoomMeetingController@data',
        'as'   => 'room-datatables',
       

    ]);
    Route::post('/create',[
        'uses' => 'RoomMeetingController@store',
        'as'   => 'create-room-post',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']
    ]);
    Route::get('/update/{room}',[
        'uses' => 'RoomMeetingController@edit',
        'as'   => 'room-edit',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']
    ]);
    Route::put('/update/{room}',[
        'uses' => 'RoomMeetingController@update',
        'as'   => 'room-update',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']
    ]);
    Route::get('/delete',[
        'uses' => 'RoomMeetingController@destroy',
        'as'   => 'room-destroy',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']
    ]);
    Route::get('/datatables-modal',[
        'uses' => 'RoomMeetingController@datatables',
        'as' => 'datatables-modal',
        'middleware' => 'roles',
        'roles' => 'superadmin'
    ]);
    Route::get('/datatables-modal-edit/{id}',[
        'uses' => 'RoomMeetingController@datatables_edit',
        'as' => 'datatables-modal-edit',
        'middleware' => 'roles',
        'roles' => 'superadmin'
    ]);
    Route::get('/select-user/{id}',[
        'uses' => 'BookingController@selectUser',
        'as'   => 'select-user',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']
    ]);

   
  
    
    
});

Route::prefix('building')->group(function(){
   
    //หน้า เพิ่มห้องประชุม
    Route::get('/',[
        'uses' => 'BuildingController@index',
        'as'   => 'building',
        'middleware' => 'roles',
        'roles'      => ['superadmin']
     //datatable   ห้องประชุม 
    ]);
    Route::get('/data',[
        'uses' => 'BuildingController@data',
        'as'   => 'building-datatables',
        'middleware' => 'roles',
        'roles' =>['superadmin','admin']

    ]);
    Route::post('/create',[
        'uses' => 'BuildingController@create',
        'as'   => 'create-building-post',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']
    ]);
    Route::get('/update/{building}',[
        'uses' => 'BuildingController@edit',
        'as'   => 'building-edit',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']
    ]);
    Route::put('/update/{building}',[
        'uses' => 'BuildingController@update',
        'as'   => 'building-update',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']
    ]);
    Route::get('/delete',[
        'uses' => 'BuildingController@destroy',
        'as'   => 'building-destroy',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']
    ]);

   
  
    
    
});

Route::prefix('booking')->group(function(){
    Route::get('/check-user/{id}',[
        'uses' => 'BookingController@checkUser',
        'as'   => 'booking-check-user'
    ]);
    
    Route::get('/create',[
        'uses' => 'BookingController@create',
        'as'   => 'booking-create',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']
    ]);
    Route::get('/room/{date}/{time_begin}/{time_end}/{building}',[
        'uses' => 'BookingController@room',
        'as'   => 'booking-room',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']
    ]);
    Route::get('/select-room/{id}',[
        'uses' => 'BookingController@selectRoom',
        'as'   => 'select-room',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']
    ]);
   Route::post('/create',[
        'uses' => 'BookingController@store',
        'as'   => 'booking-create-post',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']     
    ]);
    Route::get('/index',[
        'uses' => 'BookingController@index',
        'as'   => 'booking-index',
      
    ]);
    Route::get('/add-day/{id}',[
        'uses' => 'BookingController@addDay',
        'as'   => 'booking-add-day',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']     
    ]);
    Route::post('/add-day/{id}',[
        'uses' => 'BookingController@addDayPost',
        'as'   => 'booking-add-day-post',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']     
    ]);
    Route::get('/edit/{id}',[
        'uses' => 'BookingController@edit',
        'as'   => 'booking-edit',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']     
    ]);
    Route::put('/update/{id}',[
        'uses' => 'BookingController@update',
        'as'   => 'booking-update',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']     
    ]);
    Route::get('/delete/{id}',[
        'uses' => 'BookingController@destroy',
        'as'   => 'booking-destroy',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']     
    ]);
     Route::get('/approve',[
        'uses' => 'BookingController@approve',
        'as'   => 'booking-approve',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']     
    ]);
    Route::get('/approve-data',[
        'uses' => 'BookingController@approveData',
        'as'   => 'booking-approve-data',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']     
    ]);
    //checkbox อนุมัติ
    Route::get('/approve-all',[
        'uses' => 'BookingController@approveAll',
        'as'   => 'booking-approve-all',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']     
    ]);
    Route::get('/approve-delete-all',[
        'uses' => 'BookingController@approveDeleteAll',
        'as'   => 'booking-approve-delete-all' ,
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']    
    ]);
    //ปุ่มกดอนุมัติ
    Route::get('/approve-booking/{id}/{status}',[
        'uses' => 'BookingController@approveBooking',
        'as'   => 'approve-booking',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']     
    ]);
    Route::get('/room-data/{id}/{date}/{begin}/{end}',[
        'uses' => 'BookingController@approveRoom',
        'as'   => 'approve-room' ,
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']    
    ]);
    Route::get('/room-change/{id}/{rooms}',[
        'uses' => 'BookingController@roomChange',
        'as'   => 'booking-change-room',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']     
    ]);
    Route::get('/approve-delete/{id}',[
        'uses' => 'BookingController@approveDelete',
        'as'   => 'approve-delete',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin']     
    ]);
    Route::post('/filter',[
        'uses' => 'BookingController@selectRoombuilding', 
        'as' => 'filter-calendar'
        ]);
    Route::post('/fetch_data',[
        'uses' => 'BookingController@fetch_data', 
        'as' => 'fetch_data'
        ]);
  
});

Route::get('/',[
    'uses' => 'ProfileController@index',
    'as'   => 'profile-index',
    'middleware' => 'roles',
    'roles'      => ['superadmin','admin','user']     
]);
Route::get('/profile',[
        'uses' => 'ProfileController@edit',
        'as'   => 'profile-edit',
        'middleware' => 'roles',
        'roles'      => ['superadmin','admin','user']     
]);
Route::post('/profile',[
    'uses' => 'ProfileController@update',
    'as'   => 'profile-update',
    'middleware' => 'roles',
    'roles'      => ['superadmin','admin','user']     
]);


Auth::routes();

Route::get('/home', 'BookingController@index')->name('home');
Route::prefix('user')->group(function(){
    Route::get('/',[
        'uses' => 'UserController@index',
        'as' => 'user-index',
        'middleware' => 'roles',
        'roles' => 'superadmin'
    ]);
    Route::get('/datatables',[
        'uses' => 'UserController@datatables',
        'as' => 'user-datatables',
        'middleware' => 'roles',
        'roles' => 'superadmin'
    ]);
    Route::get('/edit/{user}',[
        'uses' => 'UserController@edit',
        'as' => 'user-edit',
        'middleware' => 'roles',
        'roles' => 'superadmin'
    ]);
    Route::get('/delete',[
        'uses' => 'UserController@destroy',
        'as' => 'user-destroy',
        'middleware' => 'roles',
        'roles' => 'superadmin'
    ]);
   
    Route::post('/update/{user}',[
        'uses' => 'UserController@update',
        'as' => 'user-update',
        'middleware' => 'roles',
        'roles' => 'superadmin'
    ]);
    Route::post('/create',[
        'uses' => 'UserController@create',
        'as' => 'create-user-post',
        'middleware' => 'roles',
        'roles' => 'superadmin'
    ]);
});
Route::prefix('report')->group(function(){
   

    Route::get('/pdf',[
        'uses' => 'ReportController@pdf',
        'as' => 'report-pdf',
        'roles' => ['admin','manager','user']
    ]);
    Route::post('/pdf',[
        'uses' => 'ReportController@GeneratePdf',
        'as' => 'report-generate-pdf',
        'roles' => ['admin','manager','user']
    ]);
    Route::get('/pdf/fetch_data',[
        'uses' => 'ReportController@fetch_data',
        'as' => 'pdf-fetch_data',
        'roles' => ['admin','manager','user']
    ]);
    
});

// Route::post('/pdf/fetch_data', 'ReportController@fetch_data')->name('pdf.fetch_data');



