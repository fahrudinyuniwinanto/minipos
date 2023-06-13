<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Beli_h_model extends CI_Model
{

    public $table = 'beli_h';
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
            'tanggal',
            'id_cabang',
            'id_suplier',
            'no_faktur',
            'no_po',
            'jenis_customer',
            'jenis_ppn',
            'potongan_persen',
            'potongan_rp',
            'jatuh_tempo',
            'keterangan',
            'biaya1',
            'keterangan_biaya1',
            'biaya2',
            'keterangan_biaya2',
            'dp',
            'cara_bayar',
            'total',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }
}