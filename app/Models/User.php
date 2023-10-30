<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function definitions()
    {
        return $this->hasMany(Definition::class);
    }
    public function words(){
        return $this->hasMany(word::class);
    }
    public function definitionRatings()
    {
        return $this->hasMany(DefinitionRating::class);
    }

//    public function isAdmin()
//    {
//        return $this->role === 'admin'; // 根据用户的角色字段判断是否为管理员
//    }
//
//    public function isRegisteredUser()
//    {
//        return $this->role === 'registered'; // 根据用户的角色字段判断是否为注册用户
//    }



}
