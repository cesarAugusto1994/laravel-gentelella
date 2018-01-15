<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Queries;
use App\Status;
use App\Equipment;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
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
        return view('admin.reports.index')
        ->with('reports', Report::all())
        ->with('statuses', Status::all())
        ->with('equipments', Equipment::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->request->get('name');

        $validator = Validator::make(['name' => $name], [
            'name' => 'required|min:2|max:255|unique:reports'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $someName = Report::where('name', $name)->get();

        if (count($someName) > 0) {
            return back()->withInput();
        }

        $report = new Report();
        $report->name = $name;
        $report->save();

        return redirect()->route('reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.reports.show')
        ->with('report', Report::find($id))
        ->with('queries', Queries::where('report_id', $id)->get());
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
