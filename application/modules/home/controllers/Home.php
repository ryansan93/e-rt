<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->add_external_js(array(
            "assets/chart/chart.js",
            "assets/home/js/home.js",
        ));
        $this->add_external_css(array(
			"assets/home/css/home.css",
        ));

		$data = $this->includes;

		$data['title_menu'] = 'Home';
		$data['view'] = $this->load->view('home/dashboard', null, true);

		$this->load->view($this->template, $data);
	}
}