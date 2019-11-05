<?php

namespace App\Models;

use App\Models\Course\Workshop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'file', 'state', 'slug',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function pathAttachment()
    {
        return asset('/images/sponsors/' . $this->file);
    }

    public function workshops(): BelongsToMany
    {
        return $this->belongsToMany(Workshop::class);
    }
}
