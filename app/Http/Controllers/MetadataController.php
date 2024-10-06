<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MetadataController extends Controller
{
	/**
	 * @return Response
	 */
	public function index(): Response
	{
		return Inertia::render('Panel/Metadata/Index', [
			'pages' => Page::with('language')->byLanguage()->get()
		]);
	}
}
