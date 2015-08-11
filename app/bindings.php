<?php

Route::bind('projectSlug', function($value, $route)
{
    $tld = $route->getParameter('tld');
    $domain = explode('.',Request::getHost());
    $project = CustomWebsite::where('domain',  $domain[0])
        ->where('tld',  $domain[1])
        ->first();


    if(!$project)
    {
        return null;
    }

    return $project;
});