<?php

// Route Whitelist
// Catchall ignores requests to any of the endpoints noted below.
$except = [
	'manage',
	'nova-api',
	'backup-statuses',
	'backups',
	'_debugbar'
];

// Catchall for any Vue related requests.
Route::get('{segments}', 'SiteController@handleVueRequests')
	->where('segments', '^((?!' . implode('|', $except) . ').)*$')
	->middleware('spa');