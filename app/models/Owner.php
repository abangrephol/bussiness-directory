<?php
use LaravelBook\Ardent\Ardent;
class Owner extends Ardent {

    public static $relationsData = array(
        'user' => array(self::BELONGS_TO,'User','owner_id'),
        'company' => array(self::BELONGS_TO,'Company')
    );
    public static function getState($countryId){
        $states = Country::find($countryId,array('name','id'))->state->sortBy('name')->lists('name','id');
        return $states;
    }
}