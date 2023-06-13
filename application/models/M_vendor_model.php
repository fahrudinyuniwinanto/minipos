<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_vendor_model extends CI_Model {

    public $table = 'm_vendor';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'nama',
            'alamat',
            'telp',
            'created_at',
            'created_by',

        ];
    }

}