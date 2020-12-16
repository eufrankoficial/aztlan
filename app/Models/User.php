<?php

namespace App\Models;

use App\Traits\Hashidable;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\HasSlug;

class User extends BaseAuthModel
{
    use HasFactory, Notifiable, Hashidable, Searchable, HasRoles, HasSlug;

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
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'slug'
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

    protected $keyName = 'slug';
    protected $sourceSlug = 'nome';


    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'name' => 'like',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany.
     */
    public function group()
    {
        return $this->belongsToMany(GroupUser::class, 'model_has_roles', 'model_id', 'role_id');
    }

    /**
     * @return mixed.
     */
    public function isSuperAdmin()
    {
        return current_user()->hasRole('SuperAdmin') ? true : false;
    }

    public function getJWTIdentifier()
    {

    }


    public function getJWTCustomClaims(): array
    {
        return [];
    }

}
