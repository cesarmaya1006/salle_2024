<?php

namespace App\Models\Propuestas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubComponente extends Model
{
    use HasFactory,Notifiable;
    protected $table = "sub_componentes";
    protected $guarded = ['id'];
    //----------------------------------------------------------------------------------
    public function componente()
    {
        return $this->belongsTo(Componente::class, 'componente_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
