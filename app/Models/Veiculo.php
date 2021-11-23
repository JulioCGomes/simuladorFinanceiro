<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_marca',
        'nome',
        'valor',
        'ativo',
    ];

    /**
     * Relacionado o veículo a marca.
     *
     * @return Mixed
     */
    public function marcas()
    {
        return $this->hasOne(Marca::class, 'id', 'id_marca');
    }
}
