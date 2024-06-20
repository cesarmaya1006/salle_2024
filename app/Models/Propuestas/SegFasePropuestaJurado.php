<?php

namespace App\Models\Propuestas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SegFasePropuestaJurado extends Model
{
    use HasFactory,Notifiable;
    protected $table = "seg_fase_propuesta_jurados";
    protected $guarded = [];
}
