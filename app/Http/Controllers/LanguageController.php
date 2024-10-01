<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class LanguageController extends Controller
{
	/**
	 * @return Response
	 */
	public function index(): Response
	{
		return Inertia::render('Panel/Language/Index');
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		// Validate the request data
		$validatedData = $request->validate([
			'public' => ['required', 'boolean'],
			'language' => ['required', 'string'],
			'abbreviation' => ['required', 'string'],
			'code' => ['required', 'string'],
		]);

		// Create a new language in the database
		Language::create($validatedData);

		return back();
	}

	/**
	 * @param Request $request
	 * @param Language $language
	 * @return RedirectResponse
	 */
	public function update(Request $request, Language $language): RedirectResponse
	{
		$validatedData = $request->validate([
			'public' => ['required', 'boolean'],
			'language' => ['required', 'string'],
			'abbreviation' => ['required', 'string'],
			'code' => ['required', 'string'],
		]);

		$language->update($validatedData);

		return back();
	}

	/**
	 * @param Language $language
	 * @return RedirectResponse
	 */
	public function destroy(Language $language): RedirectResponse
	{
		$language->delete();

		return back();
	}
}
