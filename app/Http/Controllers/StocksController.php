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
            return [\Carbon\Carbon::parse($item->fecha)->valueOf(),$item->valor];
        })->toJson();
    }
}
