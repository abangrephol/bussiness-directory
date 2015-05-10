<?php

Route::bind('projectSlug', function($value, $route)
{
    $tld = $route->getParameter('tld');
    dd($value);

    $project = Project::where('slug', '=', $value)
        ->where('tld', '=', $tld)
        ->first();


    if(! $project)
    {
        App::abort(404);
    }

    return $project;
});