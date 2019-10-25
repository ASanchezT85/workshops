<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function pathAttachment()
    {
        return asset('/images/sponsors/' . $this->file);
    }
}
