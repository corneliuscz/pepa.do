<?php

class Question extends \Eloquent {
  protected $table = 'questions';

  protected $guarded = ['id', 'created_at', 'updated_at'];
  protected $fillable = ['asker', 'question'];


  public static $rules = array(
    'question'      => 'required',
  );

  public static $messages = array(
    'question.required'          => 'Nevyplnili jste žádnou <strong>otázku</strong>.',
  );

  public static function validate($data) {
    return Validator::make($data, static::$rules, static::$messages);
  }

  /**
   * Get all questions in reverse order
   *
   * @return ARRAY
   */
  public static function getAllQuestions()
  {
    $questions = Question::orderBy('created_at', 'DESC')->get();
    return $questions;
  }

  /**
   * Get all published questions
   *
   * qstatus: 0 New
   *          1 Publish
   *          2 Answered
   *          3 Spam
   *          4 Pinned
   *
   * @return ARRAY
   */
  public static function getPublicQuestions()
  {
    $questions = Question::where('qstatus', '=', 1)->orderBy('created_at', 'desc')->get();
    return $questions;
  }

  /**
   * Get all pinned questions
   *
   * @return ARRAY
   */
  public static function getPinnedQuestions()
  {
    $questions = Question::where('qstatus', '=', 4)->orderBy('created_at', 'desc')->get();
    return $questions;
  }

}
