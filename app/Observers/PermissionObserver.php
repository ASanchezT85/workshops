<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Caffeinated\Shinobi\Models\Permission;

class PermissionObserver
{
    /**
     * Handle the Permission "saving" event.
     *
     * @param  \Caffeinated\Shinobi\Models\Permission  $language
     * @return void
     */
    public function saving(Permission $permission)
    {
        $slug = Str::slug($permission->name, '-');

        $permission->slug = strtolower($slug);
    }
}
