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
        return Empresa::find($id)->stocks->toJson();
    }
}
