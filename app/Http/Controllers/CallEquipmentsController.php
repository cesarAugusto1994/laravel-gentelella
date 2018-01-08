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
    public function create($id)
    {
        $call = Call::find($id);

        if (Req::has('remove-equipment')) {

           $equip = Equipment::find($call->equipment_id);
           $equip->status_id = Equipment::STATUS_DISPONIVEL;
           $equip->save();

           $call->equipment_id = null;
           $call->save();
        }

        return view('admin.calls.equipments.create')
        ->with('call', $call);
    }

    public function add($id)
    {
        $result = $filter = [];
        $message = '';

        $call = Call::find($id);
/*
        if ($call->equipment) {
            $message = 'Já existe um equipamento adicionado à este Chamado.';
        }
*/
        if (Req::has('add-equipment') && empty($callEquip)) {

            $equip = Equipment::find(Req::input('add-equipment'));

            $call->equipment_id = $equip->id;
            $call->save();

            $equip->status_id = Equipment::STATUS_RESERVADO;
            $equip->save();

            $message = "Equipamento {$equip->name} adicionado ao Chamado.";

            return redirect()->route('call', ['id' => $id, 'message' => $message]);
        }

        if (Req::has('filter')) {
            $equipaments = Equipment::where('name', 'like', '%' . Req::input('filter') . '%');
            $result = $equipaments->where('status_id', Equipment::STATUS_DISPONIVEL)->get();
        }

        return view('admin.calls.equipments.add')
        ->with('call', Call::find($id))
        ->with('equipments', $result)
        ->with('message', $message)
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
