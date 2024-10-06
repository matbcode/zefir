<?php

namespace App\Models;

use App\Traits\HasLanguageScope;
use App\Traits\HasMetadata;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Page extends Model
{
	use HasLanguageScope, HasMetadata;

	protected static function booted(): void
	{
		static::created(function ($page) {
			// Automatically create an empty metadata record when a page is created
			$page->metadata()->create([
				'title' => $page->name,
				'description' => null,
				'keywords' => null,
				'image' => null,
			]);
		});

		// Automatically populate 'path' with a slugified version of 'name' if it's empty
		static::saving(function ($page) {
			if (empty($page->path)) {
				$page->path = '/' . Str::slug($page->name);
			}
		});

		static::deleting(function ($page) {
			// Automatically delete the metadata record when a page is deleted
			$page->metadata()->delete();
		});
	}

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

	/**
	 * @return MorphToMany
	 */
	public function components(): MorphToMany
	{
		return $this->morphToMany(Component::class, 'componentable')
			->withPivot('order')
			->orderBy('pivot_order');
	}
}
