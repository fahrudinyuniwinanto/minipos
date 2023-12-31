<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_barang extends CI_Controller
{
    private $m;
    function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model('M_barang_model');
        $this->m = new M_barang_model();
    }

    public function index()
    {
        $data = array(
            'content' => "backend/m_barang/m_barang_frm",
        );
        $this->load->view(layout(), $data);
    }

    public function getList()
    {
        $frm = $this->input->get('frm');
        $q = $this->input->get('q');
        $order_by = $this->input->get('order_by');
        $page = $this->input->get('page');
        $limit = $this->input->get('limit');
        $limit = @$limit == 0 ? 10 : $limit;

        $this->queryList($total, $current, $page, $limit, $q, [1 => 1]);

        $data = $current->result_array();
        header('Content-Type: application/json');
        echo json_encode(compact(['total', 'page', 'limit', 'data', 'q']));
    }

    private function queryList(&$total, &$current, $page, $limit, $q, $arr_where)
    {
        $total = $this->db->from($this->m->table)
            ->like('id', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->count_all_results();
        $current = $this->db->select("*,(select v.nama from m_vendor as v where id_vendor = v.id limit 1) as nm_vendor")->from($this->m->table)
            ->like('id', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->limit($limit, ($page * $limit) - $limit)->order_by($this->m->id, $this->m->order)->get();
            // die($this->db->last_query());
    }

    public function lookup()
    {
        $q = $this->input->get('q');
        $order_by = $this->input->get('order_by');
        $start = $this->input->get('start');
        $limit = $this->input->get('limit');
        $limit = @$limit == 0 ? 10 : $limit;

        $total = $this->db->from($this->m->table)
            ->like('id', $q)
            ->count_all_results();
        $current = $this->db->from($this->m->table)
            ->like('id', $q)
            ->limit($limit, $start)->get();
        $data = $current->result_array();
        $this->load->view('backend/lookup', compact(['start', 'total', 'limit', 'data', 'q']));
    }

    public function save()
    {
        $req = json_decode(file_get_contents('php://input'));
        $h = $req->h;
        $f = $req->f;

        $arr = [];
        foreach ($this->m->getFields() as $k => $v) {
            $arr[$v] = @$h->$v;
        }
        if ($f->crud == 'c') {
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['created_by'] = $this->session->userdata('username');
            $this->db->insert($this->m->table, $arr);
        } else {
            // $arr['updated_at'] = date("Y-m-d H:i:s");
            // $arr['updated_by'] = $this->session->userdata('username');
            $this->db->replace($this->m->table, $arr);
        }
        header('Content-Type: application/json');
        echo json_encode('Simpan data berhasil');
    }

    public function read($id)
    {
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $h = $data->row();
        $h->id_supplier=$this->db->get_where('m_vendor',['id'=>$h->id_vendor])->row()->nama;
        header('Content-Type: application/json');
        echo json_encode(compact(['h']));
    }

    public function delete($id)
    {
        $this->db->where($this->m->id, $id);
        $this->db->update($this->m->table, [0 => 0]);
        header('Content-Type: application/json');
        echo json_encode('Hapus data berhasil');
    }

    public function prin()
    {
        $id = $this->input->get('id', TRUE);
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $data = array(
            'h' => $data->row(),
            'content' => 'backend/m_barang/m_barang_print',
        );
        $this->load->view('layout_print', $data);
    }
}
