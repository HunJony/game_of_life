<?php defined('SYSPATH') or die('No direct script access.');

/**
 * User: Jony
 * Date: 2017. 02. 01.
 * Time: 9:20
 * Project: game_of_life
 * Company: GreenTech
 */

class Controller_Default extends Controller {

    protected $view;

	public function before()
	{
	    if (Request::current()->action() != 'ajax') {
            $this->view = View::factory(Request::current()->controller() . DIRECTORY_SEPARATOR . Request::current()->action());
            $this->view->base_url = URL::base();
        }
	}

	public function after()
	{
        if (Request::current()->action() != 'ajax') {
            $this->response->body($this->view);
        }
	}
}
