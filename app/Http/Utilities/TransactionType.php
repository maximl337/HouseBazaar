<?php

namespace App\Http\Utilities;

class TransactionType
{

	protected static $types = [

		'rent',
		'sale',
	];

	public static function all()
	{
		return static::$types;
	}
}