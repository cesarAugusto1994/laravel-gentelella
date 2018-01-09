<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Validator;

class ModelsController extends Controller
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
        return view('admin.models.index')->with('models', Models::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.models.create');
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
            'name' => 'required|min:2|max:255|unique:models'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $someName = Models::where('name', $name)->get();

        if (count($someName) > 0) {
            return back()->withInput();
        }

        Models::create($request->request->all());

        return redirect()->route('models');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.models.edit')->with('model', Models::find($id));
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
        $model = Models::find($id);

        $model->name = $request->request->get('name');

        $model->save();

        return redirect()->route('models');
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
