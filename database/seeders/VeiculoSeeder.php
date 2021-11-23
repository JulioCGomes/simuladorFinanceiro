<?php

namespace Database\Seeders;

use App\Models\Veiculo;
use Illuminate\Database\Seeder;

class VeiculoSeeder extends Seeder
{
    /** @var Integer CHEVROLET */
    const CHEVROLET = 1;

    /** @var Integer FIAT */
    const FIAT = 2;

    /** @var Integer FORD */
    const FORD = 3;

    /** @var Integer HONDA */
    const HONDA = 4;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Array $arrDados */
        $arrDados = $this->dataVeiculos();

        foreach ($arrDados as $data) {
            Veiculo::create($data);
        }
    }

    /**
     * Retorna os dados para serem inseridos.
     *
     * @return Array
     */
    private function dataVeiculos() : Array
    {
        return [
            [
                'id_marca' => self::CHEVROLET,
                'nome' => 'Cruze',
                'valor' => 132290.00,
                'ativo' => 1
            ],
            [
                'id_marca' => self::CHEVROLET,
                'nome' => 'Onix',
                'valor' => 78290.00,
                'ativo' => 1
            ],
            [
                'id_marca' => self::FIAT,
                'nome' => 'Uno',
                'valor' => 20290.00,
                'ativo' => 1
            ],
            [
                'id_marca' => self::FIAT,
                'nome' => 'Bravo',
                'valor' => 45290.00,
                'ativo' => 1
            ],
            [
                'id_marca' => self::FORD,
                'nome' => 'Fiesta',
                'valor' => 50790.00,
                'ativo' => 1
            ],
            [
                'id_marca' => self::FORD,
                'nome' => 'Foxus',
                'valor' => 90890.00,
                'ativo' => 1
            ],
            [
                'id_marca' => self::HONDA,
                'nome' => 'City',
                'valor' => 89547.00,
                'ativo' => 1
            ],
            [
                'id_marca' => self::HONDA,
                'nome' => 'Civic',
                'valor' => 190890.00,
                'ativo' => 1
            ],
        ];
    }
}
