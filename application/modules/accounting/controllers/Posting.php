<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posting extends Public_Controller {

    private $pathView = 'accounting/posting/';
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
                "assets/jquery/easy-autocomplete/jquery.easy-autocomplete.min.js",
                "assets/select2/js/select2.min.js",
                "assets/accounting/posting/js/posting.js",
            ));
            $this->add_external_css(array(
                "assets/jquery/easy-autocomplete/easy-autocomplete.min.css",
                "assets/jquery/easy-autocomplete/easy-autocomplete.themes.min.css",
                "assets/select2/css/select2.min.css",
                "assets/accounting/posting/css/posting.css",
            ));

            $data = $this->includes;

            $content['akses'] = $this->hakAkses;
            $content['title_panel'] = 'Posting';

            // Load Indexx
            $data['title_menu'] = 'Posting';
            $data['view'] = $this->load->view($this->pathView . 'index', $content, TRUE);
            $this->load->view($this->template, $data);
        } else {
            showErrorAkses();
        }
    }

    public function proses() {
        $params = $this->input->post('params');

        try {
            $periode = substr( $params['periode'], 0, 7 ).'-01';

            $nama_periode = substr(tglIndonesia( $periode, '-', ' ', true), 3);

            $m_conf = new \Model\Storage\Conf();
            $sql = "exec posting '".$periode."'";
            $m_conf->hydrateRaw( $sql );

            $this->result['status'] = 1;
            $this->result['message'] = 'Proses posting bulan <b>'.$nama_periode.'</b> telah berhasil.';
        } catch (Exception $e) {
            $this->result['message'] = $e->getMessage();
        }

        display_json( $this->result );
    }
}