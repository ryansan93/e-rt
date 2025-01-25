<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Iuran extends Public_Controller
{
    private $pathView = 'master/iuran/';
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
				'assets/master/iuran/js/iuran.js'
			));
			$this->add_external_css(array(
				'assets/master/iuran/css/iuran.css'
			));

			$data = $this->includes;

			$data['title_menu'] = 'Master Iuran';

			$content['akses'] = $this->hakAkses;
			$data['view'] = $this->load->view($this->pathView.'index', $content, true);

			$this->load->view($this->template, $data);
		} else {
			showErrorAkses();
		}
	}

	public function getLists() {
		$m_i = new \Model\Storage\Iuran_model();
		$data = $m_i->getData();

		$content['data'] = $data;
		$html = $this->load->view($this->pathView.'list', $content, true);

		echo $html;
	}

    public function addForm() {
        $content = null;
        $html = $this->load->view($this->pathView.'addForm', $content, true);

        echo $html;
    }

	public function editForm() {
		$params = $this->input->get('params');

		$kode = $params['kode'];

		$m_i = new \Model\Storage\Iuran_model();
		$data = $m_i->getData($kode);

        $content['data'] = $data[0];
        $html = $this->load->view($this->pathView.'editForm', $content, true);

        echo $html;
    }

    public function save() {
        $params = $this->input->post('params');

        try {
			$m_i = new \Model\Storage\Iuran_model();
			$kode = $m_i->getNextId();

			$m_i->kode = $kode;
			$m_i->nominal = $params['nominal'];
			$m_i->save();

			$deskripsi_log = 'di-submit oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/save', $m_i, $deskripsi_log, $kode );

			$this->result['status'] = 1;
			$this->result['message'] = 'Data iuran berhasil di simpan';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }

	public function edit() {
        $params = $this->input->post('params');

        try {
			$kode = $params['kode'];

			$m_i = new \Model\Storage\Iuran_model();
			$m_i->where('kode', $kode)->update(
				array(
					'nominal' => $params['nominal']
				)
			);

			$d_i = $m_i->where('kode', $kode)->first();

			$deskripsi_log = 'di-edit oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/update', $d_i, $deskripsi_log, $kode );

			$this->result['status'] = 1;
			$this->result['message'] = 'Data iuran berhasil di edit';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }

	public function delete() {
        $params = $this->input->post('params');

        try {
			$kode = $params['kode'];

			$m_i = new \Model\Storage\Iuran_model();
			$d_i = $m_i->where('kode', $kode)->first();

			$m_i->where('kode', $kode)->delete();

			$deskripsi_log = 'di-delete oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/delete', $d_i, $deskripsi_log, $kode );

			$this->result['status'] = 1;
			$this->result['message'] = 'Data iuran berhasil di delete';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }
}