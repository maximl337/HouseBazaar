<?php

namespace App\Http\Utilities;

class Bathroom
{

	protected static $types = [

		'1'			=>	'1',
		'1.5'		=>	'1.5',
		'2'			=>	'2',
		'2.5'		=>	'2.5',
		'3'			=>	'3',
		'3.5'		=>	'3.5',
		'4'			=>	'4',
		'4.5'		=>	'4.5',
		'5'			=>	'5',
		'5.5'		=>	'5.5',
		'6'			=>	'6 or more'
	];

	public static function all()
	{
		return static::$types;
	}
}