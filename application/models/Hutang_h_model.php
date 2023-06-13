<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Hutang_h_model extends CI_Model {

    public $table = 'hutang_h';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'id_cabang',
            'id_suplier',
            'tanggal_bayar',
            'jumlah_bayar',
            'keterangan',
            'cara_bayar',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }

}