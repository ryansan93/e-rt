<?php
namespace Model\Storage;
use \Model\Storage\Conf as Conf;

class KomponenIuran_model extends Conf {
	protected $table = 'komponen_iuran';
	protected $primaryKey = 'kode';
	protected $kodeTable = 'KI';
    public $timestamps = false;

    public function getData($id = null, $column = 'kode') {
		$data = null;
        
        $sql_id = "";
        if ( !empty($id) ) {
            $sql_id = "where ki.".$column." = '".$id."'";
        }

		$sql = "
			select 
				ki.*
			from ".$this->table." ki
			".$sql_id."
			order by
				ki.kode asc
		";
		$d_ki = $this->hydrateRaw($sql);

        if ( !empty($d_ki) && $d_ki->count() > 0 ) {
            $data = $d_ki->toArray();
        }

		return $data;
	}
}