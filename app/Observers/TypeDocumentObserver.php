<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Variables\TypeDocument;

class TypeDocumentObserver
{
    /**
     * Handle the TypeDocument "saving" event.
     *
     * @param  \App\Models\Variables\TypeDocument  $type_document
     * @return void
     */
    public function saving(TypeDocument $type_document)
    {
        $slug = Str::slug($type_document->name, '-');

        $type_document->slug = strtolower($slug);
    }
}
