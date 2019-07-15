<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Building;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('building.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Requests\BuildingRequest $request)
    {
        $building = new Building();
        $building->buildings_name   = $request->buildings_name;
        $building->status   = $request->status;
      
        $building->save();

        return response()->json([
            'type' => 'success',
            'text' => 'ระบบได้เพิ่มข้อมูลเรียบร้อย'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $building = Building::findOrFail($id);
        return response()->json($building);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\BuildingRequest $request, $id)
    {
        $Building = Building::findOrFail($id);
        $Building->Buildings_name   =  $request->Buildings_name;
        $building->status   = $request->status;
        $Building->save();
    return response()->json([
            'type' => 'success',
            'text' => 'ระบบได้แก้ไขข้อมูลเรียบร้อย'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $building = Building::find($request->input('id'));
        if($building->delete()){
            echo 'ลบข้อมูลเรียบร้อย';
        }
       
       
    }
    public function data()
    {
        return Datatables::of(Building::query())
        ->rawColumns(['action','status'])
        ->addColumn('action', function($building) 
        {
            return "<button 
                class='btn btn-sm btn-warning btn-edit'
                value = '".route('building-edit',$building->id)."'> 
               <span class='btn-label'><i class='fa fa-pencil'></i></span>แก้ไข
               </button>  
                    <button 
               class='btn btn-sm btn-danger btn-delete'
                id ='".$building->id."'> 
              <span class='btn-label'><i class='fa fa-pencil'></i></span>ลบ
              </button>";
        })
        ->addColumn('status',function($building) 
        {
            return $building->status == 1 ? '<label class="label label-success">ใช้งาน</label>' : '<label class="label label-danger">ไม่ใช้งาน</label>';
        })
     
        ->make(true);
    }
}
