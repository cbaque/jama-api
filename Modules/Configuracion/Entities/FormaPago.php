<?php

namespace Modules\Configuracion\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormaPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_fpago' 
        , 'dt_fpago' 
    ];
    protected $table = 'forma_pago';
    
    protected static function newFactory()
    {
        return \Modules\Configuracion\Database\factories\FormaPagoFactory::new();
    }
}
