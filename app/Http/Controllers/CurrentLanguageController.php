<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CurrentLanguageController extends Controller
{
	/**
	 * @param Request $request
	 * @param $id
	 * @return RedirectResponse
	 */
	public function update(Request $request, $id): RedirectResponse
	{
		$request->user()->language_id = $id;
		$request->user()->save();

		return back();
	}
}
