<?php defined('BASEPATH') OR exit('No direct script access allowed');

class KasKeluar extends Public_Controller {

    private $pathView = 'accounting/kas_keluar/';
    private $url;
    private $hakAkses;

    function __construct()
    {
        parent::__construct();
        $this->url = $this->current_base_uri;
        $this->hakAkses = hakAkses($this->url);
    }

    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/
    /**
     * Default
     */
    public function index($segment=0)
    {
        if ( $this->hakAkses['a_view'] == 1 ) {
            $this->add_external_js(array(
                "assets/select2/js/select2.min.js",
                "assets/accounting/kas_keluar/js/kas-keluar.js",
            ));
            $this->add_external_css(array(
                "assets/select2/css/select2.min.css",
                "assets/accounting/kas_keluar/css/kas-keluar.css",
            ));

            $data = $this->includes;

            $content['akses'] = $this->hakAkses;
            $content['title_panel'] = 'Kas Keluar';

            // Load Indexx
            $data['title_menu'] = 'Kas Keluar';
            $data['view'] = $this->load->view($this->pathView . 'index', $content, TRUE);
            $this->load->view($this->template, $data);
        } else {
            showErrorAkses();
        }
    }

    public function getLists()
    {
        $m_kk = new \Model\Storage\KasKeluar_model();
        $d_kk = $m_kk->getData();
        
        $content['data'] = $d_kk;
        $html = $this->load->view($this->pathView . 'list', $content, true);

        echo $html;
    }

    public function addForm()
    {
        $content = null;
        $html = $this->load->view($this->pathView . 'addForm', $content, TRUE);

        echo $html;
    }

    public function editForm()
    {
        $params = $this->input->get('params');

        $kode = $params['kode'];

        $m_kk = new \Model\Storage\KasKeluar_model();
        $d_kk = $m_kk->getData( $kode )[0];
        
        $content['data'] = $d_kk;
        $html = $this->load->view($this->pathView . 'editForm', $content, TRUE);

        echo $html;
    }

    public function save()
    {
        $params = json_decode($this->input->post('data'), TRUE);
        $file = isset($_FILES['file']) ? $_FILES['file'] : null;

        try {
            $tanggal = $params['tanggal'];

            $url = 'uploads/kas_keluar/'.$tanggal;
            if (!file_exists($url)) {
                mkdir($url, 0777, true);
            }

            $upload_path = FCPATH . "//".$url."/";
            $moved = uploadFile($file, $upload_path);
            if ( $moved ) {
                $path_name = $moved['path'];

                $m_kk = new \Model\Storage\KasKeluar_model();
                $kode = $m_kk->getNextId();
    
                $m_kk->kode = $kode;
                $m_kk->tanggal = $params['tanggal'];
                $m_kk->no_bukti = $params['no_bukti'];
                $m_kk->nominal = $params['nominal'];
                $m_kk->keterangan = $params['keterangan'];
                $m_kk->lampiran = $path_name;
                $m_kk->save();
    
                $deskripsi_log = 'di-submit oleh ' . $this->userdata['detail_user']['nama_detuser'];
                Modules::run( 'base/event/save', $m_kk, $deskripsi_log, $kode );
    
                $this->result['status'] = 1;
                $this->result['message'] = 'Data kas keluar berhasil di simpan.';
            } else {
                $this->result['message'] = 'File gagal ter-upload, harap cek data anda.';
            }
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }

    public function edit()
    {
        $params = json_decode($this->input->post('data'), TRUE);
        $file = isset($_FILES['file']) ? $_FILES['file'] : null;

        try {
            $kode = $params['kode'];
            $tanggal = $params['tanggal'];

            $url = 'uploads/kas_keluar/'.$tanggal;
            if (!file_exists($url)) {
                mkdir($url, 0777, true);
            }

            $path_name = null;
            if ( !empty( $file ) ) {
                $upload_path = FCPATH . "//".$url."/";
                $moved = uploadFile($file, $upload_path);
                if ( $moved ) {
                    $path_name = $moved['path'];
                }
            } else {
                $m_kk = new \Model\Storage\KasKeluar_model();
                $d_kk = $m_kk->getData( $kode )[0];

                $path_name = $d_kk['lampiran'];
            }

            $m_kk = new \Model\Storage\KasKeluar_model();
            $m_kk->where('kode', $kode)->update(
                array(
                    'tanggal' => $params['tanggal'],
                    'no_bukti' => $params['no_bukti'],
                    'nominal' => $params['nominal'],
                    'keterangan' => $params['keterangan'],
                    'lampiran' => $path_name,
                )
            );

            $deskripsi_log = 'di-edit oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/update', $m_kk, $deskripsi_log, $kode );

            $this->result['status'] = 1;
            $this->result['message'] = 'Data kas keluar berhasil di edit.';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }

    public function delete()
    {
        $params = $this->input->post('params');

        try {            
            $kode = $params['kode'];

            $m_kk = new \Model\Storage\KasKeluar_model();
            $d_kk = $m_kk->where('kode', $kode)->first();

            $m_kk->where('kode', $kode)->delete();

            $deskripsi_log = 'di-hapus oleh ' . $this->userdata['detail_user']['nama_detuser'];
            Modules::run( 'base/event/delete', $d_kk, $deskripsi_log, $kode );

            $this->result['status'] = 1;
            $this->result['message'] = 'Data kas keluar berhasil di hapus.';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }
}