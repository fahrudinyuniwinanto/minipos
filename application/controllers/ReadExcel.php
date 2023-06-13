<?php
require FCPATH . 'application/third_party/phpspreadsheet/vendor/autoload.php';
// echo BASEPATH.'third_party/vendor/autoload.php';die();
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReadExcel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library(array('PHPExcel','session'));
    }

    public function index()
    {
        //$this->load->view(layout(),'backend/phpexcel.php');
    }

    public function importBpjs()
    {
        $class_name    = $this->router->fetch_class();
        $function_name = $this->router->fetch_method();

        $reader           = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet      = $reader->load($_FILES['tagihanbpjs']['tmp_name']);
        $d                = $spreadsheet->getSheet(0)->toArray();
        $data             = $spreadsheet->getActiveSheet()->toArray();
        $jmlDataTerinsert = 0;
        // wfDebug($data);
        $no_fpk=$data[16][8];
        unset($data[0]);
        unset($data[1]);
        unset($data[2]);
        unset($data[3]);
        unset($data[4]);
        unset($data[5]);
        unset($data[6]);
        unset($data[7]);
        unset($data[8]);
        unset($data[9]);
        unset($data[10]);
        unset($data[11]);
        unset($data[12]);
        unset($data[13]);
        unset($data[14]);
        unset($data[15]);
        unset($data[16]);
        unset($data[17]);
        unset($data[18]);
        foreach ($data as $k => $v) {
            $tgl="";
            $tgl_pelayanan="";
            $tgl = substr($v[18],3,2)."/".substr($v[18],0,2)."/".substr($v[18],6,4);
        $tgl_pelayanan = date_format(date_create($tgl), "Y-m-d");
        // die($tgl_pelayanan);
            $this->db->insert('tagihan_bpjs', [
                'no_fpk'            => $no_fpk,
                'ref_asal'          => $v[3],
                'jenis'             => "PRB",
                'no_kartu'          => $v[15],
                'no_resep'          => $v[16],
                'tgl_pelayanan'     => $tgl_pelayanan,
                // 'obat'              => $v[19],
                'qty'               => $v[21],
                'tagihan'           => str_replace(",","",$v[22]),
                'qty_disetujui'     => $v[25],
                'tagihan_disetujui' => str_replace(",","",$v[27]),
                'keterangan'        => $v[28],
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => $this->session->userdata('username'),
                'isactive'          => 1,
                'id_barang'          => $v[33],
            ]);
            $jmlDataTerinsert++;
        }
        $this->session->set_flashdata('message', '<i class=" fa fa-check-circle"></i> <strong>' . $jmlDataTerinsert . ' data tagihan BPJS</strong> berhasil diimport ke sql!');
        redirect($_SERVER['HTTP_REFERER']); //redirect back
    }

    public function truncateBpjs(){
        $this->db->truncate('tagihan_bpjs');
        redirect('tagihan_bpjs');
    }
}