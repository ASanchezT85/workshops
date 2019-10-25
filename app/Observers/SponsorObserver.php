<?php

namespace App\Observers;

use App\Models\Sponsor;
use Illuminate\Support\Str;

class SponsorObserver
{
    /**
     * Handle the Sponsor "saving" event.
     *
     * @param  \App\Models\Sponsor  $Sponsor
     * @return void
     */
    public function saving(Sponsor $sponsor)
    {
        $slug = Str::slug($sponsor->name, '-');

        $sponsor->slug = strtolower($slug);
    }
}
