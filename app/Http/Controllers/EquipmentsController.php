<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Brand;
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
    public function index()
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
            $equipment->model = $data['model'];
            $equipment->active_code = $data['active'];
            $equipment->serial = $data['serial'];
            $equipment->date = new \DateTime('now');
            $equipment->status_id = $data['status'];
            $equipment->Save();

        }

        return redirect()->route('equipments')->with('message', 'Novo Equipamento adicionado com sucesso.');
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
