<?php

namespace App\Models;

use App\Traits\HasLanguageScope;
use App\Traits\HasVersions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Snippet extends Model
{
    use HasLanguageScope, HasVersions;

	/**
	 * @var string[]
	 */
	protected $fillable = ['name', 'code', 'language_id'];

	/**
	 * @return MorphOne
	 */
	public function component(): MorphOne
	{
		return $this->morphOne(Component::class, 'componentable');
	}
}
