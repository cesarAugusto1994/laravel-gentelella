<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Queries;
use App\Status;
use App\Equipment;
use App\Brand;
use App\Models;
use Illuminate\Support\Facades\Validator;

class QueriesController extends Controller
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
    public function create()
    {
        return view('admin.queries.create')
        ->with('reports', Report::all());
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
            'name' => 'required|min:2|max:255|unique:queries',
            'link' => 'required|min:2|max:255',
            'report' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $someName = Queries::where('name', $data['name'])->get();

        if ($someName->isNotEmpty()) {
            return back()->withInput();
        }

        $query = new Queries();
        $query->name = $data['name'];
        $query->link = $data['link'];
        $query->report_id = $data['report'];
        $query->save();

        return redirect()->route('report', ['id' => $data['report']]);
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

    public function run($id)
    {
        return view('admin.run.index')
            ->with('query', Queries::find($id));
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

    public function getReportFromStatus($id)
    {
        return view('admin.reports.queries.status')
            ->with('status', Status::find($id));
    }

    public function getReportGrouping($group)
    {
        $equipments = Equipment::all();

        $result = [];

        foreach ($equipments->toArray() as $key => $equip) {

            $model = Models::find($equip['model_id']);

            $k = $equip['name'] . ':' . $equip['model_id'];
            $k2 = $equip['name'];

            if(!isset($result[$k2])) {
                $result[$k2]['qtty'] = 0;
            }

            if(!isset($result[$k])) {
                $result[$k]['qtty'] = 0;
            }

            $result[$k]['name'] = $model->name;
            $result[$k2]['name'] = $equip['name'];

            $result[$k]['isModel'] = true;
            $result[$k2]['isModel'] = false;

            $result[$k2]['qtty']++;
            $result[$k]['qtty']++;
        }

        return view('admin.reports.queries.group')
            ->with('result', $result)
            ->with('total', array_sum(array_column($result, 'qtty'))/2);

    }


}
