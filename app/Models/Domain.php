<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Domain extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'domain',
		'language_id',
	];

	/**
	 * @return BelongsTo
	 */
	public function language(): BelongsTo
	{
		return $this->BelongsTo(Language::class);
	}
}