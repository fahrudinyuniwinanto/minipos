<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mutasi_d_model extends CI_Model {

    public $table = 'mutasi_d';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'id_mutasi',
            'id_barang',
            'qty',
            'hrg_satuan',
            'total',

        ];
    }

}
