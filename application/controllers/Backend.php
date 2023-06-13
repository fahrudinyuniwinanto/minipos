<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend extends CI_Controller
{
    private $m;
    public function __construct()
    {
        parent::__construct();
        is_logged();
    }

    public function index()
    {

        $data = array(
            'data_penjualan_h' => $this->db->get("jual_h")->result(),
            'content'          => 'backend/dashboard',

        );
        $this->load->view(layout(), $data);
    }

    public function getTot()
    {

        $h                   = (object) [];
        $c                   = (object) [];
        $c->tgl              = (object) [];
        $h->today            = (object) [];
        $h->thismonth        = (object) [];
        $h->trans            = (object) [];
        $sessCabang          = getSession('id_cabang');
        $h->today->umum      = @$this->getToday('UMUM');
        $h->today->mk        = @$this->getToday('MK');
        $h->today->resep     = @$this->getToday('RESEP');
        $h->thismonth->umum  = @$this->getThisMonth('UMUM');
        $h->thismonth->mk    = @$this->getThisMonth('MK');
        $h->thismonth->resep = @$this->getThisMonth('RESEP');
        // $h->today->resep     = @$this->db->query("SELECT sum(bb.jumlah_bayar) as total,count(aa.id) as jml FROM `jual_h` AS aa inner join jual_byr as bb on aa.id=bb.id_jual where aa.jenis='RESEP' AND aa.tanggal='" . date('Y-m-d') . "' AND aa.id_cabang='" . $sessCabang . "' group by bb.id_jual")->row();
        // $h->thismonth        = @$this->db->query("SELECT sum(bb.jumlah_bayar) as total,count(aa.id) as jml FROM `jual_h` AS aa inner join jual_byr as bb on aa.id=bb.id_jual where DATE_FORMAT(aa.tanggal,'%Y-%m')='" . date('Y-m') . "' AND aa.id_cabang='" . $sessCabang . "' group by bb.id_jual")->row();
        $h->trans->today     = @$this->db->query("SELECT sum(bb.alokasi) as total,count(aa.id) as jml 
        FROM `jual_h` AS aa inner join piutang_d as bb on aa.id=bb.id_jual 
        where DATE_FORMAT(aa.tanggal,'%Y-%m-%d')='" . date('Y-m-d') . "' 
        AND aa.id_cabang='" . $sessCabang . "' group by bb.id_jual")->row();
        $h->trans->thismonth = @$this->db->query("SELECT sum(bb.alokasi) as total,count(aa.id) as jml FROM `jual_h` AS aa inner join piutang_d as bb on aa.id=bb.id_jual where DATE_FORMAT(aa.tanggal,'%Y-%m')='" . date('Y-m') . "' AND aa.id_cabang='" . $sessCabang . "' group by bb.id_jual")->row();
        $h->trans->thisyear  = @$this->db->query("SELECT sum(bb.alokasi) as total,count(aa.id) as jml FROM `jual_h` AS aa inner join piutang_d as bb on aa.id=bb.id_jual where DATE_FORMAT(aa.tanggal,'%Y')='" . date('Y') . "' AND aa.id_cabang='" . $sessCabang . "' group by bb.id_jual")->row();
        $c->tgl              = [1, 2, 3, 4, 5, 6, 7];
        header('Content-Type: application/json');
        echo json_encode(compact(['h', 'c']));
    }

    private function getToday($jenis = 'UMUM')
    {
        return $this->db->query(
            "SELECT sum(if(total IS NULL,0,total)) as total,count(id) as jml
            FROM `jual_h`
            where jenis='$jenis' AND
         DATE_FORMAT(tanggal,'%Y-%m-%d')='" . date('Y-m-d') . "' AND id_cabang='" . getSession('id_cabang') . "'")->row();
    }

    private function getThisMonth($jenis = 'UMUM')
    {
        return $this->db->query(
            "SELECT sum(if(total IS NULL,0,total)) as total,count(id) as jml
            FROM `jual_h`
            where jenis='$jenis' AND
         DATE_FORMAT(tanggal,'%Y-%m')='" . date('Y-m') . "' AND id_cabang='" . getSession('id_cabang') . "'")->row();
    }
}