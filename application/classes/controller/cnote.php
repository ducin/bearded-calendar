<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Cnote controller class.
 */
class Controller_Cnote extends Controller
{
  /**
   * Performs deleting note specified by id. 
   */
  public function action_delete()
  {
    $request = Request::current();

    $note = ORM::factory('note', $request->param('id'));
    $note->delete();

    $request->redirect('/');
  }

  /**
   * Performs adding new note using data passed from the form.
   */
  public function action_new()
  {
    $request = Request::current();

    $note = ORM::factory('note');
    $note->user_id = $request->param('user_id');
    $note->note_date = $request->param('note_date');
    $note->description = $request->param('description');
    try {
      $note->save();
    } catch (ORM_Validation_Exception $e) {
      echo 'Nie udało się zapisać notatki.';
    }

    $tmp = explode('-', $request->param('note_date'));
    $manager_label = new manager_label();

    $test_view = View::factory('note/added', array(
      'year' => $tmp[0],
      'month' => $tmp[1],
      'month_name' => $manager_label->getMonth($tmp[1]),
    ));
    echo $test_view->render();
  }
}
