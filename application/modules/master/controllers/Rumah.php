<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rumah extends Public_Controller
{
    private $pathView = 'master/rumah/';
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
                'assets/select2/js/select2.min.js',
				'assets/master/rumah/js/rumah.js'
			));
			$this->add_external_css(array(
                'assets/select2/css/select2.min.css',
				'assets/master/rumah/css/rumah.css'
			));

			$data = $this->includes;

			$data['title_menu'] = 'Master Rumah';

			$content['akses'] = $this->hakAkses;
			$data['view'] = $this->load->view($this->pathView.'index', $content, true);

			$this->load->view($this->template, $data);
		} else {
			showErrorAkses();
		}
	}

	public function getLists() {
		$m_r = new \Model\Storage\Rumah_model();
		$data = $m_r->getData();

		$content['data'] = $data;
		$html = $this->load->view($this->pathView.'list', $content, true);

		echo $html;
	}

    public function addForm() {
        $m_r = new \Model\Storage\Iuran_model();

        $content['iuran'] = $m_r->getData();
        $html = $this->load->view($this->pathView.'addForm', $content, true);

        echo $html;
    }

	public function editForm() {
		$params = $this->input->get('params');

		$kode = $params['kode'];

		$m_r = new \Model\Storage\Rumah_model();
		$data = $m_r->getData($kode);

        $m_r = new \Model\Storage\Iuran_model();

        $content['iuran'] = $m_r->getData();
        $content['data'] = $data[0];
        $html = $this->load->view($this->pathView.'editForm', $content, true);

        echo $html;
    }

    public function cekData() {
        $params = $this->input->post('params');

        try {
            $kode = isset($params['kode']) ? $params['kode'] : null;
            $no_rumah = $params['no_rumah'];

            $sql_no_rumah = "";
            if ( !empty($kode) ) {
                $sql_no_rumah = "where kode <> '".$kode."'";
            }

            $m_r = new \Model\Storage\Rumah_model();
            $sql = "
                select 
                    r.* 
                from
                    (
                        select * from rumah ".$sql_no_rumah."
                    ) r 
                where 
                    r.no_rumah = '".$no_rumah."'
            ";
            // cetak_r( $sql, 1 );
            $d_r = $m_r->hydrateRaw( $sql );

            if ( $d_r->count() > 0 ) {
                $this->result['message'] = 'No. Rumah <b>'.$no_rumah.'</b> sudah ada, harap cek kembali data yang anda input';
            } else {
                $this->result['status'] = 1;
            }
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }

    public function save() {
        $params = $this->input->post('params');

        try {
			$m_r = new \Model\Storage\Rumah_model();
			$kode = $m_r->getNextId();

            $m_r->kode = $kode;
            $m_r->no_rumah = $params['no_rumah'];
            $m_r->pemilik = $params['pemilik'];
            $m_r->kode_iuran = $params['kode_iuran'];
			$m_r->save();

			$deskripsi_log = 'di-submit oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/save', $m_r, $deskripsi_log, $kode );

			$this->result['status'] = 1;
			$this->result['message'] = 'Data rumah berhasil di simpan';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }

	public function edit() {
        $params = $this->input->post('params');

        try {
			$kode = $params['kode'];

			$m_r = new \Model\Storage\Rumah_model();
			$m_r->where('kode', $kode)->update(
				array(
					'no_rumah' => $params['no_rumah'],
                    'pemilik' => $params['pemilik'],
                    'kode_iuran' => $params['kode_iuran'],
				)
			);

			$d_r = $m_r->where('kode', $kode)->first();

			$deskripsi_log = 'di-edit oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/update', $d_r, $deskripsi_log, $kode );

			$this->result['status'] = 1;
			$this->result['message'] = 'Data rumah berhasil di edit';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }

	public function delete() {
        $params = $this->input->post('params');

        try {
			$kode = $params['kode'];

			$m_r = new \Model\Storage\Rumah_model();
			$d_r = $m_r->where('kode', $kode)->first();

			$m_r->where('kode', $kode)->delete();

			$deskripsi_log = 'di-delete oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/delete', $d_r, $deskripsi_log, $kode );

			$this->result['status'] = 1;
			$this->result['message'] = 'Data rumah berhasil di delete';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }
}