<?php

class Country extends \LaravelBook\Ardent\Ardent {
	protected $fillable = [];
    public static $relationsData = array(
        'state' => array(self::HAS_MANY,'State')
    );
}