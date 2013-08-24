<?php

/**
 * Class managing ORM models database tables.
 */
class manager_model
{
  /**
   * Fetches User from the database using username field value.
   *
   * @param String $username
   * @return Model_User
   */
  static public function getUserByUsername($username)
  {
    return ORM::factory('user')
      ->where('username', '=', $username)
      ->find();
  }

  /**
   * Fetches User with its notes from the database using username field value.
   *
   * @param String $username
   * @return Model_User
   */
  static public function getUserWithNotesByUsername($username)
  {
    return ORM::factory('user')
      ->where('username', '=', $username)
      ->with('notes')
      ->find();
  }

  /**
   * Fetches user notes from the database using user_id and period values.
   *
   * @param Integer $user_id
   * @param Array[String] $period
   * @return Database_MySQL_Result[Model_Note]
   */
  static public function getUserNotesByUserIdAndPeriod($user_id, $period)
  {
    return ORM::factory('note')
      ->where('user_id', '=', $user_id)
      ->and_where('note_date', 'between', $period)
      ->find_all();
  }

  /**
   * Transforms Model_Note database query result into an array.
   *
   * @param Database_MySQL_Result[Model_Note] $notes
   * @return Array
   */
  static public function getNotesArray($notes)
  {
    $result = array();
    foreach ($notes as $note)
    {
      if (!isset($result[$note->note_date]))
        $result[$note->note_date] = array();
      $result[$note->note_date][$note->id] = $note->description;
    }
    return $result;
  }

  /**
   * Fetches user notes from the database using user_id and date values.
   *
   * @param Integer $user_id
   * @param String $date
   * @return Database_MySQL_Result[Model_Note]
   */
  static public function getUserNotesByUserIdAndDateArray($user_id, $date)
  {
    $notes = ORM::factory('note')
      ->where('user_id', '=', $user_id)
      ->and_where('note_date', '=', $date)
      ->find_all();
    $result = array();
    foreach ($notes as $note)
    {
      $result[$note->id] = $note->description;
    }
    return $result;
  }
}
