<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function set_lenguage($lang)
    {
        
        if(array_key_exists( $lang, config('languages')) ) {
            session()->put('applocale', $lang);
        }
        return back();
    }
}
