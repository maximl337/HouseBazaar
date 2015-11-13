<?php

namespace App\Http\Utilities;

class Bedroom
{

	protected static $types = [
		'0' => 'Bachelor/Studio',
		'1' => '1',
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6 or more'
	];

	public static function all()
	{
		return static::$types;
	}
}