<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Deporte;

class DeporteController extends Controller
{
    public function courts(Deporte $deporte)
    {
        return $deporte->users()->get([
            'users.id','users.name'
        ]);
    }
}
