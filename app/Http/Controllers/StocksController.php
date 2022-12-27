<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
class StocksController extends Controller
{
    //
    public function acciones($nombre){
        return Empresa::where('nombre',$nombre)->first()->stocks->toJson();
    }
}
