<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
	/**
	 * @return Response
	 */
	public function index(): Response
	{
		return Inertia::render('Panel/Page/Index', [
			'pages' => Page::with('language')->byLanguage()->get()
		]);
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		$validatedData = $request->validate([
			'public' => ['required', 'boolean'],
			'name' => ['required', 'string'],
			'path' => ['required', 'string']
		]);

		$validatedData['language_id'] = $request->user()->language_id;

		Page::create($validatedData);

		return back();
	}

	/**
	 * @param Page $page
	 * @return Response
	 */
	public function edit(Page $page): Response
	{
		return Inertia::render('Panel/Page/Edit', [
			'page' => $page
		]);
	}

	/**
	 * @param Request $request
	 * @param Page $page
	 * @return RedirectResponse
	 */
	public function update(Request $request, Page $page): RedirectResponse
	{
		$validatedData = $request->validate([
			'public' => ['required', 'boolean'],
			'name' => ['required', 'string'],
			'path' => ['required', 'string']
		]);

		$page->update($validatedData);

		return back();
	}

	/**
	 * @param Page $page
	 * @return RedirectResponse
	 */
	public function destroy(Page $page): RedirectResponse
	{
		$page->delete();

		return back();
	}
}
