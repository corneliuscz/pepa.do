<?php

class DiscussionsController extends \BaseController {

  /**
   * Display a listing of the resource.
   * GET /diskuze
   *
   * @return Response
   */
  public function index()
  {
    //if (Auth::check()) {
      $questions = Question::getPublicQuestions();
      $pinnedQuestions = Question::getPinnedQuestions();
      return View::make('index')
        ->with('questions', $questions)
        ->with('pinnedQuestions', $pinnedQuestions);
    //} else {
    //  return Redirect::intended('/diskuze');
    //}
  }

  /**
   * Show the form for creating a new resource.
   * GET /diskuze/create
   *
   * @return Response
   */
  public function create()
  {
    return View::make('home');
  }

  /**
   * Store a newly created resource in storage.
   * POST /diskuze
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::all();

    $validation = Question::validate($input);

    if ($validation->fails()) {
      return Redirect::intended('/diskuze')->withErrors($validation)->withInput();
    } else {
      $question = new Question;

      if (empty($input['asker'])) {
        $input['asker'] = NULL;
      }

      $question->asker    = strip_tags($input['asker']);
      $question->question = strip_tags($input['question']);
      $question->qstatus  = 0;

      $saved = $question->save();

      if ($saved) {
        return Redirect::intended('/diskuze')
              ->with('flash_message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Zavřít</span></button> Váš dotaz byl úspěšně uložen.</div>');
      } else {
        return Redirect::intended('/diskuze')
              ->with('flash_message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Zavřít</span></button> Uložení dotazu se nezdařilo, zkuste to prosím později.</div>');
      }
    }
  }

  /**
   * Display the specified resource.
   * GET /diskuze/{id}
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
   * GET /diskuze/{id}/edit
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
   * PUT /diskuze/{id}
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
        return Redirect::intended('/dotazy')->with('flash_message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> Stav otázky byl aktualizován</div>');
      } else {
        return Redirect::intended('/dotazy')->with('flash_message', '<div class="alert alert-danger" role="alert">Něco se rozbilo, zavolej Pepu</div>');
      }
    } else {
      return Redirect::intended('/');
    }
  }

  /**
   * Remove the specified resource from storage.
   * DELETE /diskuze/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }

}
