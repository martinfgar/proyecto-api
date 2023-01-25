<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Stock;
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
            return Empresa::with(['stocks' => function($q){$q->where('fecha','>',\Carbon\Carbon::today());}])->get()->mapWithKeys(function($item,$key){
                return  [$item->id => $item->stocks->map(function($stock,$emptykey){
                    return [\Carbon\Carbon::parse($stock->fecha)->valueOf(),floatval($stock->valor)];
                })];
            })->toJson();
        }
        return Empresa::find($id)->stocks->where('fecha','>',\Carbon\Carbon::today())->map(function($item,$key){
            return [\Carbon\Carbon::parse($item->fecha)->valueOf(),floatval($item->valor)];
        })->values()->toJson();
    }

    public function accionesHistoricas($id = false){
        if (!$id){
            return Stock::all()->groupBy('empresa_id')->map(function($item){
                return $item->groupBy(function($groupDates){
                    return \Carbon\Carbon::parse($groupDates->fecha)->startOfDay()->valueOf();
                })->map(function($lastDate){return $lastDate[count($lastDate)-1]->valor;});
            })->toJson();
        }

        return Empresa::find($id)->stocks->groupBy(function($item){
            return \Carbon\Carbon::parse($item->fecha)->startOfDay()->valueOf();
        })->map(function($item){
            return $item[count($item)-1]->valor;
        })->toJson();
    }
}
