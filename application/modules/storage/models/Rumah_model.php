<?php
namespace Model\Storage;
use \Model\Storage\Conf as Conf;

class Rumah_model extends Conf {
	protected $table = 'rumah';
	protected $primaryKey = 'kode';
	protected $kodeTable = 'R';
    public $timestamps = false;

    public function getData($id = null, $column = 'kode') {
		$data = null;
        
        $sql_id = "";
        if ( !empty($id) ) {
            $sql_id = "where r.".$column." = '".$id."'";
        }

		$sql = "
			select 
				r.*,
                i.nominal as nominal_iuran
			from ".$this->table." r
            left join
                iuran i
                on
                    i.kode = r.kode_iuran
			".$sql_id."
			order by
				r.kode asc
		";
		$d_r = $this->hydrateRaw($sql);

        if ( !empty($d_r) && $d_r->count() > 0 ) {
            $data = $d_r->toArray();
        }

		return $data;
	}
}