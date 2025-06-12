<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listado extends Model
{
    use HasFactory;

    protected $fillable = [
        'zona',
        'fecha',
        'pdf_path'
    ];

    protected $dates = ['fecha'];

    public function envios()
    {
        return $this->hasMany(Envio::class);
    }
}
