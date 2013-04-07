<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Class representing User model.
 * 
 * @see ORM
 */
class Model_User extends ORM
{
  protected $_has_many = array(
    'notes' => array(
      'model'       => 'note',
      'foreign_key' => 'user_id',
    ),
  );
  
    /**
     * Defining rules for User ORM model.
     * 
     * @return Array
     */
    public function rules()
    {
        return array(
            'username' => array(
                array('not_empty'),
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 32)),
            ),
            'password' => array(
                array('not_empty'),
                array('min_length', array(':value', 4)),
                array('max_length', array(':value', 255)),
            ),
            'first_name' => array(
                array('not_empty'),
                array('min_length', array(':value', 4)),
                array('max_length', array(':value', 32)),
            ),
            'last_name' => array(
                array('not_empty'),
                array('min_length', array(':value', 4)),
                array('max_length', array(':value', 32)),
            ),
            'email' => array(
                array('not_empty'),
                array('min_length', array(':value', 4)),
                array('max_length', array(':value', 127)),
                array('email'),
            ),
            'last_login' => array(
            ),
            'created_at' => array(
            ),
            'updated_at' => array(
            ),
        );
    }

    /**
     * Defining filters for User ORM model.
     * 
     * @return Array
     */
    public function filters()
    {
        return array(
            'username' => array(
                array('trim'),
            ),
            'first_name' => array(
                array('ucfirst'),
            ),
            'last_name' => array(
                array('ucfirst'),
            ),
            'password' => array(
                array(array($this, 'hash_password'), array(':value')),
            ),
        );
    }

    /**
     * Post insert trigger.
     */
    public function save(Validation $validation = NULL)
    {
      if (!$this->loaded() || isset($this->_changed[$this->_primary_key]))
      {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
      }
      else
      {
        $this->updated_at = date('Y-m-d H:i:s');
      }
      return parent::save($validation);
    }

    /**
     * Hashes password using algorithm defined in auth module.
     *
     * @param type $password
     * @return type 
     */
    public function hash_password($password)
    {
      return Auth::instance()->hash($password);
    }

    /**
     * Updates last login date.
     */
    public function update_last_login()
    {
      $this->last_login = date('Y-m-d H:i:s');
      $this->save();
    }
}
