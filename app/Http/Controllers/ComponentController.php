<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Snippet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ComponentController extends Controller
{
	/**
	 * @return Response
	 */
	public function index(): Response
	{
		return Inertia::render('Panel/Component/Index', [
			'components' => Component::with('language', 'componentable')->byLanguage()->get()
		]);
	}

	public function store(Request $request): RedirectResponse
	{
		switch ($request->input('type')) {
			case 'snippet':
				$validatedData = $request->validate([
					'name' => 'required|string',
				]);

				// Create the snippet
				$snippet = Snippet::create($validatedData);

				// Create the component and associate it with the snippet
				$snippet->component()->create([
					'type' => 'snippet',
					'language_id' => $request->user()->language_id
				]);
				break;
		}

		return back();
	}
}
