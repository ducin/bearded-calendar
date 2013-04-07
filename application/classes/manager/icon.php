<?php

/**
 * Icon manager class. Used to generate SVG animations.
 */
class manager_icon
{
  private $year, $month, $day;
  
  private $football_days;
  
  /**
   * Icon manager class constructor.
   *
   * @param Integer $year
   * @param Integer $month
   * @param Integer $day 
   */
  public function __construct($year, $month, $day)
  {
    $this->year = $year;
    $this->month = $month;
    $this->day = $day;
    
    $this->football_days = array(
      '2012-06-08',
      '2012-06-12',
      '2012-06-16',
      '2012-06-27',
      '2012-06-28',
      '2012-07-01',
    );
  }

  /**
   * Generates date string basing on year, month and date fields.
   *
   * @return String
   */
  private function getDate()
  {
    return manager_tools::getLeadingZeroes($this->year)
      . '-' . manager_tools::getLeadingZeroes($this->month)
      . '-' . manager_tools::getLeadingZeroes($this->day);
  }

  /**
   * Given date is a EURO 2012 football date.
   *
   * @return Boolean
   */
  private function isFootballDay()
  {
    return in_array($this->getDate(), $this->football_days);
  }

  /**
   * Given date is the Children's day.
   *
   * @return Boolean
   */
  private function isChildrenDay()
  {
    return ($this->getDate() == '2012-06-01');
  }
  
  /**
   * Returns array of icons that should be displayed in the daily calendar mode.
   *
   * @return Array
   */
  public function getIcons()
  {
    mt_srand();
    $data= array();
    if ($this->isFootballDay())
    {
      $data['icon_left'] = 'beer';
      $data['icon_right'] = 'uefa';
    }
    elseif ($this->isChildrenDay())
    {
      $data['icon_circle'] = 'teddy';
    }
    elseif (mt_rand(0,4) == 0)
    {
      $data['icon_left'] = 'coffee';
      $data['icon_right'] = 'snow';
    }
    elseif (mt_rand(0,4) == 0)
    {
      $data['icon_left'] = 'hotel';
      $data['icon_right'] = 'gift';
    }
    elseif (mt_rand(0,4) == 0)
    {
      $data['icon_left'] = 'phone';
      $data['icon_right'] = 'storm';
    }
    return $data;
  }
}
