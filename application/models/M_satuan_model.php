<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_satuan_model extends CI_Model {

    public $table = 'm_satuan';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'nama_satuan',
            'simbol',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }

}