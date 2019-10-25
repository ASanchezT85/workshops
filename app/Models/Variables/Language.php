<?php

namespace App\Models\Variables;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'acronym', 'flag', 'state',
    ];
}
