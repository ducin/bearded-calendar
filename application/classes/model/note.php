<?php defined('SYSPATH') or die('No direct access allowed.');
 
/**
 * Class representing Note model.
 * 
 * @see ORM
 */
class Model_Note extends ORM
{
  protected $_belongs_to = array(
    'owner' => array(
      'model'       => 'user',
      'foreign_key' => 'user_id',
    ),
  );
  
    /**
     * Defining rules for Note ORM model.
     * 
     * @return Array
     */
    public function rules()
    {
        return array(
            'user_id' => array(
                array('not_empty'),
            ),
            'note_date' => array(
                array('not_empty'),
            ),
            'description' => array(
                array('not_empty'),
                array('min_length', array(':value', 4)),
                array('max_length', array(':value', 255)),
            ),
            'created_at' => array(
            ),
            'updated_at' => array(
            ),
        );
    }
    
    /**
     * Defining filters for Note ORM model.
     * 
     * @return Array
     */
    public function filters()
    {
        return array(
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
}
