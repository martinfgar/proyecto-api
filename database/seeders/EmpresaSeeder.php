<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            ['nombre' => 'Telefónica'],
            ['nombre' => 'Repsol'],
            ['nombre' => 'Ferrovial']
        ]);
    }
}
