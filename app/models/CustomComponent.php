<?php
use \LaravelBook\Ardent\Ardent;
class CustomComponent extends  Ardent {
    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    //protected $fillable = ['theme_id','name','type','template','data'];
    protected $guarded = ['id'];
    public static $customAttributes  = array(
        'name'=>'Component name'
    );

    public static $rules = array(
        'name'                  => 'required|between:4,50',
    );
//    public static function getAll(){
//        return CustomTheme::all();
//    }
//    public static function getLists(){
//        return CustomTheme::all()->lists('name','id');
//    }
}