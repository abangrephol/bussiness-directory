<?php
use LaravelBook\Ardent\Ardent;
class State extends Ardent {

    public static $relationsData = array(
        'country' => array(self::BELONGS_TO,'Country'),
        'company' => array(self::HAS_MANY,'Company')
    );
    public static function getState($countryId){
        $states = Country::find($countryId,array('name','id'))->state->sortBy('name')->lists('name','id');
        return $states;
    }
}