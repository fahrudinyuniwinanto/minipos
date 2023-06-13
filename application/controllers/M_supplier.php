<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_supplier extends CI_Controller
{
    private $m;
    function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model('M_supplier_model');
        $this->m = new M_supplier_model();
    }

    public function index()
    {
        $data = array(
            'directNew' => $this->input->get('direct_new'),
            'content' => "backend/m_supplier/m_supplier_frm",
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

        $this->queryList($total, $current, $page, $limit, $q, ['isactive' => 1]);

        $data = $current->result_array();
        header('Content-Type: application/json');
        echo json_encode(compact(['total', 'page', 'limit', 'data', 'q']));
    }

    private function queryList(&$total, &$current, $page, $limit, $q, $arr_where)
    {
        $total = $this->db->from($this->m->table)
            ->like('nama', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->count_all_results();
        $current = $this->db->from($this->m->table)
            ->like('nama', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->limit($limit, ($page * $limit) - $limit)->order_by($this->m->id, $this->m->order)->get();
    }

    public function lookup()
    {
        $q = $this->input->get('q');
        $order_by = $this->input->get('order_by');
        $start = $this->input->get('start');
        $limit = $this->input->get('limit');
        $limit = @$limit == 0 ? 10 : $limit;

        $total = $this->db->from($this->m->table)
            ->like('nama', $q)
            ->count_all_results();
        $current = $this->db->select("id,
        nama,
        alamat,
        kode_pos,
        telp,
        fax,
        npwp,
        cp,
        jenis")
            ->from($this->m->table)
            ->like('nama', $q)
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
        $arr['isactive'] = 1;
        if ($f->crud == 'c') {
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['created_by'] = $this->session->userdata('username');
            $this->db->insert($this->m->table, $arr);
        } else {
            $arr['updated_at'] = date("Y-m-d H:i:s");
            $arr['updated_by'] = $this->session->userdata('username');
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
        header('Content-Type: application/json');
        echo json_encode(compact(['h']));
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
        $id = $this->input->get('id', TRUE);
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $data = array(
            'h' => $data->row(),
            'content' => 'backend/m_supplier/m_supplier_print',
        );
        $this->load->view('layout_print', $data);
    }



    public function import()
    {
        $awm = $this->load->database('waringin_desktop', TRUE);
        $bpjs = $awm->get_where('vendor', [1 => 1])->result();
        foreach ($bpjs as $k => $v) {
            $arr['nama'] = $v->nama;
            $arr['alamat'] = $v->alamat;
            $arr['kode_pos'] = $v->pos;
            $arr['telp'] = $v->telp;
            $arr['fax'] = $v->fax;
            $arr['cp'] = $v->hp;
            $arr['jenis'] = $v->tipe;
            $arr['created_by'] = getSession('username');
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['isactive'] = 1;
            $this->db->insert($this->m->table, $arr);
        }
        echo "import data supplier berhasil";
    }
}
