<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Metadata extends Model
{
	/**
	 * @var array<int, string>
	 */
	protected $fillable = [
		'title',
		'description',
		'keywords',
		'image',
		'priority',
	];

	/**
	 * @return MorphTo
	 */
	public function metadatable(): MorphTo
	{
		return $this->morphTo();
	}
}
