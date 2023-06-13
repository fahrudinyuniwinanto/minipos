<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Beli_d_model extends CI_Model
{

    public $table = 'beli_d';
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
            'id_pembelian',
            'id_barang',
            'ed',
            'qty_entry',
            'satuan_entry',
            'harga_satuan',
            'harga',
            'qty',
            'diskon_persen',
            'diskon_rp',
            'ppn_persen',
            'ppn_rp',
            'total',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }

}
