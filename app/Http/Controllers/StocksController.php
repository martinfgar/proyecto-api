<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
class StocksController extends Controller
{
    //
    public function acciones($id){
        if (!Empresa::find($id)){
            return response(['message' => 'Not found'],404);
        }
        return Empresa::find($id)->stocks->map(function ($item,$key){
            return [\Carbon\Carbon::parse($item->fecha)->valueOf(),floatval($item->valor)];
        })->toJson();
    }
    public function accionesHoy($id = false){
        if (!$id){
            return Empresa::all()->with('stocks')->where('fecha',\Carbon\Carbon::today())->map(function($item,$key){
                return [\Carbon\Carbon::parse($item->fecha)->valueOf(),floatval($item->valor)];
            })->toJson();
        }
        return Empresa::find($id)->stocks->where('fecha',\Carbon\Carbon::today())->map(function($item,$key){
            return [\Carbon\Carbon::parse($item->fecha)->valueOf(),floatval($item->valor)];
        })->toJson();
    }
}
