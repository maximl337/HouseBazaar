<?php

namespace App\Http\Utilities;

class SellerType
{

	protected static $types = [

		'professional' => 'Professional / Real estate agent',
		'owner' => 'Owner'
	];

	public static function all()
	{
		return static::$types;
	}
}