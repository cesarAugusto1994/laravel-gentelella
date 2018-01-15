<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Call;
use App\Equipment;
use App\Log;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $calls = Call::all();
        $equipments = Equipment::all();

        $peddingCalls = $calls->filter(function($call) {
            return $call->status == Call::STATUS_AGUARDANDO_AUTORIZACAO && !empty($call->equipment);
        });

        $authorizedCalls = $calls->filter(function($call) {
            return $call->status == Call::STATUS_AUTORIZADO;
        });

        $availableEquiments = $equipments->filter(function($equipment) {
            return $equipment->status_id == Equipment::STATUS_DISPONIVEL;
        });

        $inUseEquiments = $equipments->filter(function($equipment) {
            return $equipment->status_id == Equipment::STATUS_EM_USO;
        });

        $screeningEquipments = $equipments->filter(function($equipment) {
            return $equipment->status_id == Equipment::STATUS_TRIAGEM;
        });

        $logs = Log::orderBy('id', 'DESC')->limit(6)->get();

        return view('home')
        ->with('peddingCalls', $peddingCalls)
        ->with('authorizedCalls', $authorizedCalls)
        ->with('equipments', $equipments)
        ->with('logs', $logs)
        ->with('availableEquiments', $availableEquiments)
        ->with('inUseEquiments', $inUseEquiments)
        ->with('screeningEquipments', $screeningEquipments);
    }

    /*
    public function someAdminStuff(Request $request)
    {
        $request->user()->authorizeRoles('manager');
        return view(‘some.view’);
    }
    */
}
