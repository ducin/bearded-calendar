<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * Cmonthly controller class.
 */
class Controller_Cmonthly extends Controller_Cmain
{
  /**
   * Executes index action. 
   */
  public function action_index()
  {
    $session = Session::instance();
    $year = $session->get('date_year', date('Y'));
    $month = $session->get('date_month', date('m'));

    $manager_label = new manager_label();
    $manager_calendar = new manager_calendar($year, $month);

    $user = manager_model::getUserByUsername(Auth::instance()->get_user());
    // if user is logged in
    if ($user->loaded()) // fetch user's notes
    {
      $notes = manager_model::getUserNotesByUserIdAndPeriod($user->id, $manager_calendar->getPeriod());
      $notes_array = manager_model::getNotesArray($notes);
      $manager_calendar->includeNotes($notes_array);
    }
    $calendar_data = $manager_calendar->generateArray();

    $view = View::factory('calendar/monthly', array(
      'day_labels' => $manager_label->getDayLabels(),
      'month_name' => $manager_label->getMonth(manager_tools::getLeadingZeroes($month)),
      'month' => $month,
      'year' => $year,
      'month_prev' => manager_tools::cycleDec($month, 12),
      'month_next' => manager_tools::cycleInc($month, 12),
      'year_prev' => $year - 1,
      'year_next' => $year + 1,
      'calendar_data' => $calendar_data,
    ));

    $this->template->body = $view->render();
  }
}
