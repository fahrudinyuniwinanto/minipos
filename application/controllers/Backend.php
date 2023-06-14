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
        $h->today                   = (object) [];
        $h->month                   = (object) [];
        $h->today->gadget = @$this->db->query("SELECT SUM(aa.total) AS total FROM jual_d AS aa 
        LEFT JOIN m_barang AS bb ON aa.id_barang=bb.id 
        WHERE bb.kategori='GADGET'")->row()->total ?? 0;
        $h->today->pakaian = @$this->db->query("SELECT SUM(aa.total) AS total FROM jual_d AS aa 
        LEFT JOIN m_barang AS bb ON aa.id_barang=bb.id 
        WHERE bb.kategori='PAKAIAN'")->row()->total ?? 0;
        $h->today->makanan = @$this->db->query("SELECT SUM(aa.total) AS total FROM jual_d AS aa 
        LEFT JOIN m_barang AS bb ON aa.id_barang=bb.id 
        WHERE bb.kategori='MAKANAN'")->row()->total ?? 0;
        $h->month->gadget = @$this->db->query("SELECT SUM(aa.total) AS total FROM jual_d AS aa 
        LEFT JOIN m_barang AS bb ON aa.id_barang=bb.id 
        WHERE bb.kategori='GADGET'")->row()->total ?? 0;
        $h->month->pakaian = @$this->db->query("SELECT SUM(aa.total) AS total FROM jual_d AS aa 
        LEFT JOIN m_barang AS bb ON aa.id_barang=bb.id 
        WHERE bb.kategori='PAKAIAN'")->row()->total ?? 0;
        $h->month->makanan = @$this->db->query("SELECT SUM(aa.total) AS total FROM jual_d AS aa 
        LEFT JOIN m_barang AS bb ON aa.id_barang=bb.id 
        WHERE bb.kategori='MAKANAN'")->row()->total ?? 0;
        header('Content-Type: application/json');
        echo json_encode(compact(['h']));
    }
}
