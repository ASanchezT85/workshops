<?php

namespace App\Models\Course;

use App\User;
use App\Models\Sponsor;
use App\Models\Course\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Workshop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'start_date', 'address', 'sale', 'presale', 'duration', 'team', 'certification',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function sponsors(): BelongsToMany
    {
        return $this->belongsToMany(Sponsor::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
