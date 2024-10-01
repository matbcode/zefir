<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Language extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'public',
		'language',
		'abbreviation',
		'code',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'public' => 'boolean',
		];
	}

	/**
	 * @return BelongsToMany
	 */
	public function domains(): BelongsToMany
	{
		return $this->belongsToMany(Domain::class);
	}
}
