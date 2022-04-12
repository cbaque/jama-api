<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci_empleado' 
        , 'ruc_empresa' 
        , 'usuario' 
        , 'pass' 
        , 'id_perfil' 
        , 'estadocta' 

    ];
    protected $table = 'seguridad';

    public function empleado()
    {
        return $this->hasOne( 'Modules\Auth\Entities\Empleado' , 'ci_empleado' , 'ci_empleado' );
    }     
}
