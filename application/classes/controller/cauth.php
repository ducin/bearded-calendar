<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * Cauth controller class.
 */
class Controller_Cauth extends Controller
{
  /**
   * Executes login action. 
   */
  public function action_login()
  {
    $post = $this->request->post();
    $success = Auth::instance()->login($post['username'], $post['password']);
    
    $session = Session::instance();
    if ($success)
    {
      $session->set('login', 'success');
    }
    else
    {
      $session->set('login', 'error');
    }
    Request::current()->redirect('/');
  }

  /**
   * Executes logout action. 
   */
  public function action_logout()
  {
    Auth::instance()->logout();
    Request::current()->redirect('/');
  }
}