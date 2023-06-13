<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Hutang_h extends CI_Controller
{
    private $m;
    public function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model('Hutang_h_model');
        $this->load->model('Hutang_d_model');
        $this->load->model('M_supplier_model');
        $this->m = new Hutang_h_model();
        $this->hutang_d = new Hutang_d_model();
        $this->suplier = new M_supplier_model();
    }

    public function index()
    {
        $data = array(
            'content' => "backend/hutang_h/hutang_h_frm",
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

        $this->queryList($total, $current, $page, $limit, $q, ['aa.isactive' => 1]);

        $data = $current->result_array();
        header('Content-Type: application/json');
        echo json_encode(compact(['total', 'page', 'limit', 'data', 'q']));
    }

    private function queryList(&$total, &$current, $page, $limit, $q, $arr_where)
    {
        $total = $this->db->from($this->m->table." aa")
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->like('aa.id',$q)
            ->join($this->suplier->table." bb","aa.id_suplier=bb.id")
            ->count_all_results();
            $current = $this->db->from($this->m->table." aa")
            ->select("aa.*,aa.id as id, bb.id as id_vendor,bb.nama as vendor,bb.alamat")
            ->like('aa.id',$q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->join($this->suplier->table." bb","aa.id_suplier=bb.id")
            ->limit($limit, ($page * $limit) - $limit)
            ->order_by($this->m->id, $this->m->order)
            ->get();

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
        $arr['isactive']  = 1;
        $arr['id_cabang'] = getSession("cabang");
        if ($f->crud == 'c') {
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['created_by'] = $this->session->userdata('username');
            $arr['id_cabang']=getSession('id_cabang');
            $this->db->insert($this->m->table, $arr);
            $h->id = $this->db->insert_id();
            if ($d) {
                $this->saveHutangD($h, $d);
            }
        } else {
            $arr['updated_at'] = date("Y-m-d H:i:s");
            $arr['updated_by'] = $this->session->userdata('username');
            $this->db->replace($this->m->table, $arr);
            // if ($d) {
            //     $this->db->query("delete from hutang_d where id_hutang='$h->id'");
            //     $this->saveHutangD($h, $d);
            // }
        }
        header('Content-Type: application/json');
        echo json_encode('Simpan data berhasil');
    }

    private function saveHutangD($h,$d){
        // wfDebug($d);
        foreach ($d as $k => $v) {
            $x=[
                'id_hutang'=>$h->id,
                'id_beli'=>$v->id_beli,
                'potongan_rp'=>$v->potongan_rp,
                'pembulatan_rp'=>$v->pembulatan_rp,
                'tambah_rp'=>$v->tambah_rp,
                'alokasi'=>$v->alokasi,
                'allow_pay'=>$v->allow_pay,
            ];
            $this->db->insert($this->hutang_d->table,$x);
        }
    }



    public function read($id)
    {
        $this->db->where($this->m->id, $id);
        $data       = $this->db->get($this->m->table, 0, 1);
        $h          = $data->row();
        $vendor=$this->db->get_where("m_supplier",['id'=>$h->id_suplier])->row();
        $h->vendor=$vendor->nama;
        $h->alamat=$vendor->alamat;
        $h->id_vendor=$vendor->id;
        $h->dana=$h->jumlah_bayar;
        $h->sisa=intVal($h->dana-$h->jumlah_bayar);
        $d=$this->db->query("SELECT aa.*,aa.id as id_beli,tp.alokasi as alokasi,
        aa.`total`-aa.`dp` AS total,
        (IFNULL(aa.total,0)-IFNULL(aa.dp,0)-IFNULL(tp.alokasi,0)  -IFNULL(tp.`potongan_rp`,0)-IFNULL(tp.`pembulatan_rp`,0)+IFNULL(tp.`tambah_rp`,0)) AS hutang,
        IFNULL(tp.alokasi,0)-IFNULL(tp.`potongan_rp`,0)-IFNULL(tp.`pembulatan_rp`,0)+IFNULL(tp.`tambah_rp`,0) AS angsuran
 FROM beli_h AS aa 
         LEFT JOIN (
         SELECT id_beli,SUM(IFNULL(alokasi,0)) AS alokasi,
         SUM(IFNULL(potongan_rp,0)) AS potongan_rp, 
         SUM(IFNULL(pembulatan_rp,0)) AS pembulatan_rp, 
         SUM(IFNULL(tambah_rp,0)) AS tambah_rp 
         FROM  hutang_d AS bb  
         INNER JOIN hutang_h AS cc ON cc.id=bb.`id_hutang` 
         WHERE cc.isactive=1 AND cc.id_suplier='$h->id_vendor' and cc.id='$id'
         GROUP BY id_beli
         ) tp ON aa.id=tp.id_beli
         WHERE aa.id_suplier='$h->id_vendor' 
         HAVING ROUND(FLOOR(alokasi))>0")->result();
        header('Content-Type: application/json');
        echo json_encode(compact(['h','d']));
    }

    public function readByIdVendor($idvendor)
    {
        $h=$this->db->get_where("m_supplier",['id'=>$idvendor])->row();
        $h->id_suplier=$h->id;
        $h->vendor=$h->nama;
        $h->id="";//id digunakan utk id_hutang
        $d=$this->db->query("SELECT aa.*,aa.id as id_beli,
        IFNULL(aa.`total`,0)-IFNULL(aa.`dp`,0) AS total,
        (IFNULL(aa.total,0)-IFNULL(aa.dp,0)
 -IFNULL(tp.alokasi,0)  -IFNULL(tp.`potongan_rp`,0)-IFNULL(tp.`pembulatan_rp`,0)+IFNULL(tp.`tambah_rp`,0)) AS hutang,
        IFNULL(tp.alokasi,0)-IFNULL(tp.`potongan_rp`,0)-IFNULL(tp.`pembulatan_rp`,0)+IFNULL(tp.`tambah_rp`,0) AS angsuran
 FROM beli_h AS aa 
         LEFT JOIN (
         SELECT id_beli,SUM(IFNULL(alokasi,0)) AS alokasi,
         SUM(IFNULL(potongan_rp,0)) AS potongan_rp, 
         SUM(IFNULL(pembulatan_rp,0)) AS pembulatan_rp, 
         SUM(IFNULL(tambah_rp,0)) AS tambah_rp 
         FROM  hutang_d AS bb  
         INNER JOIN hutang_h AS cc ON cc.id=bb.`id_hutang` 
         WHERE cc.isactive=1 AND cc.id_suplier='$idvendor'
         GROUP BY id_beli
         ) tp ON aa.id=tp.id_beli
         WHERE aa.id_suplier='$idvendor' 
         HAVING ROUND(FLOOR(hutang))>0
         ")->result();
                foreach ($d as $k => $v) {
                    $d[$k]->allow_pay=null;
                    $d[$k]->alokasi=0;
                    $d[$k]->potongan_rp=0;
                    $d[$k]->pembulatan_rp=0;
                    $d[$k]->tambah_rp=0;
                }
        header('Content-Type: application/json');
        echo json_encode(compact(['h','d']));
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
            'content' => 'backend/hutang_h/hutang_h_print',
        );
        $this->load->view('layout_print', $data);
    }
}
