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
        // $this->load->model('Beli_byr_model');
        $this->m    = new Beli_h_model();
        $this->m_d1 = new Beli_d_model();
        // $this->m_d2 = new Beli_byr_model();
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
        $limit    = @$limit == 0 ? 20 : $limit;

        $this->queryList($total, $current, $page, $limit, $q, ['aa.isactive' => 1, 'id_cabang' => getSession('id_cabang')]);

        $data = $current->result();
        foreach ($data as $k => $v) {
            $kredit = @$this->db->query("select alokasi from hutang_d aa inner join hutang_h as bb on aa.id_hutang=bb.id where bb.isactive=1 and aa.id_beli=$v->id")->row()->alokasi;
            $data[$k]->kredit = $kredit ?? '0';
            $cash = @$this->db->query("select dp from beli_h where isactive=1 and id=$v->id")->row()->dp;
            $data[$k]->cash = $cash ?? '0';
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['total', 'page', 'limit', 'data', 'q']));
    }

    private function queryList(&$total, &$current, $page, $limit, $q, $arr_where)
    {
        $this->db->select("aa.*");
        $this->db->from($this->m->table . " aa");
        $this->db->group_start();
        if ($q != "") {
            $this->db->like('dd.nama', $q);
        }
        $this->db->or_like('aa.no_faktur', $q);
        $this->db->or_like('aa.tanggal', $q);
        $this->db->or_like('bb.nama', $q);
        $this->db->group_end();
        $this->db->where($arr_where);
        $this->db->join('m_supplier bb', 'aa.id_suplier=bb.id', 'left');
        if ($q != "") {
            $this->db->join('beli_d cc', 'cc.id_pembelian=aa.id', 'left');
            $this->db->join('m_barang dd', 'cc.id_barang=dd.id', 'left');
        }
        $this->db->group_by('aa.id');
        $total = $this->db->count_all_results();


        $this->db->select("bb.*,aa.*,aa.id as id,bb.nama as nm_suplier");
        $this->db->from($this->m->table . " aa");
        $this->db->group_start();
        if ($q != "") {
            $this->db->like('dd.nama', $q);
        }
        $this->db->or_like('aa.no_faktur', $q);
        $this->db->or_like('aa.tanggal', $q);
        $this->db->or_like('bb.nama', $q);
        $this->db->group_end();
        $this->db->where($arr_where);
        $this->db->join('m_supplier bb', 'aa.id_suplier=bb.id', 'left');
        if ($q != "") {
            $this->db->join('beli_d cc', 'cc.id_pembelian=aa.id', 'left');
            $this->db->join('m_barang dd', 'cc.id_barang=dd.id', 'left');
        }
        $this->db->group_by('aa.id');
        $current = $this->db->limit($limit, ($page * $limit) - $limit)->order_by('aa.' . $this->m->id, $this->m->order)->get();
        // wfDebug($current);
    }

    public function lookup()
    {
        $q        = $this->input->get('q');
        $order_by = $this->input->get('order_by');
        $start    = $this->input->get('start');
        $limit    = $this->input->get('limit');
        $limit    = @$limit == 0 ? 10 : $limit;

        $total = $this->db->from($this->m->table)
            ->group_start()
            ->like('no_faktur', $q)
            ->or_like('tanggal', $q)
            ->group_end()
            ->where('isactive', 1)
            ->where(['id_cabang' => getSession('id_cabang')])
            ->count_all_results();
        $current = $this->db
            ->select("id,(select nama from m_supplier where id=id_suplier) as suplier,no_po,no_faktur,tanggal,dp,total,angsuran,hutang")
            ->from($this->m->table)
            ->group_start()
            ->like('no_faktur', $q)
            ->or_like('tanggal', $q)
            ->group_end()
            ->where('isactive', 1)
            ->where(['id_cabang' => getSession('id_cabang')])
            ->limit($limit, $start)
            ->order_by('id', 'desc')->get();
        $data = $current->result_array();
        $this->load->view('backend/lookup', compact(['start', 'total', 'limit', 'data', 'q']));
    }

    public function qBarang()
    {
        $req = json_decode(file_get_contents('php://input')); //utk method post
        $r   = $req->r;
        $h   = $req->h;
        $nm  = @$req->barcode;
        $id  = @$req->id;
        // $h->jenis = $h->jenis == "MK" ? "UMUM" : $h->jenis;

        if ($id != "") {
            $r               = $this->db->where('id', $id)->get('m_barang')->row();
            $r->arrsat       = @$this->db->select('satuan_konversi as nama_satuan')->get_where('m_konversi', ['id_barang' => $id])->result();
            $r->harga_satuan = @$this->db->get_where('m_harga', ['id_barang' => $id, 'id_satuan' => $r->id_satuan, 'jenis_customer' => $h->jenis, 'id_cabang' => getSession('id_cabang')])->row()->harga_jual;
            $numrows         = 1;
        } else {

            $numrows = $this->db->like('nama', $nm)->or_like('barcode', $nm)->get('m_barang')->num_rows();
            if ($numrows == 1) {
                $r               = $this->db->like('nama', $nm)->or_like('barcode', $nm)->get('m_barang')->row();
                $r->arrsat       = @$this->db->select('satuan_konversi as nama_satuan')->get_where('m_konversi', ['id_barang' => $r->id])->result();
                $r->harga_satuan = @$this->db->get_where('m_harga', ['id_barang' => $r->id, 'id_satuan' => $r->id_satuan, 'jenis_customer' => $h->jenis, 'id_cabang' => getSession('id_cabang')])->row()->harga_jual;
            }
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['r', 'numrows']));
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
            // $this->db->insert("hutang_h", [
            //     'id_beli' => $h->id,
            //     'tanggal_bayar'                          => date('NOW'),
            //     'jumlah_bayar'                           => $h->angsuran,
            //     'id_cabang'                              => getSession('id_cabang'),
            // ]);
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
    // private function saveD2($id, $d)
    // {
    //     foreach ($d as $k1 => $v1) {
    //         foreach ($this->m_d1->getFields() as $k => $v) {
    //             $arr[$v] = @$v1->$v;
    //         }
    //         $arr['id_beli'] = $id;
    //         if (@$arr->id != "" && $this->db->get_where('beli_byr', ['id' => $arr->id])->row()->id != "") {
    //             $this->db->replace($this->m_d1->table, $arr);
    //         } else {
    //             unset($arr['id']);
    //             $this->db->insert($this->m_d1->table, $arr);
    //         }
    //     }
    // }

    public function read($id)
    {
        $this->db->where($this->m->id, $id);
        $data           = $this->db->get($this->m->table, 0, 1);
        $h              = $data->row();
        $getangsuran    = $this->db->query("select sum(alokasi) as angsuran from hutang_d where id_beli='$id'")->row()->angsuran;
        $h->hutang      = ($h->total) - ($h->dp) - $getangsuran;
        $h->angsuran    = $getangsuran;
        $h->nm_supplier = @$this->db->get_where('m_supplier', ['id' => $h->id_suplier])->row()->nama;
        $d              = $this->db->get_where($this->m_d1->table, ['id_pembelian' => $id])->result();
        foreach ($d as $k => $v) {
            $d[$k]->nm_barang = @$this->db->get_where("m_barang", ['id' => @$v->id_barang])->row()->nama;
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['h', 'd']));
    }

    public function delete($id)
    {
        $this->db->where($this->m->id, $id);
        $this->db->update($this->m->table, ['isactive' => 0]);
        // wfDebug([]);
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
