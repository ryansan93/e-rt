<?php defined('BASEPATH') OR exit('No direct script access allowed');

class KomponenIuran extends Public_Controller
{
    private $pathView = 'master/komponen_iuran/';
	private $url;
	private $hakAkses;

	function __construct()
	{
		parent::__construct();
		$this->url = $this->current_base_uri;
		$this->hakAkses = hakAkses($this->url);
	}

	public function index()
	{
		if ( $this->hakAkses['a_view'] == 1 ) {
			$this->add_external_js(array(
				'assets/master/komponen_iuran/js/komponen-iuran.js'
			));
			$this->add_external_css(array(
				'assets/master/komponen_iuran/css/komponen-iuran.css'
			));

			$data = $this->includes;

			$data['title_menu'] = 'Master Komponen Iuran';

			$content['akses'] = $this->hakAkses;
			$data['view'] = $this->load->view($this->pathView.'index', $content, true);

			$this->load->view($this->template, $data);
		} else {
			showErrorAkses();
		}
	}

    public function addForm() {
        $content = null;
        $html = $this->load->view($this->pathView.'addForm', $content, true);

        echo $html;
    }

    public function save() {
        $params = $this->input->post('params');

        try {
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }
}