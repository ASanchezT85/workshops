<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Category\Category;

class CategoryObserver
{
    /**
     * Handle the Category "saving" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function saving(Category $category)
    {
        $slug = Str::slug($category->name, '-');

        $category->slug = strtolower($slug);
    }
}
