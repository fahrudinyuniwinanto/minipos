<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Piutang_h_model extends CI_Model {

    public $table = 'piutang_h';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'id_cabang',
            'jenis_pembayaran',
            'id_dokter',
            'tanggal_bayar',
            'jumlah_bayar',
            'keterangan',
            'cara_bayar',
            'shift',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }

}