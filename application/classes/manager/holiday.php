<?php

/**
 * Holiday manager class. Generates all holidays in Poland for a given year.
 * Allows to check holiday for a given day.
 */
class manager_holiday
{
  /**
   * Given year.
   *
   * @var Integer
   */
  private $year;

  /**
   * Array of holidays for given year.
   *
   * @var Array
   */
  private $holidays = array(
    '01-01' => 'Nowy Rok',
    '01-06' => 'Święto Trzech Króli',
    '05-01' => 'Święto Pracy',
    '05-03' => 'Święto Narodowe Trzeciego Maja',
    '08-15' => 'Wniebowzięcie Najświętszej Maryi Panny',
    '11-01' => 'Dzień Wszystkich Świętych',
    '11-11' => 'Narodowe Święto Niepodległości',
    '12-25' => 'Boże Narodzenie',
    '12-26' => 'drugi dzień Bożego Narodzenia',
  );

  /**
   * Constructor. Generates array of holidays for a given year.
   *
   * @param Integer $year
   */
  public function __construct($year)
  {
    $this->year = $year;
    $this->generateHolidayData();
  }

  /**
   * Fills all predefined Polish holiday with moveable feast
   * (http://en.wikipedia.org/wiki/Moveable_feast).
   */
  private function generateHolidayData()
  {
    $day_shift = 60*60*24;
    $easter_date = easter_date($this->year);

    // Easter - first day (http://en.wikipedia.org/wiki/Easter)
    $this->holidays[date('m-d', $easter_date)] = 'pierwszy dzień Wielkiej Nocy';

    // Easter - second day
    $this->holidays[date('m-d', $easter_date + $day_shift)] = 'drugi dzień Wielkiej Nocy';

    // Pentecost (http://en.wikipedia.org/wiki/Pentecost)
    $this->holidays[date('m-d', $easter_date + 49 * $day_shift)] = 'Zesłanie Ducha Świętego';

    // Corpus Christi (feast) (http://en.wikipedia.org/wiki/Corpus_Christi_(feast))
    $this->holidays[date('m-d', $easter_date + 60 * $day_shift)] = 'Boże Ciało';
  }

  /**
   * Returns array of all holidays.
   *
   * @return Array
   */
  public function getAllHolidays()
  {
    return $this->holidays;
  }

  /**
   * Returns name of the holiday for given month and day (if exists).
   *
   * @param Integer $month
   * @param Integer $day
   * @return String/NULL
   */
  public function getHolidayByDate($month, $day)
  {
    $date = manager_tools::getLeadingZeroes($month).'-'.manager_tools::getLeadingZeroes($day);
    return isset($this->holidays[$date]) ? $this->holidays[$date] : null;
  }
}
