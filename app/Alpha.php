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
}
