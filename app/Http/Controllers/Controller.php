<?php

namespace BAKD\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Determine if the given request is intended for Nova.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isNovaRequest($request)
    {
        $path = trim(\Nova::path(), '/') ?: '/';

        return $request->is($path) ||
               $request->is(trim($path.'/*', '/')) ||
               $request->is('nova-api/*');
    }
}
