<?php
use LaravelBook\Ardent\Ardent;
class CompanyCategory extends Ardent {
	protected $fillable = [];
    protected $relationsData = array(
        'company' => array(self::BELONGS_TO,'Company'),
        'category' => array(self::BELONGS_TO,'Category')
    );
}