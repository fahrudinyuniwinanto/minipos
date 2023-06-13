<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_barang extends CI_Controller
{
    private $m;
    public function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model('M_barang_model');
        $this->load->model('M_harga_model');
        $this->load->model('M_konversi_model');
        $this->m   = new M_barang_model();
        $this->kvr = new M_konversi_model();
        $this->hrg = new M_harga_model();
    }

    public function index()
    {
        $data = array(
            'directNew' => $this->input->get('direct_new'),
            'content'   => "backend/m_barang/m_barang_frm",
        );
        $this->load->view(layout(), $data);
    }

    public function qtyawalfrm()
    {
        $data = array(
            'directNew' => $this->input->get('direct_new'),
            'content'   => "backend/m_barang/qty_awal_frm",
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
        $data=$current->result();
        foreach ($data as $k => $v) {
            $idbrg=$v->id;
            $colsawal = getSession('id_cabang')=='WR001'?'qty_sawal':'qty_sawal_cabang2';
            $idcabang = getSession('id_cabang');
            $fieldqtysawal = $idcabang=='WR001'?'qty_sawal':'qty_sawal_cabang2';
            $brg=$this->db->get_where('m_barang',['id'=>$idbrg])->row();
            $jml_sawal = @$this->db->query("select $fieldqtysawal as jml from m_barang where id='$idbrg' and isactive=1")->row()->jml;
            $jml_beli=@$this->db->query("select sum(aa.qty_entry) as jml from beli_d aa
            inner join beli_h bb
            on aa.id_pembelian=bb.id
            where aa.id_barang='$idbrg' and bb.id_cabang='$idcabang' and bb.isactive=1 group by aa.id_barang")->row()->jml;
            $jml_jual = @$this->db->query("select sum(aa.qty_entry) as jml from jual_d aa
            inner join jual_h bb
            on aa.id_penjualan=bb.id
            where aa.id_barang='$idbrg' and bb.id_cabang='$idcabang' and bb.isactive=1 group by aa.id_barang")->row()->jml;
            $jml_mutasi_penambah = @$this->db->query("select sum(aa.qty) as jml from mutasi_d as aa 
            inner join mutasi_h as bb on aa.id_mutasi=bb.id 
            where aa.id_barang='$idbrg' and ke='$idcabang ' group by id_barang")->row()->jml;
            // wfDebug([]);
            $jml_mutasi_pengurang= @$this->db->query("select sum(aa.qty) as jml from mutasi_d as aa 
            inner join mutasi_h as bb on aa.id_mutasi=bb.id 
            where aa.id_barang='$idbrg' and dari='$idcabang ' group by id_barang")->row()->jml;
        // $selisih_so = @$this->db->query("select sum(aa.qty_selisih) as jml from so_d as aa 
        // inner join so_h as bb on aa.id_so=bb.id where aa.id_barang='$idbrg' and bb.isactive=1")->row()->jml;
        // $selisih_so=0;

        $jml_jual_bpjs = @$this->db->query("select sum(qty) as jml from tagihan_bpjs where id_barang='$idbrg'")->row()->jml;
            $x= intval($jml_sawal) + intval($jml_beli) - intval($jml_jual) + intval($jml_mutasi_penambah) - intval($jml_mutasi_pengurang);
            if(getSession('id_cabang')=='WR001'){
                $x= $x-$jml_jual_bpjs;
            }
                $data[$k]->stock=$x;
            }
        // wfDebug($current);
        // $data = $current->result_array();
        header('Content-Type: application/json');
        echo json_encode(compact(['total', 'page', 'limit', 'data', 'q']));
    }

    private function queryList(&$total, &$current, $page, $limit, $q, $arr_where)
    {
        $total = $this->db->from($this->m->table . " aa")
            ->like('aa.nama', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->join('m_group bb', 'aa.id_group1=bb.id')
            ->join('m_group_d cc', 'aa.id_group2=cc.id')
            ->join('m_group_d2 dd', 'aa.id_group3=dd.id')
            ->count_all_results();
        $current = $this->db->select(",bb.*,aa.*,bb.nama as nm_group1, cc.harga_jual,IFNULL(aa.qty_sawal,0) as qty_sawal,
        IFNULL(aa.qty_sawal_cabang2,0) as qty_sawal_cabang2")
            ->from($this->m->table . " aa")
            ->like('aa.nama', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->join('m_group bb', 'aa.id_group1=bb.id', 'left')
            ->join('m_harga cc', 'aa.id=cc.id_barang', 'left')
            ->where("cc.id_barang=aa.id and cc.id_satuan=aa.id_satuan and cc.jenis_customer='UMUM'")
            ->limit($limit, ($page * $limit) - $limit)->order_by("aa." . $this->m->id, $this->m->order)->get();
    }

    public function lookup()
    {
        if ($this->input->get('q')) {
            $q = $this->input->get('q');
        } else {
            $q = $this->input->get('x');
        }
        $jenis    = $this->input->get('jenis');
        $order_by = $this->input->get('order_by');
        $start    = $this->input->get('start');
        $limit    = $this->input->get('limit');
        $limit    = @$limit == 0 ? 10 : $limit;
        //REPLACE(nama,'\'','_') as nama,
        $this->db->from($this->m->table . " aa");
        $this->db->group_start();
        $this->db->like('aa.nama', $q);
        $this->db->group_end();
        $this->db->where('aa.isactive', '1');
        // $this->db->where('aa.is_jual  <>', 'N');
        if ($jenis == 'BPJS') {
            $this->db->where('tipe', 'BPJS');
        } else {
            $this->db->where('tipe!=', 'BPJS');
        }
        $total = $this->db->count_all_results();

        $this->db->select("aa.id,
        REPLACE(nama,'\'','') as nama,barcode,tipe,harga_beli,
        (select FORMAT(harga_jual,0) from m_harga where aa.id=id_barang and aa.id_satuan=id_satuan and '$jenis'=jenis_customer limit 1) as harga_jual,id_satuan");
        $this->db->from($this->m->table . " aa");
        $this->db->group_start();
        $this->db->like('aa.nama', $q);
        $this->db->group_end();
        $this->db->where('aa.isactive', '1');
        // $this->db->where_in('aa.is_jual', ['Y',NULL]);
        if ($jenis == 'BPJS') {
            $this->db->where('tipe', 'BPJS');
        } else {
            $this->db->where('tipe!=', 'BPJS');
        }
        // $this->db->join('m_konversi bb', 'aa.id_satuan=bb.satuan_konversi', 'LEFT');
        $current = $this->db->limit($limit, $start)->get();
        $data    = $current->result_array();
        // die($this->db->last_query());
        $this->load->view('backend/lookup', compact(['start', 'total', 'limit', 'data', 'q']));
    }

    public function save()
    {
        $req = json_decode(file_get_contents('php://input'));
        $h   = $req->h;
        $hj  = $req->hj;
        $f   = $req->f;
        $d   = @$req->kvr;

        // wfDebug($hj);
        $arr = [];
        foreach ($this->m->getFields() as $k => $v) {
            $arr[$v] = @$h->$v;
        }
        $arr['isactive'] = 1;
        if ($f->crud == 'c') {
            $arr['tipe']       = 'UMUM';
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['created_by'] = $this->session->userdata('username');
            $this->db->insert($this->m->table, $arr);
            $newidbarang = $this->db->insert_id();
            if ($d) {
                $this->saveKonversi($newidbarang, $d); //konversi satuan
            }
            if ($hj) {
                $this->saveHarga($newidbarang, $hj); //harga percustomer
            }
        } else {
            $arr['updated_at'] = date("Y-m-d H:i:s");
            $arr['updated_by'] = $this->session->userdata('username');
            $this->db->replace($this->m->table, $arr);
            // wfDebug($hj);
            if ($d) {
                $this->saveKonversi($h->id, $d);
            }
            if ($hj) {
                $this->saveHarga($h->id, $hj);
            }
        }
        header('Content-Type: application/json');
        echo json_encode('Simpan data berhasil');
    }

    public function saveRow()
    {
        $req = json_decode(file_get_contents('php://input'));
        $id  = $req->id;
        $val = $req->val;
        if(getSession('id_cabang')=="WR001"){
            $res = $this->db->where('id', $id)->update($this->m->table, ['qty_sawal' => $val]);
        }else {
            $res = $this->db->where('id', $id)->update($this->m->table, ['qty_sawal_cabang2' => $val]);
        }
        header('Content-Type: application/json');
        echo json_encode("data qty awal $id terisi $val");
    }

    private function saveHarga($id, $hj)
    {
        $this->db->query("delete from m_harga where id_barang=" . $id . " and id_cabang='" . getSession('id_cabang') . "'");
        foreach ($hj as $k1 => $v1) {
            // wfDebug($v1);
            foreach ($v1 as $k => $v) {
                // wfDebug($id);
                // die($v);
                $arr['id_cabang']      = getSession('id_cabang');
                $arr['id_barang']      = $id;
                $arr['id_satuan']      = $k1;
                $arr['jenis_customer'] = $k;
                $arr['harga_jual']     = $v->rp;
                $arr['harga_jual_prc'] = $v->prc;
                $arr['isactive']       = 1;
                // wfDebug($arr);
                $this->db->insert($this->hrg->table, $arr);
            }
        }
    }

    private function saveKonversi($id, $d)
    {
        // wfDebug($d);
        $this->db->query("delete from m_konversi where id_barang=" . $id);
        foreach ($d as $k1 => $v1) {
            foreach ($this->kvr->getFields() as $k => $v) {
                $arr[$v] = @$v1->$v;
            }
            $arr['id_barang'] = $id;
            $this->db->insert($this->kvr->table, $arr);
        }
    }

    public function read($id)
    {
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $h    = $data->row();
        $kvr  = $this->db->select("*,satuan_konversi as nm_satuan_konversi")->get_where('m_konversi', ['id_barang' => $id, 'isactive' => 1])->result(); //konversi
        // $hrg  = $this->db->get_where('m_harga', ['id_barang' => $id, 'id_cabang' => getSession('cabang'), 'isactive' => 1])->result(); //harga
        //semua harga di tiap cabang sama, jadi tidak perlu where idcabang
        $dthj = $this->db->get_where('m_harga', ['id_barang' => $id, 'isactive' => 1])->result(); //harga
        // $hj=diconvert ben sesuai susunan array hj;
        // wfDebug($dthj);
        $arr_satuan = [$h->id_satuan];
        foreach ($kvr as $k => $v) {
            $arr_satuan[] = $v->satuan_konversi;
        }
        $hj = [];
        foreach ($dthj as $k => $v) {
            $sat = $v->id_satuan;
            if (in_array($sat, $arr_satuan)) {
                $cus                   = $v->jenis_customer;
                $hj[$sat][$cus]['rp']  = $v->harga_jual;
                $hj[$sat][$cus]['prc'] = $v->harga_jual_prc;
            }
        }
        // wfDebug($hj);
        $cus          = $this->db->get_where('m_customer_jns', ['isactive' => 1])->result();
        $h->nm_group1 = @$this->db->get_where("m_group", ['id' => $h->id_group1])->row()->nama;
        $h->nm_group2 = @$this->db->get_where("m_group_d", ['id' => $h->id_group2])->row()->nama;
        $h->nm_group3 = @$this->db->get_where("m_group_d2", ['id' => $h->id_group3])->row()->nama;
        $h->nm_satuan = @$this->db->get_where("m_satuan", ['id' => $h->id_satuan])->row()->nama_satuan;

        header('Content-Type: application/json');
        echo json_encode(compact(['h', 'hj', 'cus', 'kvr']));
    }

    public function validasi()
    {
        $req = json_decode(file_get_contents('php://input'));
        $h   = $req->h;
        header('Content-Type: application/json');
        if (count($this->db->get_where('m_barang', ['barcode' => $h->barcode])->result()) > 0 && $h->barcode != "") {
            echo json_encode('Barcode sudah digunakan produk lain.');
        } else {
            echo json_encode('');
        }
    }

    public function hasTransaction()
    {
        $req = json_decode(file_get_contents('php://input'));
        $h   = $req->h;
        header('Content-Type: application/json');
        $jmltransaksi = $this->db->get_where('jual_d', ['id_barang' => $h->id])->num_rows();
        echo json_encode($jmltransaksi);
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
            'content' => 'backend/m_barang/m_barang_print',
        );
        $this->load->view('layout_print', $data);
    }

    public function importBpjs()
    {
        $awm  = $this->load->database('waringin_desktop', true);
        $data = $awm->get_where('barang_bpjs', [1 => 1])->result();
        foreach ($data as $k => $v) {
            $arr['nama'] = $v->nama_bpjs;
            $arr['tipe'] = 'BPJS';

            $arr['created_by'] = getSession('username');
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['isactive']   = 1;
            $this->db->insert($this->m->table, $arr);
        }
        echo "import data barang BPJS berhasil";
    }
    public function import()
    {
        /*
         * harga_bl1=UMUM
         * harga_bl2=RESEP
         * harga_bl3=MK
         */
        $awm  = $this->load->database('waringin_desktop', true);
        $data = $awm->get('barang')->result();
        foreach ($data as $k => $v) {
            $arr['nama']       = $v->barang_nm;
            $arr['tipe']       = 'UMUM';
            $arr['barcode']    = $v->barcode;
            $arr['id_satuan']  = $v->stn3; //get satuan terkecil
            $arr['harga_beli'] = $v->harga_bl3;
            $arr['created_by'] = getSession('username');
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['isactive']   = 1;
            $this->db->insert($this->m->table, $arr);
            $idbrg = $this->db->insert_id();
            //insert to table: m_satuan
            $this->insertIfSatuanNotExist($v->stn1);
            $this->insertIfSatuanNotExist($v->stn2);
            $this->insertIfSatuanNotExist($v->stn3);

            //insert to table: m_harga
            //umum
            $this->insertHarga($idbrg, $v->stn1, $v->harga_jl1, 'UMUM');
            $this->insertHarga($idbrg, $v->stn3, $v->harga_jl3, 'UMUM'); //urutan prioritas harga 3 dibanding harga 2
            $this->insertHarga($idbrg, $v->stn2, $v->harga_jl2, 'UMUM');
            //resep
            $this->insertHarga($idbrg, $v->stn1, $v->harga_jl1B, 'RESEP');
            $this->insertHarga($idbrg, $v->stn3, $v->harga_jl3B, 'RESEP');
            $this->insertHarga($idbrg, $v->stn2, $v->harga_jl2B, 'RESEP');
            //mk
            $this->insertHarga($idbrg, $v->stn1, $v->harga_jl1D, 'MK');
            $this->insertHarga($idbrg, $v->stn3, $v->harga_jl3D, 'MK');
            $this->insertHarga($idbrg, $v->stn2, $v->harga_jl2D, 'MK');
            //insert to table: m_konversi
            $this->insertKonversi($idbrg, $v->stn1, $v->isi1);
            $this->insertKonversi($idbrg, $v->stn2, $v->isi2);
            $this->insertKonversi($idbrg, $v->stn3, $v->isi3);
        }
        echo "import data barang berhasil";
    }

    private function insertIfSatuanNotExist($stn)
    {
        //insert tabel: m_satuan
        if ($this->db->get_where("m_satuan", ['id' => $stn])->num_rows() == 0) {
            $this->db->insert('m_satuan', ['id' => $stn, 'nama_satuan' => $stn, 'simbol' => $stn, 'isactive' => 1]);
            return true;
        }
        return false;
    }

    private function insertHarga($idBarang, $stn, $hrgJual, $jns)
    {
        if ($this->db->get_where("m_harga", ['id_cabang' => getSession('id_cabang'), 'id_barang' => $idBarang, 'id_satuan' => $stn, 'jenis_customer' => $jns, 'isactive' => 1])->num_rows() == 0) {
            $this->db->insert('m_harga', ['id_cabang' => getSession('id_cabang'), 'id_barang' => $idBarang, 'id_satuan' => $stn, 'jenis_customer' => $jns, 'harga_jual' => $hrgJual, 'isactive' => 1]);
            return true;
        }
        return false;
    }

    private function insertKonversi($idBarang, $stn, $qty)
    {
        if ($this->db->get_where("m_konversi", ['id_barang' => $idBarang, 'satuan_konversi' => $stn, 'isactive' => 1])->num_rows() == 0) {
            $this->db->insert('m_konversi', ['id_barang' => $idBarang, 'satuan_konversi' => $stn, 'qty_konversi' => $qty, 'isactive' => 1]);
            return true;
        }
    }

    public function buatbaris()
    {
        for ($i = 1; $i < 4569; $i++) {
            $this->db->insert('barang', ['id' => $i]);
        }
    }
}