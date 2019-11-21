<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "saving" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function saving(User $user)
    {
        $slug = Str::slug($user->name, '-');

        $user->slug = strtolower($slug);
    }
}
