<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Brand;
use App\Models;
use Illuminate\Support\Facades\Validator;
use App\Status;
use Request as Req;

class EquipmentsController extends Controller
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
    public function index(Request $request)
    {
        return view('admin.equipments.index')
        ->with('equipments', Equipment::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.equipments.create')
        ->with('brands', Brand::all())
        ->with('models', Models::all())
        ->with('statuses', Status::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:2|max:255',
            'brand' => 'required',
            'model' => 'required',
            'status' => 'required',
            'qtty' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach(range(1, $data['qtty']) as $item) {

            $equipment = new Equipment();
            $equipment->name = $data['name'];
            $equipment->brand_id = $data['brand'];
            $equipment->model_id = $data['model'];
            $equipment->active_code = $data['active'];
            $equipment->serial = $data['serial'];
            $equipment->date = new \DateTime('now');
            $equipment->status_id = $data['status'];
            $equipment->Save();

        }

        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->message = "O Produto " . $data['name'] . " foi adicionado ao estoque com " . $data['qtty'] . " unidade(s).";
        $log->save();

        return redirect()->route('equipments')->with('message', 'Novo Equipamento adicionado com sucesso.');

    }

    public function filterFromAjax(string $filter)
    {
        $result = Equipment::where('name', 'like', '%'. $filter . '%')->groupBy('name', 'brand_id', 'model', 'serial');

        return $result->get()->toJson();
    }

    public function backToStock(Request $request, $id)
    {
        $data = $request->request->all();

        $equipment = Equipment::find($id);
        $equipment->status_id = Equipment::STATUS_DISPONIVEL;
        $equipment->save();

        return redirect()->route('screenings');
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
        return view('admin.equipments.edit')
        ->with('equipment', Equipment::find($id))
        ->with('brands', Brand::all())
        ->with('models', Models::all())
        ->with('statuses', Status::all());
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
        $data = $request->request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:2|max:255',
            'brand' => 'required',
            'model' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $equipment = Equipment::find($id);
        $equipment->name = $data['name'];
        $equipment->brand_id = $data['brand'];
        $equipment->model_id = $data['model'];
        $equipment->active_code = $data['active'];
        $equipment->serial = $data['serial'];
        $equipment->status_id = $data['status'];
        $equipment->Save();

        return redirect()->route('equipments')->with('message', 'Equipamento editado com sucesso.');

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
