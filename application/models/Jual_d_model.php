<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jual_d_model extends CI_Model {

    public $table = 'jual_d';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'id_penjualan',
            'id_barang',
            'harga',
            'qty',
            'total',
            'created_at',
            'created_by',

        ];
    }

}