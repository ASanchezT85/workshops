<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Variables\Language;

class LanguageObserver
{
    /**
     * Handle the language "saving" event.
     *
     * @param  \App\Models\Variables\Language  $language
     * @return void
     */
    public function saving(Language $language)
    {
        $slug = Str::slug($language->name, '-');

        $language->slug = strtolower($slug);
    }
}
