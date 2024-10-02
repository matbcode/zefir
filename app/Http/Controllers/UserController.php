<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
	/**
	 * @return Response
	 */
	public function index(): Response
	{
		return Inertia::render('Panel/User/Index', [
			'users' => User::all()
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
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
		]);

		// Create a new user in the database
		User::create($validatedData);

		return back();
	}

	/**
	 * @param Request $request
	 * @param User $user
	 * @return RedirectResponse
	 */
	public function update(Request $request, User $user): RedirectResponse
	{
		$validatedData = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
		]);

		$user->update($validatedData);

		return back();
	}

	/**
	 * @param User $user
	 * @return RedirectResponse
	 */
	public function destroy(User $user): RedirectResponse
	{
		$user->delete();
		return back();
	}
}
