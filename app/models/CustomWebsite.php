<?php
use \LaravelBook\Ardent\Ardent;
class CustomWebsite extends  Ardent {
    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called
    public static $tld = array(
        'com' => '.COM',
        'com.sg' => '.COM.SG',
        'net' => '.NET',
        'sg' => '.SG',
    );
    protected $fillable = ['name','domain','tld','company_id']; //
    protected $guarded = ['id'];
    public static $customAttributes  = array(
        'name'=>'Company name'
    );

    public static $relationsData = array(
        'state' => array(self::BELONGS_TO,'States'),
        'company' => array(self::BELONGS_TO,'Company')
    );
    public static $rules = array(
        'name'                  => 'required|between:4,50',
        'domain'                => 'between:4,50',
        'tld'                   => 'between:2,5',
        'company_id'            => 'required'
    );
}