<?php

namespace App\Models\Course;

use App\Models\Course\Barnner;
use App\Models\Course\Workshop;
use App\Models\Category\Category;
use App\Models\Variables\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lang_id', 'category_id', 'name', 'description', 'headed_to', 'deception', 'state', 'file', 'slug',
    ];

    public function lang(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function barnners(): HasMany
    {
        return $this->hasMany(Barnner::class);
    }

    public function workshops(): HasMany
    {
        return $this->hasMany(Workshop::class);
    }
}
