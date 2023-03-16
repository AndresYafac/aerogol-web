<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::clientes()->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'nullable|min:8'

        ];
        $this->validate($request, $rules);

        User::create(
            $request->only('name','email','phone')
            + [
                'role' => 'clientes',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = 'El cliente se ha registrado correctamente.';
        return redirect('/clients')->with(compact('notification'));
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
    public function edit(User $client)
    {
        return view('clients.edit',compact('client'));
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

        $user = User::clientes()->findOrFail($id);

        $data = $request->only('name','email','phone');
        $password = $request->input('password');
        if ($password)
           $data['password'] = bcrypt('password');

        $user->fill($data);
        $user->save();//UPDATE

        $notification = 'El cliente se ha actualizado correctamente.';
        return redirect('/clients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $clientName = $client->name;
        $client->delete();

        $notification = "El cliente $clientName se ha eliminado correctamente.";
        return redirect('/clients')->with(compact('notification'));
    }
}


