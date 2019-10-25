<?php

namespace App\Models\Variables;

use App\Models\Variables\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeDocument extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lang_id', 'name', 'acronym', 'state', 'slug'
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
