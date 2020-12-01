<?php

namespace App\Models;

use App\Traits\Hashidable;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends BaseAuthModel
{
    use HasFactory, Notifiable, Hashidable, Searchable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'email_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'name' => 'like',
    ];

    public function getJWTIdentifier()
    {

    }


    public function getJWTCustomClaims(): array
    {
        return [];
    }

}
