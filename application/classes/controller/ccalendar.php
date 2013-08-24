<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Ccalendar controller class.
 */
class Controller_Ccalendar extends Controller
{
  /**
   * Executes set action.
   */
  public function action_set()
  {
    $params = $this->request->param();
    $session = Session::instance();

    if (isset($params['year']))
      $session->set('date_year', $params['year']);
    if (isset($params['month']))
      $session->set('date_month', manager_tools::getLeadingZeroes($params['month']));
    if (isset($params['day']))
      $session->set('date_day', $params['day']);
    $session->set('mode', $params['mode']);

    Request::current()->redirect('/');
  }

  /**
   * Executes switch_mode action. Switches calendar mode between 'monthly' and
   * 'daily' view.
   */
  public function action_switch_mode()
  {
    $session = Session::instance();
    $session->set('mode', ($session->get('mode') == 'daily' ? 'monthly' : 'daily'));
  }

  /**
   * Executes prev_month action.
   */
  public function action_prev_month()
  {
    $session = Session::instance();
    $session->set('mode', 'monthly');
    $month = $session->get('date_month', date('m'));
    if ($month == 1)
    {
      $session->set('date_month', 12);
      $year = $session->get('date_year', date('Y'));
      $session->set('date_year', $year - 1);
    }
    else
    {
      $session->set('date_month', $month - 1);
    }
    Request::current()->redirect('/');
  }

  /**
   * Executes next_month action.
   */
  public function action_next_month()
  {
    $session = Session::instance();
    $session->set('mode', 'monthly');
    $month = $session->get('date_month', date('m'));
    if ($month == 12)
    {
      $session->set('date_month', 1);
      $year = $session->get('date_year', date('Y'));
      $session->set('date_year', $year + 1);
    }
    else
    {
      $session->set('date_month', $month + 1);
    }
    Request::current()->redirect('/');
  }
}
