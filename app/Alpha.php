<?php

namespace BAKD;

use Illuminate\Database\Eloquent\Model;

class Alpha extends Model
{
    /**
     * Get the current BAKD Alpha version.
     *
     * @return string
     */
    public static function version()
    {
        return '2.0.1';
    }

   	/**
     * Determine if the given request is intended for Nova.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function isNovaRequest($request)
    {
        $path = trim(\Nova::path(), '/') ?: '/';

        return $request->is($path) ||
               $request->is(trim($path.'/*', '/')) ||
               $request->is('nova-api/*');
    }
}
