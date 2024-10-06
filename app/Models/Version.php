<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Version extends Model
{
	/**
	 * @var string[]
	 */
	protected $fillable = ['data', 'version_number', 'created_by'];

	/**
	 * @return MorphTo
	 */
	public function versionable(): MorphTo
	{
		return $this->morphTo();
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function getDataAttribute($value): mixed
	{
		return json_decode($value, true);
	}
}
