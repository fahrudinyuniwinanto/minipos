<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sia_akun_waringin_model extends CI_Model
{

    public $table = 'sia_akun_waringin';
    public $id = 'id_akun';
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
        //$this->db->where('isactive', 1);
        $this->db->group_by('no_coa', 'ASC');
        $this->db->group_start();
        $this->db->like('id_akun', $q);
	$this->db->or_like('no_coa', $q);
	$this->db->or_like('nama_coa', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('parent', $q);
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
         $this->db->select("*,
            cc.cat_name as jenis_saldo,
            (select cat_name from kategori where id_kat = jenis_laporan ) as jenis_laporan
            ");
        $this->db->group_by('aa.no_coa', 'ASC');
        //$this->db->where('isactive', 1);
        $this->db->group_start();
        $this->db->like('aa.id_akun', $q);
	$this->db->or_like('aa.no_coa', $q);
	$this->db->or_like('aa.nama_coa', $q);
	$this->db->or_like('aa.keterangan', $q);
	$this->db->or_like('aa.parent', $q);
	$this->db->or_like('aa.created_by', $q);
	$this->db->or_like('aa.update_by', $q);
	$this->db->or_like('aa.created_at', $q);
	$this->db->or_like('aa.update_at', $q);
	$this->db->or_like('aa.isactive', $q);
    $this->db->or_like('cc.cat_name', $q);
	$this->db->group_end();
            $this->db->limit($limit, $start);
            $this->db->join('kategori cc', 'cc.id_kat=aa.jenis_saldo', 'left');
        return $this->db->get($this->table . " aa")->result();
    }

    function get_limit_data_buku_besar($limit, $start = 0, $koderek, $tgl, $thn) {

        $whereSub="";

        if($thn<>"x0"){
            //die('c');
            $whereSub.=" and DATE_FORMAT(dd.tgl_input,'%Y-%m') between '2022-01' and '$thn' ";
            //column_name BETWEEN value1 AND value2;

        }

         $this->db->select("*,aa.id_akun as id,
             (select cat_name from kategori where id_kat = jenis_laporan ) as jenis_laporans,

        SUM(IF(dd.jenis_saldo = 9 and aa.id_akun = dd.id_akun ".$whereSub.", dd.saldo, 0)) as saldo_debit_trx,
        SUM(IF(dd.jenis_saldo = 10 and aa.id_akun = dd.id_akun ".$whereSub.", dd.saldo, 0)) as saldo_kredit_trx,
        (aa.saldo_debit + SUM(IF(dd.jenis_saldo = 9 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0))) as saldo_debit_buku_besar, 
        (aa.saldo_kredit + SUM(IF(dd.jenis_saldo = 10 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0)) ) as saldo_kredit_buku_besar, 

        IF((aa.saldo_debit + SUM(IF(dd.jenis_saldo = 9 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0))) > (aa.saldo_kredit + SUM(IF(dd.jenis_saldo = 10 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0)) ), ((aa.saldo_debit + SUM(IF(dd.jenis_saldo = 9 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0))) - (aa.saldo_kredit + SUM(IF(dd.jenis_saldo = 10 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0)) )), 0) as neraca_saldo_debit,

         IF((aa.saldo_debit + SUM(IF(dd.jenis_saldo = 9 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0))) < (aa.saldo_kredit + SUM(IF(dd.jenis_saldo = 10 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0)) ), ( (aa.saldo_kredit + SUM(IF(dd.jenis_saldo = 10 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0)) ) - (aa.saldo_debit + SUM(IF(dd.jenis_saldo = 9 and aa.id_akun = dd.id_akun ".$whereSub.", `dd`.`saldo`, 0)))), 0) as neraca_saldo_kredit,

      
            ");

            $this->db->group_by('aa.no_coa', 'ASC');
        
            $this->db->join('kategori cc', 'cc.id_kat=aa.jenis_saldo', 'left');
            $this->db->join('sia_transaksi_waringin dd', 'dd.id_akun=aa.id_akun', 'left');
       return 
        $this->db->get($this->table . " aa")->result();
        //echo $this->db->last_query();die();
    }

        // get data with limit and search
    function get_cetak_lapkas_coa_bank() {
       $this->db->select("*, aa.nama_coa as nama_coa, (select sum(saldo) from sia_transaksi_waringin where id_akun = aa.id_akun ) as beban");
       $this->db->where('aa.query', "BANK");
        $this->db->distinct();
        $this->db->group_by('aa.id_akun', "ASC");
            $this->db->join('sia_transaksi_waringin cc', 'cc.id_akun=aa.id_akun', 'left');
        return 
        $this->db->get($this->table . " aa")->result();
        //echo $this->db->last_query();
    }

    function get_cetak_lapkas_pendapatan_manual() {
       $this->db->select("*, aa.nama_coa as nama_coa, (select sum(saldo) from sia_transaksi_waringin where id_akun = aa.id_akun ) as beban");
       $this->db->where('aa.status', 16);
       $this->db->where('aa.parent', 44);
        $this->db->distinct();
        $this->db->group_by('aa.id_akun', "ASC");
            $this->db->join('sia_transaksi_waringin cc', 'cc.id_akun=aa.id_akun', 'left');
        return 
        $this->db->get($this->table . " aa")->result();
        //echo $this->db->last_query();
    }

    function get_cetak_lapkas_penerimaan_kas() {
       $this->db->select("*, aa.nama_coa as nama_coa, (select sum(saldo) from sia_transaksi_waringin where id_akun = aa.id_akun ) as beban");
       $this->db->where('aa.parent', 45);
        $this->db->distinct();
        $this->db->group_by('aa.id_akun', "ASC");
            $this->db->join('sia_transaksi_waringin cc', 'cc.id_akun=aa.id_akun', 'left');
        return 
        $this->db->get($this->table . " aa")->result();
        //echo $this->db->last_query();
    }
    function get_cetak_lapkas_penambahan_modal() {
       $this->db->select("*, aa.nama_coa as nama_coa, (select sum(saldo) from sia_transaksi_waringin where id_akun = aa.id_akun ) as beban");
       $this->db->where('aa.query', "TAMBAHAN_MODAL");
        $this->db->distinct();
        $this->db->group_by('aa.id_akun', "ASC");
            $this->db->join('sia_transaksi_waringin cc', 'cc.id_akun=aa.id_akun', 'left');
        return 
        $this->db->get($this->table . " aa")->result();
        //echo $this->db->last_query();
    }

    function get_cetak_lapkas_beban() {
       $this->db->select("*, aa.nama_coa as nama_coa, (select sum(saldo) from sia_transaksi_waringin where id_akun = aa.id_akun ) as beban");
       $this->db->where('aa.query', "BEBAN");
        $this->db->distinct();
        $this->db->group_by('aa.id_akun', "ASC");
            $this->db->join('sia_transaksi_waringin cc', 'cc.id_akun=aa.id_akun', 'left');
        return 
        $this->db->get($this->table . " aa")->result();
        //echo $this->db->last_query();
    }

     function get_cetak_lapkas_modal() {
       $this->db->select("*, aa.nama_coa as nama_coa, (select sum(saldo) from sia_transaksi_waringin where id_akun = aa.id_akun ) as beban");
       $this->db->where('aa.query', "MODAL");
        $this->db->distinct();
        $this->db->group_by('aa.id_akun', "ASC");
            $this->db->join('sia_transaksi_waringin cc', 'cc.id_akun=aa.id_akun', 'left');
        return 
        $this->db->get($this->table . " aa")->result();
        //echo $this->db->last_query();
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

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // move to bin
    function bin($id){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, array('isactive'=>0));
    }

}

/* End of file Sia_akun_waringin_model.php */
/* Location: ./application/models/Sia_akun_waringin_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-01 04:41:19 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */