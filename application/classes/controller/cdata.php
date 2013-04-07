<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * Cdata controller class. Creates fixture data.
 */
class Controller_Cdata extends Controller
{
  /**
   * Executes users action. Creates fixture users data.
   */
  public function action_users()
  {
    $user_data = array(
      'jlennon' => array('John', 'Lennon', 'john.lennon@beatles.com', 'jl', 'jl'),
      'pmccartney' => array('Paul', 'McCartney', 'paul.mccartney@beatles.com', 'pmc', 'pmc'),
      'gharrison' => array('George', 'Harrison', 'george.harrison@beatles.com', 'gh', 'gh'),
      'rstarr' => array('Ringo', 'Starr', 'ringo.starr@beatles.com', 'rs', 'rs'),
    );

    foreach ($user_data as $data)
    {
      $user = ORM::factory('user');
      $user->first_name = $data[0];
      $user->last_name = $data[1];
      $user->email = $data[2];
      $user->username = $data[3];
      $user->password = $data[4];
      try {
        $user->save();
        var_dump("user {$data[3]} created successfully.");
      } catch (ORM_Validation_Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        var_dump($e->errors());
      }
    }
  }

  /**
   * Executes notes action. Creates fixture notes data. Users shall be created
   * first, due to the foreign key relation.
   */
  public function action_notes()
  {
    $note_data = array(
      '1' => array(
        array('2012-06-01', 'going out'),
        array('2012-06-03', 'coming back'),
        array('2012-06-08', 'euro championship: Poland vs Greece'),
        array('2012-06-12', 'euro championship: Poland vs Russia'),
        array('2012-06-16', 'euro championship: Poland vs Czech'),
        array('2012-05-26', 'phone bill'),
        array('2012-06-26', 'phone bill'),
      ), // jl
      '2' => array(
        array('2012-06-01', 'need to buy a present'),
        array('2012-06-08', 'euro championship: Poland vs Greece'),
        array('2012-07-01', 'euro championships final'),
        array('2012-05-29', 'inland revenue'),
        array('2012-05-12', 'gas bill'),
      ), // pmc
    );

    foreach ($note_data as $user_id => $notes)
      foreach ($notes as $data)
      {
        $note = ORM::factory('note');
        $note->user_id = $user_id;
        $note->note_date = $data[0];
        $note->description = $data[1];
        try {
          $note->save();
          var_dump("note '{$data[1]}' created successfully.");
        } catch (ORM_Validation_Exception $e) {
          echo 'Caught exception: ',  $e->getMessage(), "\n";
          var_dump($e->errors());
        }
      }
  }
}
