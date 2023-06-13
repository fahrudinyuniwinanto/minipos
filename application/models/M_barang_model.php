<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_barang_model extends CI_Model {

    public $table = 'm_barang';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'kategori',
            'nama',
            'id_vendor',
            'harga_jual',
            'harga_beli',
            'satuan',
            'created_at',
            'created_by',

        ];
    }

}