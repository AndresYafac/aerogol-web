<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Deporte;

use App\Http\Controllers\Controller;

class CanchaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courts = User::empleado()->get();
        return view('courts.index', compact('courts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deportes = Deporte::all();
        return view('courts.create', compact('deportes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'nullable|min:8'

        ];
        $this->validate($request, $rules);

        $user = User::create(
            $request->only('name','email','phone')
            + [
                'role' => 'empleado',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $user->deportes()->attach($request->input('deportes'));

        $notification = 'El campo se ha registrado correctamente.';
        return redirect('/courts')->with(compact('notification'));
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
        $court = User::empleado()->findOrFail($id);
        $deportes = Deporte::all();

        $deporte_ids = $court->deportes()->pluck('deportes.id');
        return view('courts.edit', compact('court','deportes' , 'deporte_ids'));
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
         $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'nullable|min:8'

        ];
        $this->validate($request, $rules);

        $user = User::empleado()->findOrFail($id);

        $data = $request->only('name','email','phone');
        $password = $request->input('password');
        if ($password)
           $data['password'] = bcrypt('password');

        $user->fill($data);
        $user->save();//UPDATE

        $user->deportes()->sync($request->input('deportes'));

        $notification = 'El campo se ha actualizado correctamente.';
        return redirect('/courts')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $court)
    {
        $courtName = $court->name;
        $court->delete();

        $notification = "El campo se elimino correctamente.";
        return redirect('/courts')->with(compact('notification'));
    }
}
