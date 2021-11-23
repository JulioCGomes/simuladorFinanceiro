<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nome',
        'ativo'
    ];

    /**
     * Relacionando marca ao veículos.
     *
     * @return Mixed
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'id_marca', 'id');
    }
}
