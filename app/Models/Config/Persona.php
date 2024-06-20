<?php

namespace App\Models\Config;

use App\Models\Propuestas\PrimFaseNota;
use App\Models\Propuestas\Propuesta;
use App\Models\Propuestas\SegFaseNota;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Persona extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'personas';
    protected $guarded = [];
    //==================================================================================
    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->hasOne(User::class, 'id');
    }
    //----------------------------------------------------------------------------------
    public function tipos_docu()
    {
        return $this->belongsTo(TipoDocumento::class, 'docutipos_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //relationships One to One
    public function propuesta()
    {

        return $this->belongsTo(Propuesta::class, 'id','personas_id');
    }
    //----------------------------------------------------------------------------------
    public function notas_uno()
    {
        return $this->hasMany(PrimFaseNota::class, 'personas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function notas_dos()
    {
        return $this->hasMany(SegFaseNota::class, 'personas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function propuestas_j()
    {
        return $this->belongsToMany(Propuesta::class, 'propuesta_jurados','persona_id','propuesta_id');
    }
    //----------------------------------------------------------------------------------
    public function propuestas_j_dos()
    {
        return $this->belongsToMany(Propuesta::class, 'seg_fase_propuesta_jurados','persona_id','propuesta_id');
    }
    //----------------------------------------------------------------------------------
    //==================================================================================
}
