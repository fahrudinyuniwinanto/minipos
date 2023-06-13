<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tagihan_bpjs_model extends CI_Model {

    public $table = 'tagihan_bpjs';
    public $id    = 'id';
    public $order = 'ASC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'no_fpk',
            'id_barang',
            'ref_asal',
            'jenis',
            'no_kartu',
            'no_resep',
            'tgl_pelayanan',
            'qty',
            'tagihan',
            'qty_disetujui',
            'tagihan_disetujui',
            'keterangan',
            'created_at',
            'created_by',
            'isactive',

        ];
    }

}