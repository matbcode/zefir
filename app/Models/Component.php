<?php

namespace App\Models;

use App\Traits\HasLanguageScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Component extends Model
{
	use HasLanguageScope;

	/**
	 * @var string[]
	 */
	protected $fillable = ['type', 'language_id'];

	/**
	 * @return BelongsTo
	 */
	public function language(): BelongsTo
	{
		return $this->BelongsTo(Language::class);
	}

	/**
	 * Polymorphic relationship to the actual component (e.g., Snippet, Image)
	 *
	 * @return MorphTo
	 */
	public function componentable(): MorphTo
	{
		return $this->morphTo();
	}

	/**
	 * Relationship to the parent models (e.g., Page, Article)
	 *
	 * @return MorphToMany
	 */
	public function componentables(): MorphToMany
	{
		return $this->morphToMany(Page::class, 'componentable')
			->withPivot('order')
			->orderBy('pivot_order');
	}
}
