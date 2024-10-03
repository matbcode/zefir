<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasLanguageScope
{
	/**
	 * Scope a query to filter by the user's language.
	 *
	 * @param Builder $query
	 * @param int|null $languageId
	 * @return Builder
	 */
	public function scopeByLanguage(Builder $query, int $languageId = null): Builder
	{
		// If no languageId is passed, default to the authenticated user's language
		$languageId = $languageId ?? auth()->user()->language_id;

		// Apply the language filter
		return $query->where('language_id', $languageId);
	}
}