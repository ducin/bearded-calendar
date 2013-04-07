<?php

/**
 * Calendar manager class. Provides basic functionalities to render calendar. 
 */
class manager_calendar
{
  private $year, $month;
  
  private $week_first, $week_last;
  
  private $day_first, $day_last;
  
  private $manager_holiday, $manager_nameday;
  
  private $day_shift = 86400;
  
  private $notes = null;
  
  /**
   * Calendar manager cnstructor.
   *
   * @param Integer $year
   * @param Integer $month 
   */
  public function __construct($year, $month)
  {
    $this->year = $year;
    $this->month = $month;
    
    if ($this->month == 1)
      $this->week_first = 1;
    else
      $this->week_first = $this->getFirstWeekOfMonth();
    
    if ($this->month == 12)
      $this->week_last = $this->getLastWeekOfYear();
    else
      $this->week_last = $this->getLastWeekOfMonth();
    
    $this->day_first = $this->getDayFirst();
    $this->day_last = $this->getDayLast();

    $this->manager_holiday = new manager_holiday($this->year);
    $this->manager_nameday = new manager_nameday();
  }

  /**
   * Returns first week of month.
   *
   * @return Integer
   */
  private function getFirstWeekOfMonth()
  {
    return date("W", strtotime("{$this->year}-{$this->month}-01 00:00:00"));
  }

  /**
   * Returns last week of month.
   *
   * @return Integer
   */
  private function getLastWeekOfMonth()
  {
    return date("W", strtotime('-1 second',strtotime('+1 month',strtotime($this->month.'/01/'.date('Y').' 00:00:00'))));
  }
  
  /**
   * Returns last week of year.
   *
   * @return Integer
   */
  private function getLastWeekOfYear()
  {
    $next_year = $this->year + 1;
    return date("W", strtotime("-1 week", strtotime("{$next_year}-01-01 00:00:00")));
  }
  
  /**
   * Returns the calendar's first day date.
   *
   * @return String
   */
  private function getDayFirst()
  {
    $first_day_in_month_ts = strtotime("{$this->year}-{$this->month}-01 00:00:00");
    $day_in_the_week = date("N", $first_day_in_month_ts);
    return date("Y-m-d H:i:s", $first_day_in_month_ts - ($day_in_the_week - 1) * $this->day_shift);
  }

  /**
   * Returns the calendar's last day date.
   *
   * @return String
   */
  private function getDayLast()
  {
    $last_day_in_month_ts = strtotime('-1 second',strtotime('+1 month',strtotime($this->month.'/01/'.date('Y').' 00:00:00')));
    $day_in_the_week = date("N", $last_day_in_month_ts);
    return date("Y-m-d H:i:s", $last_day_in_month_ts + (7 - $day_in_the_week) * $this->day_shift);
  }

  /**
   * Returns calendar period as an array of dates.
   *
   * @return Array[String]
   */
  public function getPeriod()
  {
    return array($this->day_first, $this->day_last);
  }
  
  /**
   * Includes notes which will be used while calendar data generating.
   *
   * @param Array[date => note] $notes 
   */
  public function includeNotes($notes)
  {
    $this->notes = $notes;
  }

  /**
   * Returns timestamp of the first day in a week of a given year.
   *
   * @param Integer $week_ind
   * @param Integer $year
   * @return TImestamp 
   */
  private function getFirstDayInWeekTimestamp($week_ind, $year)
  {
    $week = manager_tools::getLeadingZeroes($week_ind);
    return strtotime("{$year}-W{$week}");
  }

  /**
   * Generates result subarray for a given day.
   *
   * @param Timestamp $ts
   * @return Array
   */
  private function generateDayArray($ts)
  {
    $day = date('d', $ts);
    $month = date('m', $ts);
    $year = date('Y', $ts);
    
    $result = array(
      'year' => $year,
      'month' => (int) $month,
      'day' => (int) $day,
      'date' => date('Y/m/d', $ts),
    );

    // applying namedays
    $result['namedays'] = $this->manager_nameday->getNamedayByDate($month, $day);
    
    // applying holidays
    if ($holiday = $this->manager_holiday->getHolidayByDate($month, $day))
      $result['holidays'] = $holiday;
    
    if (isset($this->notes[date('Y-m-d', $ts)]))
      $result['notes'] = $this->notes[date('Y-m-d', $ts)];
    
    return $result;
  }

  /**
   * Generates result subarray for a given week.
   *
   * @param Timestamp $ts
   * @return Array
   */
  public function generateWeekArray($ts)
  {
    $day_tmp_array = array();
    // iterate through days
    for ($weekday_ind = 1; $weekday_ind <= 7; $weekday_ind++)
    {
      $day_tmp_array[$weekday_ind] = $this->generateDayArray($ts);
      $ts = strtotime("+1 day", $ts);
    }
    return $day_tmp_array;
  }
  
  /**
   * Generate calendar data array. Used in frontend to display calendar view
   * easily.
   *
   * @return Array
   */
  public function generateArray()
  {
    $result = array();

    // iterate through weeks
    for ($week_ind = $this->week_first; $week_ind <= $this->week_last; $week_ind++)
    {
      // timestamp
      $ts = $this->getFirstDayInWeekTimestamp($week_ind, $this->year);
      $result[$week_ind] = $this->generateWeekArray($ts);
    }
    
    // for December (cross-week-year problem)
    if ($this->month == 12)
    {
      // timestamp
      $ts = $this->getFirstDayInWeekTimestamp('01', $this->year + 1);
      $result['1'] = $this->generateWeekArray($ts);
    }

    return $result;
  }
}
