<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Array $arrDados */
        $arrDados = $this->dataUsers();

        foreach ($arrDados as $data) {
            User::create($data);
        }
    }

    /**
     * Retorna os dados para serem inseridos.
     *
     * @return Array
     */
    private function dataUsers() : Array
    {
        return [
            [
                'name' => 'Ower',
                'email' => 'ower@email.com',
                'password' => Hash::make('ower123')
            ],
            [
                'name' => 'User',
                'email' => 'user@email.com',
                'password' => Hash::make('user123')
            ]
        ];
    }
}
