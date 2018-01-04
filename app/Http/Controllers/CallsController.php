<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Call;
use App\CallSubjects;
use App\CallEquipments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Equipment;

class CallsController extends Controller
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
        $calls = Call::all();

        return view('admin.calls.index')->with('calls', $calls);
    }


    public function entry()
    {
        $calls = Call::where('status', Call::STATUS_AUTORIZADO)->get();

        return view('admin.calls.entry.index')->with('calls', $calls);
    }

    public function entryConfirm($id)
    {
        $call = Call::find($id);

        $callEquipments = CallEquipments::where('call_id', $id)->get();

        $equipments = $callEquipments->map(function($call) {
            return $call->equipments;
        });

        return view('admin.calls.entry.confirm')
        ->with('equipments', $equipments)
        ->with('call', $call);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.calls.create')->with('subjects', CallSubjects::all());
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
            'subject' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $call = new Call();
        $call->subject_id = $data['subject'];
        $call->date = \DateTime::createFromFormat('d/m/Y', $data['date']);
        $call->user_id = Auth::user()->id;
        $call->status = 'ABERTO';
        $call->save();

        return redirect()->route('call_equipments_create', ['call' => $call->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $call = Call::find($id);
        $callEquipments = CallEquipments::where('call_id', $id)->get();


        $equipments = $callEquipments->map(function($call) {
            return $call->equipments;
        });

        return view('admin.calls.finish')
        ->with('call', $call)
        ->with('equipments', $equipments);
    }

    public function confirmation($id)
    {
        $call = Call::find($id);
        $callEquipments = CallEquipments::where('call_id', $id)->get();

        $equipments = $callEquipments->map(function($call) {
            return $call->equipments;
        });

        return view('admin.calls.confirmation')
        ->with('call', $call)
        ->with('equipments', $equipments);
    }

    public function cancel($id)
    {
        $call = Call::find($id);
        $callEquipments = CallEquipments::where('call_id', $id)->get();

        $equipments = $callEquipments->map(function($call) {
            return $call->equipments;
        });

        return view('admin.calls.cancel')
        ->with('call', $call)
        ->with('equipments', $equipments);
    }

    public function execute(Request $request, $id)
    {
        $data = $request->request->all();

        $call = Call::find($id);
        $call->status = Call::STATUS_AGUARDANDO_AUTORIZACAO;
        $call->save();

        return redirect()->route('calls');
    }

    public function screening(Request $request, $id)
    {
        $data = $request->request->all();

        $call = Call::find($id);
        $call->status = Call::STATUS_DEVOLVIDO;
        $call->save();

        $callEquipments = CallEquipments::where('call_id', $id)->get();

        $callEquipments->map(function($call) {
            $equipment = $call->equipments;
            $equipment->status_id = Equipment::STATUS_TRIAGEM;
            $equipment->save(); 
        });

        return redirect()->route('calls');
    }

    public function cancelConfirm(Request $request, $id)
    {
        $data = $request->request->all();

        $call = Call::find($id);
        $call->status = Call::STATUS_CANCELADO;
        $call->save();

        $callEquipments = CallEquipments::where('call_id', $id)->get();

        $callEquipments->map(function($call) {
            $equipment = $call->equipments;
            $equipment->status_id = Equipment::STATUS_DISPONIVEL;
            $equipment->save();
        });

        return redirect()->route('calls');
    }

    public function confirm(Request $request, $id)
    {
        $data = $request->request->all();

        $call = Call::find($id);
        $call->status = Call::STATUS_AUTORIZADO;
        $call->save();

        $callEquipments = CallEquipments::where('call_id', $id)->get();

        $callEquipments->map(function($call) {
            $equipment = $call->equipments;
            $equipment->status_id = Equipment::STATUS_EM_USO;
            $equipment->save();
        });

        return redirect()->route('calls');
    }

    public function renderSuccessView()
    {
        return view('admin.calls.message');
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
