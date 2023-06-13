<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mutasi_h extends CI_Controller
{
    private $m;
    public function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model('Mutasi_h_model');
        $this->load->model('Mutasi_d_model');
        $this->m    = new Mutasi_h_model();
        $this->m_d1 = new Mutasi_d_model();
    }

    public function index()
    {
        $data = array(
            'content' => "backend/mutasi_h/mutasi_h_frm",
        );
        $this->load->view(layout(), $data);
    }

    public function getList()
    {
        $frm      = $this->input->get('frm');
        $q        = $this->input->get('q');
        $order_by = $this->input->get('order_by');
        $page     = $this->input->get('page');
        $limit    = $this->input->get('limit');
        $limit    = @$limit == 0 ? 10 : $limit;

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
        $current = $this->db->from($this->m->table)
            ->like('id', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->limit($limit, ($page * $limit) - $limit)->order_by($this->m->id, $this->m->order)->get();
    }

    public function lookup()
    {
        $q        = $this->input->get('q');
        $order_by = $this->input->get('order_by');
        $start    = $this->input->get('start');
        $limit    = $this->input->get('limit');
        $limit    = @$limit == 0 ? 10 : $limit;

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
        $h   = $req->h;
        $d   = $req->d;
        $f   = $req->f;
        // wfDebug($d);

        $arr = [];
        foreach ($this->m->getFields() as $k => $v) {
            $arr[$v] = @$h->$v;
        }
        if ($f->crud == 'c') {
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['created_by'] = $this->session->userdata('username');
            $this->db->insert($this->m->table, $arr);
            $lastid = $this->db->insert_id();
            if ($d) {
                // wfDebug($d);
                $this->saveD1($lastid, $d);
            }
        } else {
            $this->db->replace($this->m->table, $arr);
            if ($d) {
                $this->db->query("delete from mutasi_d where id_mutasi=" . $h->id);
                $this->saveD1($h->id, $d);
            }
        }
        header('Content-Type: application/json');
        echo json_encode('Simpan data berhasil');
    }

    private function saveD1($id, $d)
    {
        foreach ($d as $k1 => $v1) {
            foreach ($this->m_d1->getFields() as $k => $v) {
                $arr[$v] = @$v1->$v;
            }
            $arr['id_mutasi'] = $id;
            if (@$arr->id != "" && $this->db->get_where('mutasi_d', ['id' => $arr['id']])->row()->id != "") {
                $this->db->replace($this->m_d1->table, $arr);
            } else {
                unset($arr['id']);
                $this->db->insert($this->m_d1->table, $arr);
            }
        }
    }

    public function read($id)
    {
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $h    = $data->row();
        $d    = $this->db->get_where($this->m_d1->table, ['id_mutasi' => $id])->result();
        foreach ($d as $k => $v) {
            $d[$k]->nm_barang = @$this->db->get_where('m_barang', ['id' => @$v->id_barang])->row()->nama;
            $d[$k]->id_satuan = @$this->db->get_where('m_barang', ['id' => @$v->id_barang])->row()->id_satuan;
            $d[$k]->harga_satuan = @$this->db->get_where('m_barang', ['id' => @$v->id_barang])->row()->harga_beli;
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['h', 'd']));
    }

    public function delete($id)
    {
        $this->db->where($this->m->id, $id);
        $this->db->delete($this->m->table);
        header('Content-Type: application/json');
        echo json_encode('Hapus data berhasil');
    }

    public function prin()
    {
        $id = $this->input->get('id', true);
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $data = array(
            'h'       => $data->row(),
            'content' => 'backend/mutasi_h/mutasi_h_print',
        );
        $this->load->view('layout_print', $data);
    }
}