<?php defined('SYSPATH') or die('No direct access allowed.');

class Auth_Database extends Auth
{

	/**
	 * Constructor loads the user list into the class.
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Load user list
		$this->_users = Arr::get($config, 'users', array());
	}

	/**
	 * Logs a user in.
	 *
	 * @param   string   username
	 * @param   string   password
	 * @param   boolean  enable autologin (not supported)
	 * @return  boolean
	 */
	protected function _login($username, $password, $remember)
	{
		if (is_string($password))
		{
			// Create a hashed password
			$password = $this->hash($password);
		}

		$user = ORM::factory('user')
			->where('username', '=', $username)
			->and_where('password', '=', $password)
			->find();

		if ($user->loaded())
		{
			// Complete the login
			$user->update_last_login();
			return $this->complete_login($username);
		}

		// Login failed
		return FALSE;
	}

	/**
	 * Get the stored password for a username.
	 *
	 * @param   mixed   username
	 * @return  string
	 */
	public function password($username)
	{
		return ORM::factory('user')
			->where('username', '=', $username)
			->find()
			->password;
	}

	/**
	 * Compare password with original (plain text). Works for current (logged in) user
	 *
	 * @param   string  $password
	 * @return  boolean
	 */
	public function check_password($password)
	{
		$username = $this->get_user();

		if ($username === FALSE)
		{
			return FALSE;
		}

		return ($password === $this->password($username));
	}
}
