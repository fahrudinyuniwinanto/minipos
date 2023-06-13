<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_customer extends CI_Controller
{
    private $m;
    public function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model('M_customer_model');
        $this->m = new M_customer_model();
    }

    public function index()
    {
        $data = array(
            'directNew' => $this->input->get('direct_new'),
            'page'      => $this->input->get('page'),
            'content'   => "backend/m_customer/m_customer_frm",
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

        $this->queryList($total, $current, $page, $limit, $q, ['isactive' => 1]);

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
        $current = 
        $this->db->select("*,id as id_cust,(select sum(xx.alokasi) from piutang_d as xx 
        inner join piutang_h as yy on xx.id_piutang=yy.id where yy.id_dokter=id_cust) as cicilan,
        (select sum(total) from jual_h as xx where xx.id_customer=id_cust) as hutang")
        ->from($this->m->table)
            ->like('nama', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->limit($limit, ($page * $limit) - $limit)->order_by($this->m->id, $this->m->order)->get();
    }

    public function lookup()
    {
        $q        = $this->input->get('q');
        $jenis    = $this->input->get('jenis');
        $order_by = $this->input->get('order_by');
        $start    = $this->input->get('start');
        $limit    = $this->input->get('limit');
        $limit    = @$limit == 0 ? 10 : $limit;

        if ($jenis != "") {
            $this->db->where('jenis', $jenis);
        }
        $this->db->where('isactive', 1);
        $this->db->like('nama', $q);
        $total = $this->db->from($this->m->table)->count_all_results();
        
        $this->db->from($this->m->table)
        ->like('nama', $q);
        if ($jenis != "") {
            $this->db->where('jenis', $jenis);
        }
        $this->db->where('isactive', 1);
        $this->db->limit($limit, $start);
        $current = $this->db->select("id,
        nama,
        alamat,
        cp as kontak,
        jenis")->get();

        $data = $current->result_array();
        $this->load->view('backend/lookup', compact(['start', 'total', 'limit', 'data', 'q']));
    }

    public function save()
    {
        $req = json_decode(file_get_contents('php://input'));
        $h   = $req->h;
        $f   = $req->f;

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
        $h    = $data->row();
        header('Content-Type: application/json');
        echo json_encode(compact(['h']));
    }

    public function getCustomer(){//for select2()
      $searchTerm = $this->input->post('searchTerm');
      $this->db->select('*');
      $this->db->where("nama like '%".$searchTerm."%' ");
      $fetched_records = $this->db->get('m_customer',10,1);
      $users = $fetched_records->result_array();

      // Initialize Array with fetched data
      $data = array();
      foreach($users as $user){
          $data[] = array(
            "id"=>$user['id'], 
            "tag"=>$user['nama']);
      }
      header('Content-Type: application/json');
      echo json_encode($data);
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
        $data = array(
            'h'       => $data->row(),
            'content' => 'backend/m_customer/m_customer_print',
        );
        $this->load->view('layout_print', $data);
    }

    public function import()
    {
        $awm  = $this->load->database('waringin_desktop', true);
        $bpjs = $awm->get_where('customer', [1 => 1])->result();
        foreach ($bpjs as $k => $v) {
            $arr['nama']       = $v->nama;
            $arr['alamat']     = $v->alamat;
            $arr['kode_pos']   = $v->pos;
            $arr['telp']       = $v->telp;
            $arr['npwp']       = 'BPJS';
            $arr['cp']         = $v->hp;
            $arr['jenis']      = $v->tipe;
            $arr['created_by'] = getSession('username');
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['isactive']   = 1;
            $this->db->insert($this->m->table, $arr);
        }
        echo "import data customer berhasil";
    }
}