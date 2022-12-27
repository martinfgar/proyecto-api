<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Empresa;
use App\Models\Stock;

class CreateStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea una entrada de valor de stock para todas las empresas';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $empresas = Empresa::all();
        foreach($empresas as $empresa){
            $stock = new Stock;
            $stock->empresa_id = $empresa->id;
            ($empresa->stock) ? 
                $stock->valor = $empresa->stock->valor*(mt_rand(5,15)/10)
                :
                $stock->valor = (mt_rand(40,200)/10);
            $stock->save();
        }
        return Command::SUCCESS;
    }
}
