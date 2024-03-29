<?php

namespace App\Models;

use App\Traits\Hashidable;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\HasSlug;

class User extends BaseAuthModel
{
    use HasFactory, Notifiable, Hashidable, Searchable, HasRoles, HasSlug, HasPermissions;

    /**
     * @var array
     */
    protected $fillable = [
		'company_id',
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

	public function company()
	{
		return $this->belongsTo(Company::class, 'company_id', 'id');
	}

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

	public function hasPermission($permission)
	{
		if($this->isSuperAdmin())
			return true;

		$list = $this->getPermissionsViaRoles();
		if($list->count() == 0) {
			return false;
		}

		$list  = $list->pluck('slug')->toArray();
		return in_array($permission, $list);
	}

    public function getJWTIdentifier()
    {

    }


    public function getJWTCustomClaims(): array
    {
        return [];
    }

}
