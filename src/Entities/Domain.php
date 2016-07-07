<?php

namespace GdaDesenv\AdminDomain;

use GdaDesenv\AdminClient\Entities\Client;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'client_id',
        'dominio',
        'data_registro',
        'data_vencimento',
        'orgao_registro',
        'valor',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
