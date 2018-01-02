<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Call;
use App\CallEquipments;
use Request as Req;
use App\Equipment;

class CallEquipmentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($call)
    {
    
        if (Req::has('remove-equipment')) {
            
            $callEquip = CallEquipments::find(Req::get('remove-equipment'));
            
            $equip = Equipment::find($callEquip->equipment_id);
            
            $callEquip->delete();

            $equip->status_id = Equipment::STATUS_DISPONIVEL; #Agendado
            
            $equip->save();
        }

        $equipments = CallEquipments::where('call_id', $call)->get();

        return view('admin.calls.equipments.create')
        ->with('call', Call::find($call))
        ->with('equipments', $equipments);
    }

    public function add($call)
    {
        $result = $filter = [];

        if (Req::has('add-equipment')) {
            
            $equip = Equipment::find(Req::input('add-equipment'));

            $callEquip = new CallEquipments();
            $callEquip->call_id = $call;
            $callEquip->equipment_id = $equip->id;
            $callEquip->status = 'ADICIONADO';
            $callEquip->save();

            $equip->status_id = Equipment::STATUS_AGENDADO; #Agendado
            $equip->save();
        }

        if (Req::has('filter')) {
            $equipaments = Equipment::where('name', 'like', '%' . Req::input('filter') . '%');            
            $result = $equipaments->where('status_id', Equipment::STATUS_DISPONIVEL)->get();
        }

        return view('admin.calls.equipments.add')
        ->with('call', Call::find($call))
        ->with('equipments', $result)
        ->with('filter', Req::input('filter'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
