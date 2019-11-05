<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Course\Workshop;

class WorkshopObserver
{
    /**
     * Handle the Workshop "saving" event.
     *
     * @param  \App\Models\Course\Workshop  $workshop
     * @return void
     */
    public function saving(Workshop $workshop)
    {
        $generador = $workshop->start_date . ' ' . $workshop->course->name . ' ' . Str::random(5);

        $slug = Str::slug($generador, '-');

        $workshop->slug = strtolower($slug);
    }
}
