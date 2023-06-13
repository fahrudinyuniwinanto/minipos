<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Piutang_h extends CI_Controller
{
    private $m;
    function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model("Piutang_h_model");
        $this->load->model('Piutang_d_model');
        $this->load->model('M_customer_model');
        $this->m = new Piutang_h_model();
        $this->hutang_d = new Piutang_d_model();
        $this->customer = new M_customer_model();
    }

    public function index()
    {
        $data = [
            "content" => "backend/piutang_h/piutang_h_frm",
        ];
        $this->load->view(layout(), $data);
    }

    public function getList()
    {
        $frm = $this->input->get("frm");
        $q = $this->input->get("q");
        $order_by = $this->input->get("order_by");
        $page = $this->input->get("page");
        $limit = $this->input->get("limit");
        $limit = @$limit == 0 ? 10 : $limit;

        $this->queryList($total, $current, $page, $limit, $q, [
            "aa.isactive" => 1,
        ]);

        $data = $current->result_array();
        header("Content-Type: application/json");
        echo json_encode(compact(["total", "page", "limit", "data", "q"]));
    }

    private function queryList(
        &$total,
        &$current,
        $page,
        $limit,
        $q,
        $arr_where
    ) {
        $total = $this->db->from($this->m->table." aa")
        ->group_start()
        ->where($arr_where)
        ->group_end()
        ->like('bb.nama',$q)
        ->join($this->customer->table." bb","aa.id_dokter=bb.id")
        ->count_all_results();
        $current = $this->db->from($this->m->table." aa")
        ->select("aa.*,aa.id as id,aa.jenis_pembayaran as jenis, bb.id as id_dokter,bb.nama as dokter,bb.alamat")
        ->like('bb.nama',$q)
        ->group_start()
        ->where($arr_where)
        ->group_end()
        ->join($this->customer->table." bb","aa.id_dokter=bb.id")
        ->limit($limit, ($page * $limit) - $limit)
        ->order_by($this->m->id, $this->m->order)
        ->get();
    }

    public function lookup()
    {
        $q = $this->input->get("q");
        $order_by = $this->input->get("order_by");
        $start = $this->input->get("start");
        $limit = $this->input->get("limit");
        $limit = @$limit == 0 ? 10 : $limit;

        $total = $this->db
            ->from($this->m->table)
            ->like("id", $q)
            ->count_all_results();
        $current = $this->db
            ->from($this->m->table)
            ->like("id", $q)
            ->limit($limit, $start)
            ->get();
        $data = $current->result_array();
        $this->load->view(
            "backend/lookup",
            compact(["start", "total", "limit", "data", "q"])
        );
    }

    public function save()
    {
        $req = json_decode(file_get_contents("php://input"));
        $h = $req->h;
        $d = $req->d;
        $f = $req->f;

        $arr = [];
        foreach ($this->m->getFields() as $k => $v) {
            $arr[$v] = @$h->$v;
        }
        $arr["isactive"] = 1;
        if ($f->crud == "c") {
            $arr["created_at"] = date("Y-m-d H:i:s");
            $arr["created_by"] = $this->session->userdata("username");
            $arr['id_cabang']=getSession('id_cabang');
            $this->db->insert($this->m->table, $arr);
            $h->id = $this->db->insert_id();
            if ($d) {
                $this->savePiutangD($h, $d);
            }
        } else {
            $arr["updated_at"] = date("Y-m-d H:i:s");
            $arr["updated_by"] = $this->session->userdata("username");
            $this->db->replace($this->m->table, $arr);
        }
        header("Content-Type: application/json");
        echo json_encode("Simpan data berhasil");
    }

    
    private function savePiutangD($h,$d){
        // wfDebug($d);
        foreach ($d as $k => $v) {
            $x=[
                'id_piutang'=>$h->id,
                'id_jual'=>$v->id_jual,
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
        $data       = $this->db->where($this->m->id, $id)->get($this->m->table, 0, 1);
        $h          = $data->row();
        $field_cust=$h->jenis_pembayaran=='MK'?'id_customer':'dokter_perujuk';
        $dokter=$this->db->get_where("m_customer",['id'=>$h->id_dokter])->row();
        $h->dokter=$dokter->nama;
        $h->alamat=$dokter->alamat;
        $h->id_dokter=$dokter->id;
        $h->dana=$h->jumlah_bayar;
        $h->shift=getSession('shift');
        $h->sisa=intVal($h->dana-$h->jumlah_bayar);
        $d=$this->db->query("SELECT aa.*,aa.id as id_jual,tp.alokasi as alokasi,
        aa.total-aa.dp-aa.jumlah_kembali AS total,
        aa.total-aa.dp-aa.jumlah_kembali-IFNULL(tp.alokasi,0)  -IFNULL(tp.`potongan_rp`,0)-IFNULL(tp.`pembulatan_rp`,0)+IFNULL(tp.`tambah_rp`,0) AS hutang,
        IFNULL(tp.alokasi,0)-IFNULL(tp.`potongan_rp`,0)-IFNULL(tp.`pembulatan_rp`,0)+IFNULL(tp.`tambah_rp`,0) AS angsuran
 FROM jual_h AS aa 
         LEFT JOIN (
         SELECT id_jual,SUM(IFNULL(alokasi,0)) AS alokasi,
         SUM(IFNULL(potongan_rp,0)) AS potongan_rp, 
         SUM(IFNULL(pembulatan_rp,0)) AS pembulatan_rp, 
         SUM(IFNULL(tambah_rp,0)) AS tambah_rp 
         FROM  piutang_d AS bb  
         INNER JOIN piutang_h AS cc ON cc.id=bb.`id_piutang` 
         WHERE cc.isactive=1 AND cc.id_dokter='$h->id_dokter' and cc.jenis_pembayaran='$h->jenis_pembayaran' and cc.id='$id'
         GROUP BY id_jual
         ) tp ON aa.id=tp.id_jual
         WHERE aa.$field_cust='$h->id_dokter'
         HAVING ROUND(FLOOR(alokasi))>0
         order by aa.tanggal asc")->result();
        header('Content-Type: application/json');
        echo json_encode(compact(['h','d']));
    }
    public function readByIdDokter($iddokter,$jenis)
    {
        $field_cust=$jenis=='MK'?'id_customer':'dokter_perujuk';//jika mk yg bayar id_customer, jika dokel yg bayar dokter perujuknya
        $h=$this->db->get_where("m_customer",['id'=>$iddokter])->row();
        $h->dokter=$h->nama;
        $h->shift=getSession('shift');
        $h->id="";//id digunakan utk id_hutang
        $d=$this->db->query("SELECT aa.*,aa.no_trs,aa.id as id_jual,
       aa.total-aa.dp AS total,
        aa.total-aa.dp-IFNULL(tp.alokasi,0)  -IFNULL(tp.`potongan_rp`,0)-IFNULL(tp.`pembulatan_rp`,0)+IFNULL(tp.`tambah_rp`,0) AS hutang,
        IFNULL(tp.alokasi,0)-IFNULL(tp.`potongan_rp`,0)-IFNULL(tp.`pembulatan_rp`,0)+IFNULL(tp.`tambah_rp`,0) AS angsuran
 FROM jual_h AS aa 
         LEFT JOIN (
         SELECT id_jual,SUM(IFNULL(alokasi,0)) AS alokasi,
         SUM(IFNULL(potongan_rp,0)) AS potongan_rp, 
         SUM(IFNULL(pembulatan_rp,0)) AS pembulatan_rp, 
         SUM(IFNULL(tambah_rp,0)) AS tambah_rp 
         FROM  piutang_d AS bb  
         INNER JOIN piutang_h AS cc ON cc.id=bb.`id_piutang` 
         WHERE cc.isactive=1 AND cc.id_dokter='$iddokter' and cc.jenis_pembayaran='$jenis'
         GROUP BY id_jual
         ) tp ON aa.id=tp.id_jual
         WHERE aa.$field_cust='$iddokter'
         HAVING ROUND(FLOOR(hutang))>0
         order by aa.tanggal asc
         ")->result();
        //  die($this->db->last_query());
        //  wfDebug($d);
                foreach ($d as $k => $v) {
                    $d[$k]->allow_pay=null;
                    $d[$k]->alokasi=0;
                    $d[$k]->potongan_rp=0;
                    $d[$k]->pembulatan_rp=0;
                    $d[$k]->tambah_rp=0;
                }
                $h->jenis_pembayaran=$jenis;
                $h->id_dokter=$iddokter;
        header('Content-Type: application/json');
        echo json_encode(compact(['h','d']));
    }

    public function delete($id)
    {
        $this->db->where($this->m->id, $id);
        $this->db->update($this->m->table, ["isactive" => 0]);
        header("Content-Type: application/json");
        echo json_encode("Hapus data berhasil");
    }

    public function prin()
    {
        $id = $this->input->get("id", true);
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $data = [
            "h" => $data->row(),
            "content" => "backend/piutang_h/piutang_h_print",
        ];
        $this->load->view("layout_print", $data);
    }
}