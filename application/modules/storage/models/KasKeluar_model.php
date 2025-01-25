<?php
namespace Model\Storage;
use \Model\Storage\Conf as Conf;

class KasKeluar_model extends Conf {
	protected $table = 'kas_keluar';
	protected $primaryKey = 'kode';
	protected $kodeTable = 'KK';
    public $timestamps = false;

    public function getData($id = null, $column = 'kode') {
		$data = null;
        
        $sql_id = "";
        if ( !empty($id) ) {
            $sql_id = "where km.".$column." = '".$id."'";
        }

		$sql = "
			select 
				km.*
			from ".$this->table." km
			".$sql_id."
			order by
				km.kode asc
		";
		$d_km = $this->hydrateRaw($sql);

        if ( !empty($d_km) && $d_km->count() > 0 ) {
            $data = $d_km->toArray();
        }

		return $data;
	}
}