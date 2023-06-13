<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jual_d_model extends CI_Model
{

    public $table = 'jual_d';
    public $id    = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    public function getFields()
    {
        return [
            'id',
            'id_penjualan',
            'id_barang',
            'qty_entry',
            'satuan_entry',
            'harga_satuan',
            'harga',
            'embalase_rp',
            'is_racik',
            'racik_rp',
            'qty',
            'diskon_persen',
            'diskon_rp',
            'ppn_persen',
            'ppn_rp',
            'tambah_persen',
            'tambah_rp',
            'hpp',
            'total',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }

}
