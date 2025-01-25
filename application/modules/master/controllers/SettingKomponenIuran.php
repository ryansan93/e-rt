<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SettingKomponenIuran extends Public_Controller
{
    private $pathView = 'master/setting_komponen_iuran/';
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
				'assets/master/setting_komponen_iuran/js/setting-komponen-iuran.js'
			));
			$this->add_external_css(array(
				'assets/select2/css/select2.min.css',
				'assets/master/setting_komponen_iuran/css/setting-komponen-iuran.css'
			));

			$data = $this->includes;

			$data['title_menu'] = 'Setting Komponen Iuran';

			$content['akses'] = $this->hakAkses;
			$data['view'] = $this->load->view($this->pathView.'index', $content, true);

			$this->load->view($this->template, $data);
		} else {
			showErrorAkses();
		}
	}

	public function getLists() {
		$m_ski = new \Model\Storage\SettingKomponenIuran_model();
		$data = $m_ski->getLists();

		$content['data'] = $data;
		$html = $this->load->view($this->pathView.'list', $content, true);

		echo $html;
	}

    public function addForm() {
		$m_i = new \Model\Storage\Iuran_model();
		$m_ki = new \Model\Storage\KomponenIuran_model();

        $content['iuran'] = $m_i->getData();
        $content['komponen_iuran'] = $m_ki->getData();
        $html = $this->load->view($this->pathView.'addForm', $content, true);

        echo $html;
    }

	public function viewForm() {
		$params = $this->input->get('params');

		$kode_iuran = $params['kode_iuran'];
		$tgl_berlaku = $params['tgl_berlaku'];

		$m_ski = new \Model\Storage\SettingKomponenIuran_model();
		$data = $m_ski->getData($kode_iuran, 'kode_iuran', $tgl_berlaku, 'tgl_berlaku');

        $content['data'] = $data[ $kode_iuran.'-'.str_replace('-', '', $tgl_berlaku) ];
        $html = $this->load->view($this->pathView.'viewForm', $content, true);

        echo $html;
    }

	public function editForm() {
		$params = $this->input->get('params');

		$kode_iuran = $params['kode_iuran'];
		$tgl_berlaku = $params['tgl_berlaku'];

		$m_ski = new \Model\Storage\SettingKomponenIuran_model();
		$data = $m_ski->getData($kode_iuran, 'kode_iuran', $tgl_berlaku, 'tgl_berlaku');

		$m_i = new \Model\Storage\Iuran_model();
		$m_ki = new \Model\Storage\KomponenIuran_model();

        $content['iuran'] = $m_i->getData();
        $content['komponen_iuran'] = $m_ki->getData();
        $content['data'] = $data[ $kode_iuran.'-'.str_replace('-', '', $tgl_berlaku) ];
        $html = $this->load->view($this->pathView.'editForm', $content, true);

        echo $html;
    }

	public function cekData() {
		$params = $this->input->post('params');

        try {
			$tgl_berlaku = $params['tgl_berlaku'];
			$kode_iuran = $params['kode_iuran'];
			$tgl_berlaku_old = isset($params['tgl_berlaku_old']) ? $params['tgl_berlaku_old'] : null;
			$kode_iuran_old = isset($params['kode_iuran_old']) ? $params['kode_iuran_old'] : null;

			$sql_old = null;
			if ( !empty($tgl_berlaku_old) && !empty($kode_iuran_old) ) {
				$sql_old = "where concat(kode_iuran, '-', REPLACE(convert(tgl_berlaku, char(10)), '-', '')) <> '".($kode_iuran_old.'-'.str_replace('-', '', $tgl_berlaku_old))."'";
			}

			$m_ski = new \Model\Storage\SettingKomponenIuran_model();
			$sql = "
				select * 
				from 
					(
						select * from setting_komponen_iuran ".$sql_old."
					) ski
				where
					ski.kode_iuran = '".$kode_iuran."' and
					ski.tgl_berlaku = '".$tgl_berlaku."'
			";
			$d_ski = $m_ski->hydrateRaw( $sql );

			$ket = '';
			$status = 1;
			if ( $d_ski->count() > 0 ) {
				$ket = 'Setting komponen iuran untuk kode iuran <b>'.$kode_iuran.'</b> di tanggal berlaku <b>'.tglIndonesia($tgl_berlaku, '-', ' ').'</b> sudah ada, isi setting komponen di tanggal lain.';
				$status = 0;
			}

			$this->result['status'] = $status;
			$this->result['message'] = $ket;
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
	}

    public function save() {
        $params = $this->input->post('params');

        try {
			$kode = null;
			foreach ($params['detail'] as $key => $value) {
				$kode = $params['kode_iuran'].'-'.str_replace('-', '', $params['tgl_berlaku']);

				$m_ski = new \Model\Storage\SettingKomponenIuran_model();
				$m_ski->kode_iuran = $params['kode_iuran'];
				$m_ski->tgl_berlaku = $params['tgl_berlaku'];
				$m_ski->kode_komponen_iuran = $value['kode_komponen_iuran'];
				$m_ski->nominal = $value['nominal'];
				$m_ski->save();
			}
			
			$m_ski = new \Model\Storage\SettingKomponenIuran_model();
			$deskripsi_log = 'di-submit oleh ' . $this->userdata['detail_user']['nama_detuser'];
			Modules::run( 'base/event/save', $m_ski, $deskripsi_log, $kode );

			$this->result['status'] = 1;
			$this->result['message'] = 'Data setting komponen iuran berhasil di simpan';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }

	public function edit() {
        $params = $this->input->post('params');

        try {
			$kode = null;
			$kode_old = null;
			foreach ($params['detail'] as $key => $value) {
				$kode = $params['kode_iuran'].'-'.str_replace('-', '', $params['tgl_berlaku']);
				$kode_old = $params['kode_iuran_old'].'-'.str_replace('-', '', $params['tgl_berlaku_old']);

				$m_ski = new \Model\Storage\SettingKomponenIuran_model();
				$m_ski->where('kode_iuran', $params['kode_iuran_old'])
					  ->where('tgl_berlaku', $params['tgl_berlaku_old'])
					  ->where('kode_komponen_iuran', $value['kode_komponen_iuran'])
					  ->delete();

				$m_ski = new \Model\Storage\SettingKomponenIuran_model();
				$m_ski->kode_iuran = $params['kode_iuran'];
				$m_ski->tgl_berlaku = $params['tgl_berlaku'];
				$m_ski->kode_komponen_iuran = $value['kode_komponen_iuran'];
				$m_ski->nominal = $value['nominal'];
				$m_ski->save();
			}
			
			$m_ski = new \Model\Storage\SettingKomponenIuran_model();
			$deskripsi_log_delete = 'di-delete oleh ' . $this->userdata['detail_user']['nama_detuser'];
			$deskripsi_log = 'di-edit ke id ' . $kode;
			Modules::run( 'base/event/delete', $m_ski, $deskripsi_log_delete, $kode_old, $deskripsi_log );

			$deskripsi_log = 'di-edit oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/update', $m_ski, $deskripsi_log, $kode );

			$this->result['status'] = 1;
			$this->result['message'] = 'Data setting komponen iuran berhasil di edit';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }

	public function delete() {
        $params = $this->input->post('params');

        try {
			$kode_iuran = $params['kode_iuran'];
			$tgl_berlaku = $params['tgl_berlaku'];

			$kode = $params['kode_iuran'].'-'.str_replace('-', '', $params['tgl_berlaku']);

			$m_ski = new \Model\Storage\SettingKomponenIuran_model();
			$m_ski->where('kode_iuran', $kode_iuran)
				  ->where('tgl_berlaku', $tgl_berlaku)
				  ->delete();

			$deskripsi_log = 'di-delete oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/delete', $m_ski, $deskripsi_log, $kode );

			$this->result['status'] = 1;
			$this->result['message'] = 'Data setting komponen iuran berhasil di delete';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }
}