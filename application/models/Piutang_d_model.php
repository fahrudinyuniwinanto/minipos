<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Piutang_d_model extends CI_Model {

    public $table = 'piutang_d';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'id_piutang',
            'id_jual',
            'potongan_rp',
            'pembulatan_rp',
            'tambah_rp',
            'alokasi',
            'allow_pay',

        ];
    }

}