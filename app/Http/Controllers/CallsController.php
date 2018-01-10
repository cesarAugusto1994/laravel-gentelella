<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Call;
use App\CallSubjects;
use App\CallEquipments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Equipment;
use App\Models\User;
use App\Log;

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
        $calls = Call::orderBy('status', 'ASC')->get();

        return view('admin.calls.index')->with('calls', $calls);
    }

    public function entry()
    {
        $calls = Call::where('status', Call::STATUS_AUTORIZADO)->get();

        return view('admin.calls.entry.index')
        ->with('calls', $calls);
    }

    public function entryConfirm($id)
    {
        $call = Call::find($id);

        return view('admin.calls.entry.confirm')
        ->with('call', $call);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.calls.create')
        ->with('subjects', CallSubjects::all())
        ->with('users', User::all());
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
            'approval_date' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user()->isAdmin() ? $data['user'] : Auth::user()->id;

        $call = new Call();
        $call->subject_id = $data['subject'];
        $call->approval_date = \DateTime::createFromFormat('d/m/Y', $data['approval_date']);
        $call->user_id = $user;
        $call->external_code = $data['external_code'];
        $call->description = $data['description'];
        $call->status = Call::STATUS_ABERTO;
        $call->save();

        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->message = "Chamado n. " . $call->id . " criado.";
        $log->save();

        return redirect()->route('call_equipments_create', ['id' => $call->id]);
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

        return view('admin.calls.finish')
        ->with('call', $call);
    }

    public function screenings()
    {
        $equipments = Equipment::where('status_id', Equipment::STATUS_TRIAGEM)->get();

        return view('admin.calls.screenings.index')
        ->with('equipments', $equipments);
    }

    public function confirmation($id)
    {
        $call = Call::find($id);

        return view('admin.calls.confirmation')
        ->with('call', $call);
    }

    public function cancel($id)
    {
        $call = Call::find($id);

        return view('admin.calls.cancel')
        ->with('call', $call);
    }

    public function execute(Request $request, $id)
    {
        $data = $request->request->all();

        $call = Call::find($id);
        $call->status = Call::STATUS_AGUARDANDO_AUTORIZACAO;
        $call->save();

        $message = "O chamado de n. " . $call->id . " está aguardando autorização.";

        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->message = $message;
        $log->save();

        return redirect()->route('calls');
    }

    public function screening(Request $request, $id)
    {
        $data = $request->request->all();

        $call = Call::find($id);
        $call->status = Call::STATUS_DEVOLVIDO;
        $call->save();

        $message = "O equipamento " . $call->equipment->name . " de n. " . $call->equipment->id . " foi adicionado à Triagem.";

        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->message = $message;
        $log->save();

        $equipment = Equipment::find($call->equipment_id);
        $equipment->status_id = Equipment::STATUS_TRIAGEM;
        $equipment->save();

        return redirect()->route('calls')->with('message', $message);
    }

    public function cancelConfirm(Request $request, $id)
    {
        $data = $request->request->all();

        $call = Call::find($id);
        $call->status = Call::STATUS_CANCELADO;
        $call->save();

        $message = "O chamado de n. " . $call->id . " foi cancelado por " . Auth::user()->name;

        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->message = $message;
        $log->save();

        $equipment = $call->equipment;
        $equipment->status_id = Equipment::STATUS_DISPONIVEL;
        $equipment->save();

        return redirect()->route('calls');
    }

    public function confirm(Request $request, $id)
    {
        $data = $request->request->all();

        $call = Call::find($id);
        $call->status = Call::STATUS_AUTORIZADO;
        $call->approver_id = Auth::user()->id;
        $call->save();

        if(!$call->equipment_id) {
            throw new Exception('Equipamento não informado.');
        }

        $message = "O chamado de n. " . $call->id . " foi aprovado por " . Auth::user()->name;

        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->message = $message;
        $log->save();

        $equipment = Equipment::find($call->equipment_id);
        $equipment->status_id = Equipment::STATUS_EM_USO;
        $equipment->save();

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
