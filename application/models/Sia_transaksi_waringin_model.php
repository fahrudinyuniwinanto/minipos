<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sia_transaksi_waringin_model extends CI_Model
{

    public $table = 'sia_transaksi_waringin';
    public $id = 'id_transaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->where('isactive', 1);
        $this->db->group_start();
        $this->db->like('id_transaksi', $q);
	$this->db->or_like('id_akun', $q);
	$this->db->or_like('tgl_input', $q);
	$this->db->or_like('jenis_saldo', $q);
	$this->db->or_like('saldo', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('update_by', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('update_at', $q);
	$this->db->or_like('isactive', $q);
	$this->db->group_end();
            $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function total_rows_buku_besar($q = NULL) {
        $this->db->where('isactive', 1);
        $this->db->group_start();
        $this->db->like('id_transaksi', $q);
    $this->db->or_like('id_akun', $q);
    $this->db->or_like('tgl_input', $q);
    $this->db->or_like('jenis_saldo', $q);
    $this->db->or_like('saldo', $q);
    $this->db->or_like('created_by', $q);
    $this->db->or_like('update_by', $q);
    $this->db->or_like('created_at', $q);
    $this->db->or_like('update_at', $q);
    $this->db->or_like('isactive', $q);
    $this->db->group_end();
            $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->select("* , bb.nama_coa as nama_akun, aa.jenis_saldo as jenis_saldo,
            (select cat_name from kategori where id_kat = aa.penanda ) as nm_penanda,
            (select sum(saldo) from sia_transaksi_waringin where jenis_saldo = 9 )as saldo_debit, (select sum(saldo) from sia_transaksi_waringin where jenis_saldo = 10 )as saldo_kredit, aa.id_transaksi as id_transaksi");
        $this->db->order_by("aa." . $this->id, $this->order);
        //$this->db->where('aa.isactive', 1);
        $this->db->group_start();
        $this->db->like('aa.id_transaksi', $q);
    $this->db->or_like('aa.id_akun', $q);
    $this->db->or_like('bb.no_coa', $q);
    $this->db->or_like('bb.nama_coa', $q);
	$this->db->or_like('aa.tgl_input', $q);
	$this->db->or_like('aa.jenis_saldo', $q);
	$this->db->or_like('aa.saldo', $q);
    $this->db->or_like('aa.ket', $q);
	
	$this->db->group_end();
            $this->db->limit($limit, $start);
        $this->db->join('sia_akun_waringin bb', 'bb.id_akun=aa.id_akun', 'left');
        $this->db->join('sia_transaksi_waringin_h cc', 'cc.id_transaksi=aa.id_transaksi_h', 'left');
        return $this->db->get($this->table . " aa")->result();
    }
    function get_limit_data_buku_besar($limit, $start = 0, $koderek, $tgl, $thn) {

            $whereSub="";
        if ($koderek <> "x0"){
            //die('a');
            $whereSub.="and id_akun = '$koderek' ";
        }
        if($tgl<>"x0"){
            //die('b');
            $whereSub.="and tgl_input = '$tgl' ";

        }if($thn<>"x0"){
            //die('c');
            $whereSub.="and DATE_FORMAT(tgl_input,'%Y-%m') = '$thn' ";

        }if ($koderek == "x0" and $tgl == "x0" and $thn == "x0") {
            //die('d');
             $whereSub.=" ";
        }
        $this->db->select("* , bb.nama_coa as nama_akun, aa.jenis_saldo as jenis_saldo,
            (select cat_name from kategori where id_kat = aa.penanda ) as nm_penanda,
            (select sum(saldo) from sia_transaksi_waringin where jenis_saldo = 9 ".$whereSub.") as saldo_debit,
            (select sum(saldo) from sia_transaksi_waringin where jenis_saldo = 10   ".$whereSub." ) as saldo_kredit, aa.id_transaksi as id_transaksi");
        $this->db->order_by("aa.id_transaksi", 'DESC');
        //$this->db->where('aa.isactive', 1);
         $this->db->group_start();
        if ($koderek <> "x0") {
            $this->db->where('aa.id_akun', $koderek);
        }
        if ($tgl <> "x0") {
            $this->db->where('cc.tgl_input', $tgl);
        }
        if ($thn <> "x0") {
            $this->db->where("DATE_FORMAT(cc.tgl_input,'%Y-%m')", $thn);
            
        }
        if ($koderek == "x0" and $tgl == "x0" and $thn == "x0") {
            $this->db->where('1', '1');
        } if ($koderek <> "x0" and $tgl <> "x0" ) {
            $this->db->where('aa.id_akun', $koderek);
            $this->db->where('cc.tgl_input', $tgl);
        }
        $this->db->group_end();
            //$this->db->limit($limit, $start);
        $this->db->join('sia_akun_waringin bb', 'bb.id_akun=aa.id_akun', 'left');
        $this->db->join('sia_transaksi_waringin_h cc', 'cc.id_transaksi=aa.id_transaksi_h', 'left');
        return 
         $this->db->get($this->table . " aa")->result();
        //echo $this->db->last_query();die();
        
     }
       
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

     function update_h($id, $data)
    {
        $this->db->where('id_transaksi_h', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
     function delete_all($id)
    {

        $this->db->where('id_transaksi_h', $id);
        $this->db->delete($this->table);
    }

    // move to bin
    function bin($id){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, array('isactive'=>0));
    }

}

/* End of file Sia_transaksi_waringin_model.php */
/* Location: ./application/models/Sia_transaksi_waringin_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-01 04:41:29 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */