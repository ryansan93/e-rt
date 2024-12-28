<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class TutupBulan extends Public_Controller {

    /**
     * Constructor
    */
    function __construct() {
        parent::__construct ();
    }

    public function getData() {
        $jenis = $this->input->post('jenis');
        
        $_jenis = $this->config->item('jenis_tutup_menu')[ $jenis ];

        $m_conf = new \Model\Storage\Conf();
        $sql = "
            select min(periode) as minDate, DATEADD(DD, 1, EOMONTH(max(periode))) as maxDate from tutup_bulan where status = 1 and jenis = ".$_jenis."
        ";
        $d_conf = $m_conf->hydrateRaw( $sql );

        $data = null;
        if ( $d_conf->count() > 0 ) {
            $d_conf = $d_conf->toArray()[0];

            $data = array(
                'minDate' => $d_conf['minDate'],
                'maxDate' => $d_conf['maxDate']
            );
        }

        $this->result['content'] = $data;

        display_json( $this->result );
    }
}
