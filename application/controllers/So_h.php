<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
// include APPPATH . 'third_party/phpspreadsheet/vendor/autoload.php';
// use PhpSpreadsheet\Spreadsheet;
// use PhpSpreadsheet\Writer\Xlsx;
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class So_h extends CI_Controller
{
    private $m;
    private $m_d1;
    public function __construct()
    {
        parent::__construct();
        is_logged();
        $this->load->model('So_h_model');
        $this->load->model('So_d_model');
        $this->m    = new So_h_model();
        $this->m_d1 = new So_d_model();
    }

    public function index()
    {
        $data = array(
            'content' => "backend/so_h/so_h_frm",
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

        $this->queryList($total, $current, $page, $limit, $q, ['isactive' => 1, 'id_cabang' => getSession('id_cabang')]);

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

        $arr = [];
        foreach ($this->m->getFields() as $k => $v) {
            $arr[$v] = @$h->$v;
        }
        $arr['isactive'] = 1;
        if ($f->crud == 'c') {
            $arr['id']         = getAutoNumber('so_h', 'id', 'SO-', '8');
            $arr['id_cabang']  = getSession('id_cabang');
            $arr['created_at'] = date("Y-m-d H:i:s");
            $arr['created_by'] = $this->session->userdata('username');
            $arr['isactive'] = 1;
            $this->db->insert($this->m->table, $arr);
            $idh=$this->db->order_by('id','desc')->get_where($this->m->table,['isactive'=>1])->row()->id;
            if ($d) {
                $this->saveD1($idh, $d);
            }
        } else {
            $arr['updated_at'] = date("Y-m-d H:i:s");
            $arr['updated_by'] = $this->session->userdata('username');
            $arr['isactive'] = 1;
            $this->db->replace($this->m->table, $arr);
            if ($d) {
                $this->saveD1($h->id, $d);
            }
        }
        header('Content-Type: application/json');
        echo json_encode('Simpan data berhasil');
    }

    private function saveD1($id, $d)
    {
        $this->db->where(['id_so'=>$id])->delete($this->m_d1->table);
        foreach ($d as $k1 => $v1) {
            foreach ($this->m_d1->getFields() as $k => $v) {
                $arr[$v] = @$v1->$v;
            }
            $arr['id_so'] = $id;
            $this->db->insert($this->m_d1->table, $arr);
        }
    }

    
    public function read($id)
    {
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $h    = $data->row();
        $d    = $this->db->get_where($this->m_d1->table, ['id_so' => $h->id])->result();
        foreach ($d as $k => $v) {
            $d[$k]->nm_barang    = @$this->db->get_where("m_barang", ['id' => $v->id_barang])->row()->nama;
            $d[$k]->harga_satuan = @$this->db->get_where("m_barang", ['id' => $v->id_barang])->row()->harga_beli;
        }
        header('Content-Type: application/json');
        echo json_encode(compact(['h', 'd']));
    }

    public function delete($id)
    {
        $this->db->where($this->m->id, $id);
        $this->db->update($this->m->table, ['isactive' => 0]);
        $this->db->where(['id_so' => $id])->delete('so_d');
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
            'content' => 'backend/so_h/so_h_print',
        );
        $this->load->view('layout_print', $data);
    }

    // public function getStock($idbrg)
    // {
    //     $jml_sawal = $this->db->get_where('m_barang', ['id' => $idbrg, 'isactive' => 1])->row()->qty_sawal;
    //     $jml_beli  = @$this->db->select("sum(qty_entry) as jml")->group_by('id_barang')
    //     ->get_where('beli_d', ['id_barang' => $idbrg, 'isactive' => 1])->row()->jml;
    //     $jml_jual  = @$this->db->select("sum(qty_entry) as jml")->group_by('id_barang')
    //     ->get_where('jual_d', ['id_barang' => $idbrg, 'isactive' => 1])->row()->jml;
    //     $jml_mutasi_penambah  = @$this->db->select("sum(aa.qty) as jml")->join("mutasi_h bb","aa.id_mutasi=bb.id")
    //     ->group_by('aa.id_barang')->get_where('mutasi_d as aa', ['ke'=>getSession('id_cabang'),'aa.id_barang' => $idbrg])
    //     ->row()->jml;
    //     $jml_mutasi_pengurang  = @$this->db->select("sum(aa.qty) as jml")->join("mutasi_h bb","aa.id_mutasi=bb.id")
    //     ->group_by('aa.id_barang')->get_where('mutasi_d as aa', ['dari'=>getSession('id_cabang'),'aa.id_barang' => $idbrg])
    //     ->row()->jml;
    //     $selisih_so=$this->db->select("sum(aa.qty_selisih) as jml")->join('so_h bb','aa.id_so=bb.id')
    //     ->group_by('aa.id_barang')->get_where('so_d as aa',['aa.id_barang'=>$idbrg,'bb.isactive'=>1])->row()->jml;
    //     // die("qty saldo awal:".$jml_sawal ."<br>Jml beli: ". $jml_beli  ."<br>Jml Jual: ".  $jml_jual ."<br>Mutasi masuk: ". $jml_mutasi_penambah ."<br> Mutasi keluar: ". $jml_mutasi_pengurang."<br>selisih so:".$selisih_so);
    //     $x= $jml_sawal + $jml_beli - $jml_jual+$jml_mutasi_penambah-$jml_mutasi_pengurang;
    //     header('Content-Type: application/json');
    //     echo json_encode(['qty_stock'=>$x]);
    // }

    
    public function cetak(){
        
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Jenis Gangguan')
                    ->setCellValue('C1', 'Nama Gangguan')
                    ->setCellValue('D1', 'Mulai')
                    ->setCellValue('E1', 'Selesai')
                    ->setCellValue('F1', 'Regu')
                    ->setCellValue('G1', 'Keterangan')
                    ->setCellValue('H1', 'HBS');
        $column = 2;
        foreach($res as $k=> $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, ($k+1))
                        ->setCellValue('B' . $column, $data->jenis)
                        ->setCellValue('C' . $column, $data->gangguan)
                        ->setCellValue('D' . $column, $data->time_from)
                        ->setCellValue('E' . $column, $data->time_to)
                        ->setCellValue('F' . $column, $data->regu)
                        ->setCellValue('G' . $column, $data->keterangan)
                        ->setCellValue('H' . $column, $data->hbs);
            $column++;
        }
        $filename = "HBS Harian ".$tgl.".xlsx";
        $fullpath = "exportlaporan/".$filename;
        $writer = new Xlsx($spreadsheet);
        $writer->save($fullpath);
        return $this->response->download($fullpath, null)->setFileName($filename);
    }
    
     public function getStock($idbrg)
    {
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
        $selisih_so=0;
        $x= intval($jml_sawal) + intval($jml_beli) - intval($jml_jual) + intval($jml_mutasi_penambah) - intval($jml_mutasi_pengurang);
        echo "<br><pre>";
        print_r($brg);
            die("qty saldo awal:".$jml_sawal ."<br>Jml beli: ". $jml_beli  ."<br>Jml Jual: ". 
             $jml_jual ."<br>Mutasi masuk: ". $jml_mutasi_penambah ."<br> Mutasi keluar: ". 
             $jml_mutasi_pengurang."<br>selisih so:belum dihitung<br>stock akhir:".$x);
        header('Content-Type: application/json');
        echo json_encode(['qty_stock'=>$x]);
    }


    public function insertToNew(){
        //$this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $sod = $this->db->query("SELECT MIN(aa.id_so) as id_so,
        aa.id_barang,aa.`harga`,SUM(aa.`qty_fisik`) AS qty_fisik FROM so_d aa INNER JOIN so_h AS bb ON bb.id=aa.id_so 
        WHERE bb.isactive=1 AND aa.`id_barang` IS NOT NULL GROUP BY aa.id_barang,aa.harga")->result();
        foreach ($sod as $k => $v) {
            $d=[
                'id_so'=>$v->id_so,
                'id_barang'=>$v->id_barang,
                'qty_fisik'=>$v->qty_fisik,
                'harga'=>$v->harga,
                'isactive'=>1,
            ];
            $dataD[]=$d;
        }
        // wfDebug($dataD);
        $this->db->insert_batch('so_d_new',$dataD);
        die('selesai');

    }

    
}