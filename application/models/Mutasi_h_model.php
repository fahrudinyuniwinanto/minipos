<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mutasi_h_model extends CI_Model {

    public $table = 'mutasi_h';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'tanggal',
            'dari',
            'ke',
            'total',
            'created_at',
            'created_by',

        ];
    }

}
