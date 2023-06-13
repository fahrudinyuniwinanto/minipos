<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_barang_model extends CI_Model
{

    public $table = 'm_barang';
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
            'barcode',
            'tipe',
            'nama',
            'id_group1',
            'id_group2',
            'id_group3',
            'rak',
            'ppn_include',
            'is_beli',
            'is_jual',
            'is_mutasi',
            'is_retur_jual',
            'is_retur_beli',
            'id_satuan',
            'qty_sawal',
            'qty_sawal_cabang2',
            'stok_min',
            'stok_maks',
            'harga_beli',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }

}
