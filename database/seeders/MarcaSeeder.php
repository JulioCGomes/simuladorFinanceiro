<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Array $arrDados */
        $arrDados = $this->dataMarcas();

        foreach ($arrDados as $data) {
            Marca::create($data);
        }
    }

    /**
     * Retorna os dados para serem inseridos.
     *
     * @return Array
     */
    private function dataMarcas() : Array
    {
        return [
            [
                'nome' => 'Chevrolet',
                'ativo' => 1
            ],
            [
                'nome' => 'Fiat',
                'ativo' => 1
            ],
            [
                'nome' => 'Ford',
                'ativo' => 1
            ],
            [
                'nome' => 'Honda',
                'ativo' => 1
            ],
        ];
    }
}
