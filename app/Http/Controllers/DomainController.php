<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DomainController extends Controller
{
	/**
	 * @return Response
	 */
	public function index(): Response
	{
		return Inertia::render('Panel/Domain/Index', [
			'domains' => Domain::with('language')->get()
		]);
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		// Validate the request data
		$validatedData = $request->validate([
			'name' => ['required', 'string'],
			'language_id' => ['required', 'exists:languages,id'],
		]);

		// Create a new domain in the database
		Domain::create($validatedData);

		return back();
	}

	/**
	 * @param Request $request
	 * @param Domain $domain
	 * @return RedirectResponse
	 */
	public function update(Request $request, Domain $domain): RedirectResponse
	{
		$validatedData = $request->validate([
			'name' => ['required', 'string'],
			'language_id' => ['required', 'exists:languages,id'],
		]);

		$domain->update($validatedData);

		return back();
	}

	/**
	 * @param Domain $domain
	 * @return RedirectResponse
	 */
	public function destroy(Domain $domain): RedirectResponse
	{
		$domain->delete();

		return back();
	}
}
