<?php

namespace App;

use App\Profile;
use App\Models\Poll\Review;
use App\Models\Course\Workshop;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRolesAndPermissions;

    const ROOT = 1;
    const ADMIN = 2;
    const CUSTOMER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'file', 'type',
    ];

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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function pathAttachment()
    {
        return asset('/images/users/' . $this->file);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function workshops(): BelongsToMany
    {
        return $this->belongsToMany(Workshop::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
