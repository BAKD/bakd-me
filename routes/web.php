<?php

// Catchall for vue single page app requests.
//  
// Ignore requests to /manage or nova-api, as we need those to run specific middleware
// in order for Nova to pick up the session, etc.
Route::get('{segments}', 'SiteController@handleVueRequests')->where('segments', '^((?!manage|nova-api).)*$')->middleware('spa');