<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
class EmpresaController extends Controller
{
    //
    public function empresas(){
        return Empresa::all()->toJson();
    }

}
