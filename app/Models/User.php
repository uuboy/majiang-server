<?php

namespace App\Models;

use Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    protected $fillable = ['nick_name','avatar','weapp_openid','weapp_session_key'];

    protected $hidden = ['weapp_openid','weapp_session_key'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
