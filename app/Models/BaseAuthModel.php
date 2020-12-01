<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

/**
 * Class BaseAuth.
 * @package App\Models.
 */
abstract class BaseAuthModel extends Authenticatable
{
    use Notifiable;

    /**
     * @var string.
     */
    protected $guard_name = 'web';

    /**
     * @var string.
     */
    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool|string.
     */
    public function getRouteKeyName()
    {
        if(!$this->keyName)
            return parent::getRouteKeyName(); // TODO: Change the autogenerated stub

        return $this->keyName;
    }

    /**
     * @param Builder $builder
     * @param $slug
     * @return Builder.
     */
    public function scopeSlug(Builder $builder, $slug)
    {
        return $builder->where('slug', $slug);
    }

    /**
     * @param Builder $builder
     * @return Builder
     * @throws \Exception
     */
    public function scopeFilter(Builder $builder, Request $request)
    {
        if($request->query->count() > 0) {
            $builder = $this->search($builder, $request);
        }
    }

    /**
     * @param $value.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}