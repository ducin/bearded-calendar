<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * Cdaily controller class.
 */
class Controller_Cdaily extends Controller_Cmain
{
  /**
   * Executes index action. 
   */
  public function action_index()
  {
    $session = Session::instance();
  
    $date = $session->get('date_year').'-'.$session->get('date_month').'-'.$session->get('date_day');
    $data = array(
      'date' => $date,
    );

    $user = Auth::instance()->get_user();
    if ($user !== null)
    {
      $user_id = manager_model::getUserByUsername($user)->id;
      $data['user_id'] = $user_id;
      $this->template->scripts = array('web/js/ajax_note.js', 'web/js/toggle_note_form.js');
      $notes = manager_model::getUserNotesByUserIdAndDateArray($user_id, $date);
      if (!empty($notes))
        $data['notes'] = $notes;
    }

    $view = View::factory('calendar/daily', $data);
    $this->template->body = $view->render();
  }
}