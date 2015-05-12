<?php

Route::bind('projectSlug', function($value, $route)
{
    $tld = $route->getParameter('tld');

    $project = CustomWebsite::where('domain',  $value)
        ->where('tld',  $tld)
        ->first();


    if(!$project)
    {
        return null;
    }

    return $project;
});