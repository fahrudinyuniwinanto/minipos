<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jual_h_model extends CI_Model
{

    public $table = 'jual_h';
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
            'no_trs',
            'tanggal',
            'id_cabang',
            'id_customer',
            'jenis',
            'dokter_perujuk',
            'is_dokel',
            'id_po',
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
            'shift',
            'racik_rp',
            'embalase_rp',
            'total',
            'jumlah_bayar',
            'jumlah_kembali',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }
}
