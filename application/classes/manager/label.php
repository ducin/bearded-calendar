<?php

/**
 * Label manager class. Provides label translations used throughout the entire
 * project.
 */
class manager_label
{
  /**
   * Returns array of month labels.
   *
   * @return Array
   */
  public function getMonthLabels()
  {
    return array(
      '01' => 'Styczeń',
      '02' => 'Luty',
      '03' => 'Marzec',
      '04' => 'Kwiecień',
      '05' => 'Maj',
      '06' => 'Czerwiec',
      '07' => 'Lipiec',
      '08' => 'Sierpień',
      '09' => 'Wrzesień',
      '10' => 'Październik',
      '11' => 'Listopad',
      '12' => 'Grudzień',
    );
  }

  /**
   * Returns name of the month given by its number.
   *
   * @param Integer $ind
   * @return String 
   */
  public function getMonth($ind)
  {
    $array = $this->getMonthLabels();
    return $array[manager_tools::getLeadingZeroes($ind)];
  }

  /**
   * Returns array of day labels.
   *
   * @return Array
   */
  public function getDayLabels()
  {
    return array(
      1 => 'Poniedziałek',
      2 => 'Wtorek',
      3 => 'Środa',
      4 => 'Czwartek',
      5 => 'Piątek',
      6 => 'Sobota',
      7 => 'Niedziela',
    );
  }

  /**
   * Returns name of the day given by its number.
   *
   * @param Integer $ind
   * @return String 
   */
  public function getDay($ind)
  {
    $array = $this->getDayLabels();
    return $array[$ind];
  }
}
