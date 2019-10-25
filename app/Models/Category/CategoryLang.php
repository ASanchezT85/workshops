<?php

namespace App\Models\Category;

use App\Models\Category\Category;
use App\Models\Variables\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryLang extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'lang_id', 'name', 'description', 'file', 'state', 'slug',
    ];

    public function pathAttachment()
    {
        return asset('/images/' . $this->file);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    
}
