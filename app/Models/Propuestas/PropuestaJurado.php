<?php

namespace App\Models\Propuestas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PropuestaJurado extends Model
{
    use HasFactory,Notifiable;
    protected $table = "propuesta_jurados";
    protected $guarded = [];
}
