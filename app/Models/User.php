<?php

namespace App\Models;

use App\Models\Config\Persona;
use App\Models\Propuestas\Propuesta;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //==================================================================================
    //----------------------------------------------------------------------------------
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    //relationships One to One
    public function propuesta()
    {

        return $this->belongsTo(Propuesta::class, 'id','personas_id');
    }
    //----------------------------------------------------------------------------------
    //==================================================================================
    //==================================================================================
    public function setSession()
    {
        $roles = $this->getRoleNames();
        $roles = substr($roles, 0, -1);
        $roles = substr($roles, 1);
        $roles = str_replace('"','', $roles);
        //$roles = explode(',',$roles);
        $roles = $this->roles;
        if ($this->empleado) {
            $nombres_completos = $this->empleado->nombres . ' ' . $this->empleado->apellidos;
        }else{
            $nombres_completos = $this->name;
        }
        Session::put([
            'id_usuario' => $this->id,
            'nombres_completos' => $nombres_completos,
            'rol_principal' => $roles[0]['name'],
            'rol_principal_id' => $roles[0]['id'],
            'roles' => $roles,
        ]);
    }
    //==========================================================================================
}
