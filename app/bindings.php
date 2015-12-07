<?php

Route::bind('projectSlug', function($value, $route)
{

    //$tld = $route->getParameter('tld');
    $domain = explode('.',str_replace('www.','',Request::getHost()));
    if(count($domain)>2){
        $project = CustomWebsite::where('domain',  $domain[0])
            ->first();
    }else{
        $project = CustomWebsite::where('domain',  $domain[0])
            ->where('tld',  $domain[1])
            ->first();
    }


    if(!$project)
    {
        return null;
    }

    return $project;
});