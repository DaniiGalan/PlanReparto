<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Envio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_cliente',
        'direccion',
        'zona',
        'etiqueta_pdf',
        'listado_id',
        'enlistado',
        'bultos',
        'palets'
    ];

    public function listado()
    {
        return $this->belongsTo(Listado::class);
    }
}
