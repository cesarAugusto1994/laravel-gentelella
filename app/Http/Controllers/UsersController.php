<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Validator;
use App\Role;

class UsersController extends Controller
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
        return view('admin.users.index')->with('users', User::all());        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');        
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

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $roleUser = Role::where("name", $data['roles'])->first();
        
        $manager = new User();
        $manager->name = $data['name'];
        $manager->email = $data['email'];
        $manager->password = bcrypt($data['password']);
        $manager->save();
        $manager->roles()->attach($roleUser);

        return redirect()
        ->route('users')
        ->with('message', 'Novo Equipamento adicionado com sucesso.');        
        
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
        return view('admin.users.edit')
        ->with('roles', Role::all())
        ->with('user', User::find($id));      
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
        $user = User::find($id);
        
        $data = $request->request->all();

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //$user->roles()->delete();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        $user->roles()->attach(Role::find($data['roles']));

        return redirect()->route('users');
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);

        $password = $request->request->get('password');;

        $validator = \Illuminate\Support\Facades\Validator::make(['password' => $password], [
            'password' => 'required|min:4|max:20'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->password = $password;

        $user->save();

        return back()->withInput();
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
