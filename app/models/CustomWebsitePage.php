<?php
use \LaravelBook\Ardent\Ardent;
class CustomWebsitePage extends  Ardent {
    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    protected $fillable = ['name','domain','tld','company_id']; //
    protected $guarded = ['id'];
    public static $customAttributes  = array(
        'name'=>'Page name'
    );

    public static $relationsData = array(
        'custom_website' => array(self::BELONGS_TO,'CustomWebsite'),
    );
    public static $rules = array(
        'name'                  => 'required|between:4,50',
        'title'                  => 'required|between:4,50',
        //'slug'                  => 'required|between:4,50',
        'content'                  => 'required',
        'custom_website_id'                => 'required',
    );
}