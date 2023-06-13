<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Beli_h extends CI_Controller
{
    private $m;
    public function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model('Beli_h_model');
        $this->load->model('Beli_d_model');
        $this->load->model('Beli_byr_model');
        $this->m    = new Beli_h_model();
        $this->m_d1 = new Beli_d_model();
        $this->m_d2 = new Beli_byr_model();
    }

    public function index()
    {
        $data = array(
            'content' => "backend/beli_h/beli_h_frm",
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

        $this->queryList($total, $current, $page, $limit, $q, ['aa.isactive' => 1, 'id_cabang' => getSession('id_cabang')]);

        $data = $current->result_array();
        header('Content-Type: application/json');
        echo json_encode(compact(['total', 'page', 'limit', 'data', 'q']));
    }

    private function queryList(&$total, &$current, $page, $limit, $q, $arr_where)
    {
        $total = $this->db->from($this->m->table . " aa")
            ->like('aa.id', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->join('m_supplier bb', 'aa.id_suplier=bb.id', 'left')
            ->count_all_results();
        $current = $this->db->select("bb.*,aa.*,bb.nama as nm_suplier")
            ->from($this->m->table . " aa")
            ->like('aa.id', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->join('m_supplier bb', 'aa.id_suplier=bb.id', 'left')
            ->limit($limit, ($page * $limit) - $limit)->order_by('aa.' . $this->m->id, $this->m->order)->get();
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

        $arr = [];
        foreach ($this->m->getFields() as $k => $v) {
            $arr[$v] = @$h->$v;
        }
        $arr['isactive'] = 1;
        if ($f->crud == 'c') {
            $arr['id_cabang']  = getSession('cabang');
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['created_by'] = $this->session->userdata('username');
            $this->db->insert($this->m->table, $arr);
            if ($d) {
                $this->saveD1($this->db->insert_id(), $d);
            }
        } else {
            $arr['updated_at'] = date("Y-m-d H:i:s");
            $arr['updated_by'] = $this->session->userdata('username');
            $this->db->replace($this->m->table, $arr);
            if ($d) {
                $this->db->query("delete from beli_d where id_pembelian=" . $h->id);
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
            $arr['id_pembelian'] = $id;
            if (@$arr->id != "" && $this->db->get_where('beli_d', ['id' => $arr->id])->row()->id != "") {
                $this->db->replace($this->m_d1->table, $arr);
            } else {
                unset($arr['id']);
                $this->db->insert($this->m_d1->table, $arr);
            }
        }
    }
    private function saveD2($id, $d)
    {
        foreach ($d as $k1 => $v1) {
            foreach ($this->m_d1->getFields() as $k => $v) {
                $arr[$v] = @$v1->$v;
            }
            $arr['id_beli'] = $id;
            if (@$arr->id != "" && $this->db->get_where('beli_byr', ['id' => $arr->id])->row()->id != "") {
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
        $data           = $this->db->get($this->m->table, 0, 1);
        $h              = $data->row();
        $h->nm_supplier = @$this->db->get_where('m_supplier', ['id' => $h->id_suplier])->row()->nama;
        $d              = $this->db->get_where($this->m_d1->table, ['id_pembelian' => $id])->result();
        $d2             = $this->db->get_where($this->m_d2->table, ['id_beli' => $id])->result();
        foreach ($d as $k => $v) {
            $d[$k]->nm_barang = @$this->db->get_where("m_barang", ['id' => @$v->id_barang])->row()->nama;
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['h', 'd', 'd2']));
    }

    public function delete($id)
    {
        $this->db->where($this->m->id, $id);
        $this->db->update($this->m->table, ['isactive' => 0]);
        header('Content-Type: application/json');
        echo json_encode('Hapus data berhasil');
    }

    public function prin()
    {
        $id = $this->input->get('id', true);
        $this->db->where($this->m->id, $id);
        $h    = $this->db->get($this->m->table, 0, 1);
        $d    = $this->db->get_where("beli_d", ['id_pembelian' => $h->row()->id]);
        $data = array(
            'h'       => $h->row(),
            'd'       => $d->result(),
            'content' => 'backend/beli_h/beli_h_print',
        );
        $this->load->view('layout_print', $data);
    }
}
