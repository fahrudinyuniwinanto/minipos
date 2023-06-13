<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jual_h_model extends CI_Model {

    public $table = 'jual_h';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'customer',
            'tanggal',
            'cara_bayar',
            'total',
            'jumlah_bayar',
            'jumlah_kembali',
            'created_at',
            'created_by',

        ];
    }

}