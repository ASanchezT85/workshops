<?php

namespace App\Models\Poll;

use App\Models\Poll\QuestionnaireLang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questionnaire extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state',
    ];

    public function questionnaire_langs(): HasMany
    {
        return $this->hasMany(QuestionnaireLang::class);
    }
}
