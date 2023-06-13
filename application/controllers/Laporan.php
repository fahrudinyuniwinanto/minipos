<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Laporan extends CI_Controller
{
    private $barang;
    private $beliH;
    private $jualH;
    public function __construct()
    {
        parent::__construct();
        is_logged();
        // sf_construct();
        $this->load->model('M_barang_model');
        $this->load->model('Jual_h_model');
        $this->barang = new M_barang_model();
        $this->jualH  = new Jual_h_model();
    }

    public function index()
    {
        echo "Pilih menu laporan";
    }

    public function laporanStock()
    {
        $data = array(
            'content' => "backend/laporan/stock/stock_rpt",
        );
        $this->load->view(layout(), $data);
    }

    public function laporanPenjualanDetil()
    {
        $data = array(
            'content' => "backend/laporan/penjualan/penjualan_detil_rpt",
        );
        $this->load->view(layout(), $data);
    }


    public function prinPenjualanDetil()
    {
        // $id_cabang = getSession('id_cabang');
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");
        $where = "tanggal BETWEEN '$date1' AND '$date2'";
        $header = "";
        $h     = $this->db->query("select tanggal,COUNT(*) as jml_transaksi,SUM(total) as total from jual_h  
        where 1=1 and $where
        group by tanggal
        order by tanggal desc
        ")->result();
        // echo $this->db->last_query();die();
        $data = array(
            'h'       => $h,
            'date1'   => $date1,
            'date2'   => $date2,
            'header'   => $header,
            'content' => 'backend/laporan/penjualan/penjualan_detil_prin',
        );
        $this->load->view('layout_print', $data);
    }

}
