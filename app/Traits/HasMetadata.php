<?php

namespace App\Traits;

trait HasMetadata
{
	/**
	 * @param array $data
	 * @return void
	 */
    public function saveMetadata(array $data): void
	{
		$metadata = $this->metadata()->firstOrNew([]);
		$metadata->fill($data)->save();
	}
}
