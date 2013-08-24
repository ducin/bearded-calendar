<?php

/**
 * Tools manager class. Provides some basic operations used throghout the entire
 * project.
 */
class manager_tools
{
  /**
   * Returns number with leading zeroes with maximal length of 2.
   *
   * @param Integer $arg
   * @return Integer
   */
  static public function getLeadingZeroes($arg)
  {
    return str_pad($arg, 2, "0", STR_PAD_LEFT);
  }

  /**
   * Returns cycles successor.
   *
   * @param Integer $arg
   * @param Integer $size
   * @return Integer
   */
  static public function cycleInc($arg, $size)
  {
    return ($arg == $size ? 1 : $arg + 1);
  }

  /**
   * Returns cycles predecessor.
   *
   * @param Integer $arg
   * @param Integer $size
   * @return Integer 
   */
  static public function cycleDec($arg, $size)
  {
    return ($arg == 1 ? $size : $arg - 1);
  }
}
