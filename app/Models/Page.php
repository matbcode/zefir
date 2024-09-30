<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Page extends Model
{
	/**
	 * @return MorphOne
	 */
	public function metadata(): MorphOne
	{
		return $this->morphOne(Metadata::class, 'metadatable');
	}
}
