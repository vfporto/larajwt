<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['login', 'matricula', 'nome', 'email', 'cartao', 'password',/* 'senha', 'area_id',*/ 'tipo_usuario_id'];
protected $hidden = ['password', 'created_at', 'updated_at', 'deleted_at', /*'area_id', 'tipo_usuario_id'*/];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    function tipoUsuario() {
        return $this->belongsTo('App\TipoUsuario');
    }

    function area() {
        return $this->belongsTo('App\Area');
    }

    public function jornadas() {
        return $this->belongsToMany('App\Jornada', 'jornadas_users', 'user_id', 'jornada_id');
    }

    public function registrosDiarios() {
        return $this->hasMany('App\RegistroDiario');
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
            'user' => [
                'id' => $this->id,
                'login' => $this->login,
                'matricula' => $this->matricula,
                'cartao' => $this->cartao,
                'nome' => $this->nome,
                'email' => $this->email,
                //'senha' => $this->senha,
                'area' => Area::find($this->area_id),
                'tipoUsuario' => TipoUsuario::find($this->tipo_usuario_id),
            ]
        ];
    }

















 /*
    //Classe User Original  --- TODO: excluir
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * /
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     * /
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     * /
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     * /
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     * /
    public function getJWTCustomClaims()
    {
        return [];
    }

    /*public function products()
    {
        return $this->hasMany(Product::class);
    }* /
*/
}
