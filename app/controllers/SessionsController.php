<?php

class SessionsController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 * GET /sessions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.login');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sessions
	 *
	 * @return Response
	 */
	public function store()
	{
	
		$input = Input::all();

		$attempt = Auth::attempt([
			'username' => $input['username'],
			'password' => $input['password']
		]);

		if ($attempt) return Redirect::intended('/admin')
													->with('flash_message', 'Přihlášení proběhlo úspěšně');

		return Redirect::back()
						->with('flash_message', 'Přihlášení se nezdařilo')->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();

		return Redirect::home()
						->with('flash_message', 'Byli jste úspěšně odhlášeni');;
	}

}
