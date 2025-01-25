<?php
namespace Model\Storage;
use \Model\Storage\Conf as Conf;

class SettingKomponenIuran_model extends Conf {
	protected $table = 'setting_komponen_iuran';
    public $timestamps = false;

    public function getLists() {
		$data = null;

		$sql = "
			select 
				ski.kode_iuran,
                ski.tgl_berlaku,
                i.nominal
			from ".$this->table." ski
            left join
                iuran i
                on
                    i.kode = ski.kode_iuran
            left join
                komponen_iuran ki
                on
                    ki.kode = ski.kode_komponen_iuran
            group by
                ski.kode_iuran,
                ski.tgl_berlaku
			order by
				ski.kode_iuran asc,
                ski.tgl_berlaku
		";
		$d_ki = $this->hydrateRaw($sql);

        if ( !empty($d_ki) && $d_ki->count() > 0 ) {
            $data = $d_ki->toArray();
        }

		return $data;
	}

    public function getData($id, $column = 'kode_iuran', $id2 = null, $column2 = null) {
		$data = null;
        
        $sql_id = "where ski.".$column." = '".$id."'";
        if ( !empty( $id2 ) ) {
            $sql_id .= "and ski.".$column2." = '".$id2."'";
        }

		$sql = "
			select 
				ski.*,
                i.nominal as nominal_iuran,
                ki.nama as nama_komponen_iuran
			from ".$this->table." ski
            left join
                iuran i
                on
                    i.kode = ski.kode_iuran
            left join
                komponen_iuran ki
                on
                    ki.kode = ski.kode_komponen_iuran
			".$sql_id."
		";
		$d_ki = $this->hydrateRaw($sql);

        if ( !empty($d_ki) && $d_ki->count() > 0 ) {
            $d_ki = $d_ki->toArray();

            foreach ($d_ki as $key => $value) {
                $key = $value['kode_iuran'].'-'.str_replace('-', '', $value['tgl_berlaku']);
                $key_det = $value['kode_komponen_iuran'];

                if ( !isset( $data[$key] ) ) {
                    $data[$key] = array(
                        'tgl_berlaku' => $value['tgl_berlaku'],
                        'kode_iuran' => $value['kode_iuran'],
                        'nominal_iuran' => $value['nominal_iuran']
                    );
                }

                $data[$key]['detail'][$key_det] = array(
                    'kode_komponen_iuran' => $value['kode_komponen_iuran'],
                    'nama_komponen_iuran' => $value['nama_komponen_iuran'],
                    'nominal' => $value['nominal']
                );
            }
        }

		return $data;
	}
}