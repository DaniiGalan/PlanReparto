<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Envio extends Model
{
    use HasFactory;

    protected $fillable = [
        'zona',
        'nombre_cliente',
        'pedido',
        'destinatario',
        'etiqueta_pdf',
        'enlistado',
        'bultos',
        'palets',
        'usar_palets',
        'listado_id',
    ];

    public function listado()
    {
        return $this->belongsTo(Listado::class);
    }
}
