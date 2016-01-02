<?php

class BaseController extends Controller {

	protected $layout = 'layouts.master';
	protected $httpClient;


	public function __construct()
	{
		$this->httpClient = new Pest('http://localhost/sa-grupo11-services/public');
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
