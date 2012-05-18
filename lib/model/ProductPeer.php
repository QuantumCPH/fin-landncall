<?php

class ProductPeer extends BaseProductPeer
{
	public static $autorefill_choices = array(100, 200, 300);
	public static function getRefillChoices(){
		return array(100, 200, 300);
	}
	public static function getRefillHashChoices(){
		return array('10' => 10, '20' => 20, '30' => 30, '50'=> 50);
	}
	
	public static function getAutoRefillLowerLimitHashChoices()
	{
		$limits = array(25, 50);
		 
		return array_combine($limits, $limits);
	}
}
