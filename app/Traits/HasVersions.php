<?php

namespace App\Traits;

use App\Models\Version;

trait HasVersions
{
	/**
	 * @return mixed
	 */
	public function versions(): mixed
	{
		return $this->morphMany(Version::class, 'versionable');
	}

	/**
	 * @param $userId
	 * @return void
	 */
	public function createVersion($userId = null): void
	{
		$this->versions()->create([
			'data' => json_encode($this->getVersionableData()),
			'version_number' => $this->versions()->count() + 1,
			'created_by' => $userId,
		]);
	}

	/**
	 * @return array
	 */
	protected function getVersionableData(): array
	{
		return $this->toArray();
	}

	/**
	 * @param $versionId
	 * @return void
	 */
	public function rollbackToVersion($versionId): void
	{
		$version = $this->versions()->findOrFail($versionId);
		$data = $version->data;

		$this->update($data);
	}
}
