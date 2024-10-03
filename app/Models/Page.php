<?php

namespace App\Models;

use App\Traits\HasLanguageScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Page extends Model
{
	use HasLanguageScope;

	/**
	 * @var array<int, string>
	 */
	protected $fillable = [
		'public',
		'name',
		'path',
		'language_id',
	];

	/**
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'public' => 'boolean',
		];
	}

	/**
	 * @return BelongsTo
	 */
	public function language(): BelongsTo
	{
		return $this->BelongsTo(Language::class);
	}

	/**
	 * @return MorphOne
	 */
	public function metadata(): MorphOne
	{
		return $this->morphOne(Metadata::class, 'metadatable');
	}
}
