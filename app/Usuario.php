<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable implements JWTSubject //extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['login', 'matricula', 'nome', 'email', 'senha',/* 'area_id',*/ 'tipo_usuario_id'];
    protected $hidden = ['senha', 'created_at', 'updated_at', 'deleted_at', 'area_id', 'tipo_usuario_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    function tipoUsuario()
    {
        return $this->belongsTo('App\TipoUsuario');
    }

    function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function jornadas()
    {
        return $this->belongsToMany('App\Jornada', 'jornadas_usuarios', 'usuario_id', 'jornada_id');

    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'usuario' => [
                'id' => $this->id,
                'login' => $this->login,
                'matricula' => $this->matricula,
                'nome' => $this->nome,
                'email' => $this->email,
                //'senha' => $this->senha,
                'area' => Area::find($this->area_id),
                'tipoUsuario' => TipoUsuario::find($this->tipo_usuario_id),
            ]
        ];
    }
}
