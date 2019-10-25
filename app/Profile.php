<?php

namespace App;

use App\User;
use App\Models\Variables\TypeDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type_document_id', 'document', 'phone'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function document_type(): BelongsTo
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }
}
