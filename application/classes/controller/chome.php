<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Chome controller class.
 */
class Controller_Chome extends Controller
{
  /**
   * Executes index action. 
   */
	public function action_index()
	{
    $session = Session::instance();

    $view = View::factory('home', array(
      'mode' => $session->get('mode', 'monthly'),
    ));

    $this->response->body($view->render());
	}
}
