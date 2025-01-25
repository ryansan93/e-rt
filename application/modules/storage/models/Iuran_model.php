<?php
namespace Model\Storage;
use \Model\Storage\Conf as Conf;

class Iuran_model extends Conf {
	protected $table = 'iuran';
	protected $primaryKey = 'kode';
	protected $kodeTable = 'I';
    public $timestamps = false;

    public function getData($id = null, $column = 'kode') {
		$data = null;
        
        $sql_id = "";
        if ( !empty($id) ) {
            $sql_id = "where i.".$column." = '".$id."'";
        }

		$sql = "
			select 
				i.*
			from ".$this->table." i
			".$sql_id."
			order by
				i.kode asc
		";
		$d_i = $this->hydrateRaw($sql);

        if ( !empty($d_i) && $d_i->count() > 0 ) {
            $data = $d_i->toArray();
        }

		return $data;
	}
}