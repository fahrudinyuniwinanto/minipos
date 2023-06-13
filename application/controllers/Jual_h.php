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
        $jenis        = $this->input->get('jenis') == '' ? 'UMUM' : $this->input->get('jenis');
        $order_by = $this->input->get('order_by');
        $page     = $this->input->get('page');
        $limit    = $this->input->get('limit');
        $limit    = @$limit == 0 ? 10 : $limit;
        $q_start = date("Y-m-d",strtotime($this->input->get('startdate'). ""));
        $q_end = date("Y-m-d",strtotime($this->input->get('enddate'). ""));
        // $q_end = date_format(date_create($this->input->get('enddate')), "Y-m-d");

        $this->queryList($total, $current, $page, $limit, $q, [
            'aa.isactive' => 1, 'aa.id_cabang' => getSession('id_cabang'), 'aa.jenis' => $jenis,
            'aa.tanggal>=' => $q_start, 'aa.tanggal<=' => $q_end
        ]);
        $data = $current->result_array();
        header('Content-Type: application/json');
        echo json_encode(compact(['total', 'page', 'limit', 'data', 'q']));
    }

    private function queryList(&$total, &$current, $page, $limit, $q, $arr_where)
    {
        $this->db->from($this->m->table . ' aa');
        $this->db->select('aa.id');
        $this->db->group_start();
        $this->db->like('aa.no_trs', $q);
        $this->db->or_like('bb.nama', $q);
        $this->db->or_like('cc.nama', $q);
        if ($q != "") {
            $this->db->or_like('ee.nama', $q);
        }
        $this->db->group_end();
        $this->db->where($arr_where);
        $this->db->join('m_customer bb', 'aa.id_customer=bb.id', 'left');
        $this->db->join('m_customer cc', 'aa.dokter_perujuk=cc.id', 'left');
        if ($q != "") {
            $this->db->join('jual_d dd', 'dd.id_penjualan=aa.id', 'left');
            $this->db->join('m_barang ee', 'dd.id_barang=ee.id', 'left');
        }
        $this->db->group_by('aa.id');
        $total = $this->db->count_all_results();
        $this->db->select("aa.*,bb.nama as nm_customer,cc.nama as nm_dokter,
        (select sum(xx.alokasi) from piutang_d as xx 
        inner join piutang_h as yy on xx.id_piutang=yy.id 
        where yy.id_dokter=aa.id_customer 
        and aa.id=xx.id_jual
        -- and jenis_pembayaran='MK' 
        -- and id_cabang='" . getSession('id_cabang') . "'
        ) as terbayar");
        $this->db->from($this->m->table . " aa");
        $this->db->group_start();
        $this->db->like('bb.nama', $q);
        $this->db->or_like('cc.nama', $q);
        if ($q != "") {
            $this->db->or_like('ee.nama', $q);
        }
        $this->db->group_end();
        $this->db->where($arr_where);
        $this->db->join('m_customer bb', 'aa.id_customer=bb.id', 'left');
        $this->db->join('m_customer cc', 'aa.dokter_perujuk=cc.id', 'left');
        if ($q != "") {
            $this->db->join('jual_d dd', 'dd.id_penjualan=aa.id', 'left');
            $this->db->join('m_barang ee', 'dd.id_barang=ee.id', 'left');
        }
        $this->db->group_by('aa.id');
        $current = $this->db->limit($limit, ($page * $limit) - $limit)->order_by("aa." . $this->m->id, $this->m->order)->get();
        // wfDebug($this->db->last_query($current));
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
            ->like('id', $q)
            ->group_end()
            ->where('isactive', 1)
            ->where(['id_cabang' => getSession('id_cabang')])
            ->like('id', $q)
            ->count_all_results();
        $current = $this->db
            ->select("id,no_trs,id_customer,id_po,tanggal,dp,cara_bayar,total")
            ->from($this->m->table)
            ->group_start()
            ->like('id', $q)
            ->group_end()
            ->where('isactive', 1)
            ->where(['id_cabang' => getSession('id_cabang')])
            ->like('id', $q)
            ->limit($limit, $start)
            ->order_by('id', 'desc')->get();
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
            $arr['shift']      = $f->shift;
            $arr['no_trs']     = getAutoNumber('jual_h', 'no_trs', substr($h->jenis, 0, 2) . date("dmY"), 17);
            $arr['id_cabang']  = getSession('id_cabang');
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['created_by'] = $this->session->userdata('username');
            $this->db->insert($this->m->table, $arr);
            // wfDebug($h);
            $h_id = $this->db->insert_id();
            $h    = $this->db->get_where($this->m->table, ['id' => $h_id])->row();
            if ($d) {
                $this->saveD1($h_id, $d);
            }
        } else {
            $arr['updated_at'] = date("Y-m-d H:i:s");
            $arr['updated_by'] = $this->session->userdata('username');
            $this->db->replace($this->m->table, $arr);
            $h = $this->db->get_where($this->m->table, ['id' => $h->id])->row();
            if ($d) {
                $this->db->query("delete from jual_d where id_penjualan=" . $h->id);
                $this->saveD1($h->id, $d);
            }
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['h']));
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
        $data                 = $this->db->get($this->m->table, 0, 1);
        $h                    = $data->row();
        $h->nm_customer       = @$this->db->get_where('m_customer', ['id' => $h->id_customer])->row()->nama;
        $h->nm_dokter_perujuk = @$this->db->get_where('m_customer', ['id' => $h->dokter_perujuk])->row()->nama;
        // $h->nm_customer       = @$this->db->get_where('m_customer', ['id' => $h->id_customer])->row()->nama;
        // $h->nm_dokter_perujuk = @$this->db->get_where('m_customer', ['id' => $h->dokter_perujuk])->row()->nama;
        // $h->alamat_customer   = @$this->db->get_where('m_customer', ['id' => $h->id_customer])->row()->alamat;

        $d = $this->db->get_where($this->m_d1->table, ['id_penjualan' => $id])->result();
        foreach ($d as $k => $v) {
            $d[$k]->nm_barang = @$this->db->get_where("m_barang", ['id' => $v->id_barang])->row()->nama;
            $d[$k]->arrsat    = @$this->db->select('satuan_konversi as nama_satuan')->get_where('m_konversi', ['id_barang' => $v->id_barang])->result();
        }
        // wfDebug($h);
        header('Content-Type: application/json');
        echo json_encode(compact(['h', 'd']));
    }

    public function ubahSatuan()
    {
        $req             = json_decode(file_get_contents('php://input')); //utk method post
        $r               = $req->r;
        $r->qty_entry    = $this->db->get_where("m_konversi", ['id_barang' => $r->id_barang, 'satuan_konversi' => $r->satuan_entry])->row()->qty_konversi;
        $r->harga_satuan = $this->db->get_where("m_harga", ['id_barang' => $r->id_barang, "id_satuan" => $r->satuan_entry, 'jenis_customer' => $r->tipe])->row()->harga_jual;
        header('Content-Type: application/json');
        echo json_encode(compact(['r']));
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
            'h' => $data->row(),
            'd' => $d,
        );
        $this->load->view('backend/jual_h/jual_h_print', $data);
    }


    public function getAutoCompleteCustomer()
    {

        $limit = $this->input->get('limit');
        $q = $this->input->get('q');
        $this->db->select('id,nama,alamat');
        $this->db->like('nama', $q);
        $this->db->order_by('nama');
        $this->db->limit(isset($limit) ? $limit : 10);
        $x = $this->db->get('m_customer')->result();
        $data = [];
        foreach ($x as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['nama'] = "<strong>" . $v->nama . "</strong> ~ " . $v->alamat;
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getCust($id = 1)
    {
        $data = $this->db->get_where("m_customer", ['id' => $id])->row();
        header('Content-Type: application/json');
        echo json_encode($data);
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

    public function qBarang()
    {
        $req = json_decode(file_get_contents('php://input')); //utk method post
        $r   = $req->r;
        $h   = $req->h;
        $nm  = @$req->barcode;
        $id  = @$req->id;
        // die($nm);
        // $h->jenis = $h->jenis == "MK" ? "UMUM" : $h->jenis;

        if ($id != "") {
            $r         = $this->db->where('id', $id)->get('m_barang')->row();
            $r->arrsat = @$this->db->select('satuan_konversi as nama_satuan')->get_where('m_konversi', ['id_barang' => $id])->result();
            //harga jual, di semua cabang sama, jadi tidak perlu diwhere id_cabang
            if ($h->jenis != 'MK') {
                $r->harga_satuan = @$this->db->get_where('m_harga', ['id_barang' => $id, 'id_satuan' => $r->id_satuan, 'jenis_customer' => $h->jenis])->row()->harga_jual;
            } else {
                $r->harga_satuan = $r->harga_beli;
            }
            $numrows = 1;
        } else {

            $numrows = $this->db->like("REPLACE(nama,'\'','')", $nm)->or_like("REPLACE(barcode,'\'','')", $nm)->get('m_barang')->num_rows();
            if ($numrows == 1) {

                $r         = $this->db->like("REPLACE(nama,'\'','')", $nm)->or_like("REPLACE(barcode,'\'','')", $nm)->get('m_barang')->row();
                $r->arrsat = @$this->db->select('satuan_konversi as nama_satuan')->get_where('m_konversi', ['id_barang' => $r->id])->result();
                //harga jual, di semua cabang sama, jadi tidak perlu diwhere id_cabang
                if ($h->jenis != 'MK') {
                    $r->harga_satuan = @$this->db->get_where('m_harga', ['id_barang' => $r->id, 'id_satuan' => $r->id_satuan, 'jenis_customer' => $h->jenis])->row()->harga_jual;
                } else {
                    $r->harga_satuan = $r->harga_beli;
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['r', 'numrows']));
    }

    /*     public function getBarang()
{
$id_barang       = $this->input->get('id', true);
$jns             = $this->input->get('jns_cust', true);
$sat             = $this->input->get('sat', true);
$jns             = $jns == "MK" ? "UMUM" : $jns;
$h               = (object) [];
$h->harga_satuan = @$this->db->get_where('m_harga', ['id_barang' => $id_barang, 'jenis_customer' => $jns, 'id_satuan' => $sat])->row()->harga_jual;
// $h->arrsatuan = $this->db->select('id_satuan')->get_where('m_harga', ['id_barang' => $id, 'jenis_customer' => $jnscust])->row();
// $h->arrsatuan = (object) [];
$h->arrsatuan = $this->db->select('satuan_konversi as satuan')->get_where('m_konversi', ['id_barang' => $id_barang])->result();
// wfDebug([]);
// wfDebug($h->arrsatuan);
header('Content-Type: application/json');
echo json_encode(compact(['h']));
} */
}
