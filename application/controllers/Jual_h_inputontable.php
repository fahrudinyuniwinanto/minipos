<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jual_h extends CI_Controller
{
    private $m;
    private $m_d1;
    public function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model('Jual_h_model');
        $this->load->model('Jual_d_model');
        $this->m    = new Jual_h_model();
        $this->m_d1 = new Jual_d_model();
    }

    public function index()
    {
        $data = array(
            'content' => "backend/jual_h/jual_h_frm",
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
        $total = $this->db->from($this->m->table . ' aa')
            ->like('aa.id', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->join('m_customer bb', 'aa.id_customer=bb.id', 'left')
            ->count_all_results();
        $current = $this->db->select("aa.*,bb.nama as nm_customer")
            ->from($this->m->table . " aa")
            ->like('aa.id', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->join('m_customer bb', 'aa.id_customer=bb.id', 'left')
            ->limit($limit, ($page * $limit) - $limit)->order_by("aa." . $this->m->id, $this->m->order)->get();
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
        $arr['shift']    = $f->shift;
        $arr['no_trs']   = getAutoNumber('jual_h', 'no_trs', substr($h->jenis, 0, 4), 8);
        if ($f->crud == 'c') {
            $arr['id_cabang']  = getSession('id_cabang');
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
                $this->db->query("delete from jual_d where id_penjualan=" . $h->id);
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
            $arr['id_penjualan'] = $id;
            if (@$arr->id != "" && $this->db->get_where('beli_d', ['id' => $arr->id])->row()->id != "") {
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
        $h->nm_customer = $this->db->get_where('m_customer', ['id' => $h->id_customer])->row()->nama;
        // $h->nm_customer       = @$this->db->get_where('m_customer', ['id' => $h->id_customer])->row()->nama;
        // $h->nm_dokter_perujuk = @$this->db->get_where('m_customer', ['id' => $h->dokter_perujuk])->row()->nama;
        // $h->alamat_customer   = @$this->db->get_where('m_customer', ['id' => $h->id_customer])->row()->alamat;

        $d = $this->db->get_where($this->m_d1->table, ['id_penjualan' => $id])->result();
        foreach ($d as $k => $v) {
            $d[$k]->nm_barang = @$this->db->get_where("m_barang", ['id' => $v->id_barang])->row()->nama;
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['h', 'd']));
    }

    public function qBarang()
    {
        $nm      = $this->input->get('nama_barang');
        $numrows = $this->db->like('nama', $nm)->get('m_barang')->num_rows();
        if ($numrows == 1) {
            $h = $this->db->like('nama', $nm)->get('m_barang')->row();
        } else {
            $h = [];
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['h', 'numrows']));
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
        $data = $this->db->get($this->m->table, 0, 1);
        $d    = $this->db->select("*,(select nama from m_barang where id=aa.id_barang) as barang")
            ->get_where('jual_d as aa', ['aa.id_penjualan' => $id])->result();
        $data = array(
            'h'       => $data->row(),
            'd'       => $d,
            'content' => 'backend/jual_h/jual_h_print',
        );
        $this->load->view('layout_print', $data);
    }

    public function getSatuan($id = '')
    {
        if ($id != "") { //tabel m_konversi
            $h = $this->db->select('satuan_konversi as nama_satuan')->get_where('m_konversi', ['id_barang' => $id])->result();
        } else { //tabel m_satuan
            $data = $this->db->select('nama_satuan')->get('m_satuan');
            $h    = $data->result();
        }

        header('Content-Type: application/json');
        echo json_encode(compact(['h']));
    }

    public function getBarang()
    {
        $id_barang       = $this->input->get('id', true);
        $jns             = $this->input->get('jns_cust', true);
        $sat             = $this->input->get('sat', true);
        $h               = (object) [];
        $h->harga_satuan = @$this->db->get_where('m_harga', ['id_barang' => $id_barang, 'jenis_customer' => $jns, 'id_satuan' => $sat])->row()->harga_jual;
        // $h->arrsatuan = $this->db->select('id_satuan')->get_where('m_harga', ['id_barang' => $id, 'jenis_customer' => $jnscust])->row();
        // $h->arrsatuan = (object) [];
        $h->arrsatuan = $this->db->select('satuan_konversi as satuan')->get_where('m_konversi', ['id_barang' => $id_barang])->result();
        // wfDebug([]);
        // wfDebug($h->arrsatuan);
        header('Content-Type: application/json');
        echo json_encode(compact(['h']));
    }
}