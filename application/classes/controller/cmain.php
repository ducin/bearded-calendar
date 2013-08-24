<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Cmain controller class.
 */
class Controller_Cmain extends Controller_Template
{
  public $template = 'frontend';

  /**
   * The before() method is called before your controller action.
   * In our template controller we override this method so that we can
   * set up default values. These variables are then available to our
   * controllers if they need to be modified.
   */
  public function before()
  {
    parent::before();

    if ($this->auto_render) {
      // Initialize empty values
      $this->template->title = '';
      $this->template->content = '';

      $this->template->styles = array();
      $this->template->scripts = array();
    }

    $session = Session::instance();
    $user = Auth::instance()->get_user();
    $title = 'Kohana Calendar';
    $mode = $session->get('mode');

    View::bind_global('user', $user);
    View::bind_global('title', $title);
    View::bind_global('mode', $mode);

    $login = $session->get('login');
    if ($login !== null)
    {
      View::bind_global('login', $login);
      $session->delete('login');
    }
  }

  /**
   * The after() method is called after your controller action.
   * In our template controller we override this method so that we can
   * make any last minute modifications to the template before anything
   * is rendered.
   */
  public function after()
  {
    if ($this->auto_render)
    {
      $styles = array(
        'web/css/print.css' => 'print',
        'web/css/screen.css' => 'screen, projection',
      );

      $scripts = array(
        'web/js/ajax.js',
        'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',
      );

      $this->template->styles = array_merge($styles, $this->template->styles);
      $this->template->scripts = array_merge($scripts, $this->template->scripts);
    }
    parent::after();
  }
}
