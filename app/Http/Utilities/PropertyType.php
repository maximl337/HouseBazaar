<?php

namespace App\Http\Utilities;

class PropertyType
{

	protected static $types = [

		'apartment/condo',
		'room',
		'house',
		'commercial'
	];

	public static function all()
	{
		return static::$types;
	}
}