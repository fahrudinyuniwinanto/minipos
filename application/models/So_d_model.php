<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class So_d_model extends CI_Model
{

    public $table = 'so_d';
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
            'id_so',
            'id_barang',
            'qty_stock',
            'qty_fisik',
            'qty_selisih',
            'harga',
            'keterangan',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }
}
