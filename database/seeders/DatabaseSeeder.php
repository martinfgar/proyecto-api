<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('empresas')->insert([
            ['nombre' => 'Iberdrola'],
            ['nombre' => 'Inditex'],
            ['nombre' => 'Santander'],
            ['nombre' => 'BBVA'],
            ['nombre' => 'Naturgy'],
            ['nombre' => 'Cellnex'],
            ['nombre' => 'Caixabank'],
            ['nombre' => 'Telefonica'],
            ['nombre' => 'Repsol'],
            ['nombre' => 'Ferrovial']
        ]);
        $fecha = Carbon::today('Europe/Madrid');
        $fecha->subYears(1);
        $empresas = Empresa::all();
        $six_months = \Carbon\Carbon::now();
        $six_months->subMonths(6);
        $function_period = \Carbon\Carbon::now()->valueOf() - $six_months->valueOf(); 
        $wave_amplitude = 20;
        while(Carbon::now('Europe/Madrid')->gt($fecha)){
            foreach($empresas as $empresa){
                $stock = new Stock;
                $stock->empresa_id = $empresa->id;
                $stock->fecha = $fecha->toDateTimeString();
                $value = mt_rand(0,10)/10+(sin($fecha->valueOf()/$function_period*pi()+ mt_rand(-2,2)/10)**2)*$wave_amplitude;
                $stock->valor = $value;
                $stock->save();
            }
            $fecha->addDay();
        }
    }
}
