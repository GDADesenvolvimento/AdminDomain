<?php

namespace GdaDesenv\AdminDomain\Entities;

use GdaDesenv\AdminClient\Entities\Client;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'client_id',
        'nome',
        'dominio',
        'data_registro',
        'data_vencimento',
        'orgao_registro',
        'valor',
        'status',
        'descricao',
        'publicado',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
