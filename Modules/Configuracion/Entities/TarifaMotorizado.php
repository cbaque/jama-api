<?php

namespace Modules\Configuracion\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TarifaMotorizado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tarifamt' 
        , 'costo' 
    ];
    protected $table = 'tarifa_motorizado';
    
    protected static function newFactory()
    {
        return \Modules\Configuracion\Database\factories\TarifaMotorizadoFactory::new();
    }
}
