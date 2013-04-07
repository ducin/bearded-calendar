<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * Csvg controller class.
 */
class Controller_Csvg extends Controller
{
  /**
   * Executes page action. 
   */
  public function action_page()
  {
    $this->response->headers('Content-Type', 'image/svg+xml');

    $session = Session::instance();
    $day = $session->get('date_day', date('d'));
    $month = $session->get('date_month', date('m'));
    $year = $session->get('date_year', date('Y'));

    $manager_label = new manager_label();
    $manager_nameday = new manager_nameday();
    $manager_holiday = new manager_holiday($year);
    $manager_icon = new manager_icon($year, $month, $day);
    
    $custom_date = mktime(0, 0, 0, $month, $day, $year);
    $day_of_year = date('z', $custom_date) + 1; // since counting from 0
    $day_name = $manager_label->getDay(date('N', $custom_date));
    $month_name = $manager_label->getMonth($month);
    
    // special data
    $namedays = $manager_nameday->getNamedayByDate($month, $day);
    $holiday = $manager_holiday->getHolidayByDate($month, $day);
    
    $data = array(
      'day' => $day,
      'month' => $month,
      'year' => $year,
      'day_name' => $day_name,
      'month_name' => $month_name,
      'day_of_year' => $day_of_year,
      'namedays' => $namedays,
    );
    if (!is_null($holiday)) $data['holiday'] = $holiday;
    $icon_data = $manager_icon->getIcons();
        
    $this->response->body(View::factory('svg/page', array_merge($data, $icon_data)));
  }
}
