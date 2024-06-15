<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cargo extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'cargos';
    protected $guarded = [];

    //==================================================================================
    //----------------------------------------------------------------------------------
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'cargo_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //==================================================================================
}
