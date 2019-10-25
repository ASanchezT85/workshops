<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Caffeinated\Shinobi\Models\Role;

class RoleObserver
{
    /**
     * Handle the Role "saving" event.
     *
     * @param  \Caffeinated\Shinobi\Models\Role  $role
     * @return void
     */
    public function saving(Role $role)
    {
        $slug = Str::slug($role->name, '-');

        $role->slug = strtolower($slug);
    }
}
