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
        $brands = Brand::all();

        $models = Models::all();

        //$equipments = Equipment::groupBy($group);

        /*
        return view('admin.reports.queries.group')
            ->with('brands', $brands)
            ->with('models', $models)
            ->with('group', 'Marca e Modelos');
            */
    }


}
