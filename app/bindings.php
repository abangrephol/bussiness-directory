<?php

Route::bind('projectSlug', function($value, $route)
{
    $tld = $route->getParameter('tld');
    $value = str_replace('www.','',$value);
    $project = CustomWebsite::where('domain',  $value)
        ->where('tld',  $tld)
        ->first();


    if(!$project)
    {
        return null;
    }

    return $project;
});