<?php

namespace App\Models\Category;

use App\Models\Course\Course;
use App\Models\Category\CategoryLang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'file', 'state', 'slug',
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
        return asset('/images/categories/' . $this->file);
    }

    public function category_langs(): HasMany
    {
        return $this->hasMany(CategoryLang::class);
    }

    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
