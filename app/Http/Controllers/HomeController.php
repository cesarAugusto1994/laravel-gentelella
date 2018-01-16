<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Call;
use App\Equipment;
use App\Log;
use Auth;
use Redirect;

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

        if(!Auth::user()->active) {
              Auth::logout();
              return Redirect::route('login')->withErrors('Desculpe, mas o Usuário está desativado, entre em contato com o Administrador.');
        }

        $request->user()->authorizeRoles(['user', 'admin']);

        $calls = Call::all();
        $equipments = Equipment::orderBy('id', 'DESC')->get();

        $peddingCalls = $calls->filter(function($call) {
            return $call->status == Call::STATUS_AGUARDANDO_AUTORIZACAO && !empty($call->equipment);
        });

        $authorizedCalls = $calls->filter(function($call) {
            return $call->status == Call::STATUS_AUTORIZADO;
        });

        $availableEquiments = $equipments->filter(function($equipment) {
            return $equipment->status_id == Equipment::STATUS_DISPONIVEL;
        });

        $descartedEquiments = $equipments->filter(function($equipment) {
            return $equipment->status_id == Equipment::STATUS_DESCARTE;
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
        ->with('descartedEquiments', $descartedEquiments)
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
