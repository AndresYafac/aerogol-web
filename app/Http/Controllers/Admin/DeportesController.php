<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Deporte;

use App\Http\Controllers\Controller;

class DeportesController extends Controller
{
    
    public function index()
    {
        $deportes = Deporte::all();
        return view('deportes.index', compact('deportes'));
    }

     public function create()
    {
        return view('deportes.create');
    }

    private function performValidation(Request $request)
    {
        $rules = [
            'name' => 'required|min:5'       
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre.',
            'name.min' => 'Como mínimo el nombre debe tener 5 caracteres.'
        ];
        $this->validate($request, $rules, $messages);
    }

     public function store(Request $request)
    {
        //dd($request->all());
        $this->performValidation($request);

        $deporte = new Deportes();
        $deporte->name = $request->input('name');
        $deporte->description = $request->input('description');
        $deporte->save(); //INSERT

        $notification = 'Deporte registrado correctamente.';
        return redirect('/deportes')->with(compact('notification'));
    }

    public function edit(Deportes $deporte)
    {
        return view('deportes.edit', compact('deporte'));
    }

     public function update(Request $request, Deportes $deporte)
    {
        //dd($request->all());
        $this->performValidation($request);

        $deporte->name = $request->input('name');
        $deporte->description = $request->input('description');
        $deporte->save(); //UPDATE

        $notification = 'Deporte actualizado correctamente.';
        return redirect('/deportes')->with(compact('notification'));
    }

    public function destroy(Deportes $deporte)
    {
        $deletedDeporte = $deporte->name;
        $deporte->delete();

        $notification = 'Deporte '. $deletedDeporte .' eliminado correctamente.';
        return redirect('/deportes')->with(compact('notification'));
    }
}
