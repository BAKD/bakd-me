<?php

namespace BAKD\Http\Controllers;

use Illuminate\Http\Request;
use BAKD\Http\Controllers\Controller;

class SiteController extends Controller
{
    /**
     * Handle all incoming requests meant for Vue.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function handleVueRequests(Request $request)
    {
        return view('index');
    }
}
