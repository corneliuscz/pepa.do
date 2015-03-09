<?php

class QuestionsController extends \BaseController {

  /**
   * Display a listing of the resource.
   * GET /questions
   *
   * @return Response
   */
  public function index()
  {
    if (Auth::check()) {
      $questions = Question::getAllQuestions();
      return View::make('admin.questions.index')->with('questions', $questions);
    } else {
      return Redirect::intended('/');
    }
  }

  /**
   * Show the form for creating a new resource.
   * GET /questions/create
   *
   * @return Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   * POST /questions
   *
   * @return Response
   */
  public function store()
  {
    //
  }

  /**
   * Display the specified resource.
   * GET /questions/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   * GET /questions/{id}/edit
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   * PUT /questions/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    if (Auth::check()) {

      $input = Input::all();
      $question = Question::FindOrFail($id);
      $question->qstatus = $input['qstatus'];
      $saved = $question->save();

      if ($saved) {
        return Redirect::intended('/admin')->with('flash_message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> Stav otázky byl aktualizován</div>');
      } else {
        return Redirect::intended('/admin')->with('flash_message', '<div class="alert alert-danger" role="alert">Něco se rozbilo, zavolej Pepu</div>');
      }
    } else {
      return Redirect::intended('/');
    }
  }

  /**
   * Remove the specified resource from storage.
   * DELETE /questions/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }
}
