<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Laporan extends CI_Controller
{
    private $barang;
    private $beliH;
    private $jualH;
    public function __construct()
    {
        parent::__construct();
        is_logged();
        // sf_construct();
        $this->load->model('M_barang_model');
        $this->load->model('Beli_h_model');
        $this->load->model('Jual_h_model');
        $this->barang = new M_barang_model();
        $this->beliH  = new Beli_h_model();
        $this->jualH  = new Jual_h_model();
    }

    public function index()
    {
        echo "Pilih menu laporan";
    }

    public function laporanStock()
    {
        $data = array(
            'content' => "backend/laporan/stock/stock_rpt",
        );
        $this->load->view(layout(), $data);
    }

    public function laporanPenjualanDetil()
    {
        $data = array(
            'content' => "backend/laporan/penjualan/penjualan_detil_rpt",
        );
        $this->load->view(layout(), $data);
    }

    public function laporanPembelian()
    {
        $data = array(
            'content' => "backend/laporan/pembelian/pembelian_rpt",
        );
        $this->load->view(layout(), $data);
    }


    public function laporanPenjualan()
    {
        $data = array(
            'content' => "backend/laporan/penjualan/penjualan_rpt",
        );
        $this->load->view(layout(), $data);
    }

    public function laporanMutasi()
    {
        $data = array(
            'content' => "backend/laporan/mutasi/mutasi_bulanan_rpt",
        );
        $this->load->view(layout(), $data);
    }

    public function laporanSo()
    {
        $data = array(
            'content' => "backend/laporan/so/so_rpt",
        );
        $this->load->view(layout(), $data);
    }

    public function laporanKasKeluar()
    {
        $data = array(
            'content' => "backend/laporan/kas_keluar/kas_keluar_rpt",
        );
        $this->load->view(layout(), $data);
    }

    public function laporanJual()
    {
        $data = array(
            'content' => "backend/jual_h/jual_h_rpt",
        );
        $this->load->view(layout(), $data);
    }
    public function laporanBarang()
    {
        $data = array(
            'content' => "backend/laporan/barang/barang_rpt",
        );
        $this->load->view(layout(), $data);
    }
    public function laporanOmset()
    {
        $data = array(
            'content' => "backend/laporan/omset/omset_rpt",
        );
        $this->load->view(layout(), $data);
    }

    public function prinStock()
    {
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");
        $date2 = $this->input->get("date2");
        $y     = date("Y", strtotime($date1));
        $bulan = $this->input->get("bulan");
        $tahun = $this->input->get("tahun");
        $pilihan = $this->input->get("pilihan");
        $cabang = $this->input->get("cabang");
        $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $where = "";
        $header = "";


        if ($pilihan == "tanggal") {
            // $where = "and jh.tanggal between '$date1' AND '$date2'";
            $header = "Tanggal " . ($date1) . " s.d. " . ($date2);
        } elseif ($pilihan == "bulan") {
            $where = "and month(tanggal) = '$bulan' and year(tanggal) = '$tahun'";
            $header = "Bulan " . $bln[$bulan - 1] . " Tahun $tahun";
        } else {
            $where = "and year(tanggal) = '$tahun'";
            $header = "Tahun $tahun";
        }
        if ($cabang == 'WR001') {
            $where2 = " and qty_sawal>0";
        } else {
            $where2 = " and qty_sawal_cabang2>0";
        }

        $h = $this->db->query("select mb.barcode,mb.id, mb.nama, mb.tipe,
        IFNULL(case when '$cabang' = 'WR001' then mb.qty_sawal else qty_sawal_cabang2 end,0) as qty_sawal,
        ifnull(
            (select sum(jd.qty_entry) from jual_d jd
            left join jual_h jh on jh.id = jd.id_penjualan
            where jd.id_barang = mb.id 
            and jh.isactive=1 
            and id_cabang='$cabang'
            $where),0) as jual,
        ifnull(
            (select sum(qty) from tagihan_bpjs
            $where),0) as jual_bpjs,

        ifnull((select sum(md.qty) from mutasi_d md 
            left join mutasi_h mh on md.id_mutasi = mh.id 
            where md.id_barang = mb.id and mh.dari = '$cabang' 
            $where),0) as mutasi_out,
        ifnull(
            (select sum(jd.qty_entry) from beli_d jd
            left join beli_h jh on jh.id = jd.id_pembelian
            where jd.id_barang = mb.id 
            and id_cabang='$cabang'
            and jh.isactive=1 
            $where),0) as beli,
        ifnull((select sum(md.qty) from mutasi_d md 
            left join mutasi_h mh on md.id_mutasi = mh.id 
            where md.id_barang = mb.id and mh.ke = '$cabang' 
            $where),0) as mutasi_in
        from m_barang mb where 1=1 $where2")->result();
        // echo $this->db->last_query();
        // die();

        $data = array(
            'h'       => $h,
            'y'       => $y,
            'date1'   => $date1,
            'date2'   => $date2,
            'header'   => $header,
            'content' => 'backend/laporan/stock/stock_prin',
        );
        $this->load->view('layout_print', $data);
    }

    public function prinPenjualanDetil()
    {
        // $id_cabang = getSession('id_cabang');
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");
        $date2 = $this->input->get("date2");
        $y     = date("Y", strtotime($date1));
        $bulan = $this->input->get("bulan");
        $tahun = $this->input->get("tahun");
        $pilihan = $this->input->get("pilihan");
        $cabang = $this->input->get("cabang");
        $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $where = "";
        $header = "";
        if ($pilihan == "tanggal") {
            $where = "and tanggal between '$date1' AND '$date2'";
            $header = "Tanggal " . ($date1) . " s.d. " . ($date2);
        } elseif ($pilihan == "bulan") {
            $where = "and month(tanggal) = '$bulan' and year(tanggal) = '$tahun'";
            $header = "Bulan " . $bln[$bulan - 1] . " Tahun $tahun";
        } else {
            $where = "and year(tanggal) = '$tahun'";
            $header = "Tahun $tahun";
        }

        $h     = $this->db->query("select tanggal,
        no_trs, jenis, shift, id,
        (select nama from m_customer where id=id_customer) as pembeli,
        potongan_persen, potongan_rp
        from jual_h  
        where isactive=1 and id_cabang = '$cabang' $where
        order by id asc
        ")->result();
        // echo $this->db->last_query();die();
        $data = array(
            'h'       => $h,
            'y'       => $y,
            'date1'   => $date1,
            'date2'   => $date2,
            'header'   => $header,
            'content' => 'backend/laporan/penjualan/penjualan_detil_prin',
        );
        // echo $this->db->last_query();
        // die();
        $this->load->view('layout_print', $data);
    }


    public function prinPembelian()
    {
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");
        $y     = date("Y", strtotime($date1));
        $bulan = $this->input->get("bulan");
        $tahun = $this->input->get("tahun");
        $pilihan = $this->input->get("pilihan");
        $cabang = $this->input->get("cabang");
        $jenis = strtoupper($this->input->get("jenis"));

        $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $where = "";
        $header = "";
        if ($pilihan == "tanggal") {
            $where = "and tanggal between '$date1' AND '$date2'";
            $header = "Tanggal " . $date1 . " s.d. " . $date2;
        } elseif ($pilihan == "bulan") {
            $where = "and month(tanggal) = '$bulan' and year(tanggal) = '$tahun'";
            $header = "Bulan " . $bln[$bulan - 1] . " Tahun $tahun";
        } else {
            $where = "and year(tanggal) = '$tahun'";
            $header = "Tahun $tahun";
        }
        $whereJenisCust= $jenis!="ALL"?"and aa.jenis_customer='$jenis' ":"";
        // $this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $h = $this->db->query("
        select aa.*,bb.nama as nama_suplier from beli_h as aa
        INNER join m_supplier as bb
        ON aa.id_suplier=bb.id
        WHERE aa.isactive = 1
        and aa.id_cabang = '$cabang'".
       
       $whereJenisCust.$where."
        order by aa.tanggal desc
        ")->result();
        // echo $this->db->last_query();die();
        // wfDebug([]);
        if ($jenis == 'UMUM') {
            $page = 'backend/laporan/pembelian/umum_prin';
        } elseif ($jenis == 'MK') {
            $page = 'backend/laporan/pembelian/mk_prin';
        } elseif ($jenis == 'RESEP') {
            $page = 'backend/laporan/pembelian/bpjs_prin';
        } elseif ($jenis == 'ALL') {
            $page = 'backend/laporan/pembelian/all_prin';
        } else {
            $page = 'backend/laporan/pembelian/all_prin';
        }

        $data = array(
            'h'       => $h,
            'y'       => $y,
            'date1'   => $date1,
            'date2'   => $date2,
            'header'   => $header,
            'content' => $page,
        );
        // wfDebug($data);
        $this->load->view('layout_print', $data);
    }

    public function prinPenjualan()
    {
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");
        $y     = date("Y", strtotime($date1));
        $bulan = $this->input->get("bulan");
        $tahun = $this->input->get("tahun");
        $pilihan = $this->input->get("pilihan");
        $cabang = $this->input->get("cabang");
        $jenis = strtoupper($this->input->get("jenis"));

        $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $where = "";
        $header = "";
        if ($pilihan == "tanggal") {
            $where = "and tanggal between '$date1' AND '$date2'";
            $header = "Tanggal " . $date1 . " s.d. " . $date2;
        } elseif ($pilihan == "bulan") {
            $where = "and month(tanggal) = '$bulan' and year(tanggal) = '$tahun'";
            $header = "Bulan " . $bln[$bulan - 1] . " Tahun $tahun";
        } else {
            $where = "and year(tanggal) = '$tahun'";
            $header = "Tahun $tahun";
        }
        // $this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");


        $h = $this->db->query("
        SELECT tanggal, shift,
        SUM(bb.total) as totalall,
        SUM(CASE WHEN aa.jenis = 'umum' THEN bb.total ELSE 0 END) AS umum,
        
        (SELECT SUM(IF(jenis='UMUM',potongan_rp, 0)) FROM jual_h  
        WHERE isactive = 1 
        AND id_cabang = '$cabang'
        $where AND shift=aa.shift) AS pot_h_umum,

        (SELECT SUM(IF(is_dokel IS NULL 
        AND jenis='RESEP',potongan_rp, 0)) FROM jual_h  
        WHERE isactive = 1 
        AND id_cabang = '$cabang'
        $where AND shift=aa.shift) AS pot_h_resep,

        (SELECT SUM(IF(is_dokel='1' AND jenis='RESEP',potongan_rp, 0)) FROM jual_h  
        WHERE isactive = 1 
        AND id_cabang = '$cabang'
        $where AND shift=aa.shift) AS pot_h_dokel,
        
        (SELECT SUM(IF(jenis='MK',potongan_rp, 0)) FROM jual_h  
        WHERE isactive = 1 
        AND id_cabang = '$cabang'
        $where AND shift=aa.shift) AS pot_h_mk,

        SUM(IF(aa.is_dokel IS NULL AND aa.jenis='RESEP',bb.total,0)) AS resep,
        SUM(IF(aa.is_dokel='1',IF(aa.jenis='RESEP',bb.total,0),0)) AS dokel,
        SUM(IF(aa.jenis='MK',bb.total,0)) AS mk,
        SUM(IF(aa.jenis='MK',bb.total,0)) as mk_total_piutang,
        (SELECT SUM(xx.alokasi) from piutang_d as xx inner join piutang_h as yy on xx.id_piutang=yy.id where LEFT(yy.tanggal_bayar,10)=aa.tanggal and yy.isactive=1 and yy.shift=aa.shift and yy.cara_bayar='CASH') as mk_terbayar,
        COUNT(DISTINCT (aa.id)) AS jml_lembar_all,
        COUNT(DISTINCT (IF(aa.jenis='UMUM',aa.id,NULL))) AS jml_lembar_umum,
        COUNT(DISTINCT (IF(aa.is_dokel is NULL AND aa.jenis='RESEP',aa.id,NULL))) AS jml_lembar_resep,
        COUNT(DISTINCT (IF(aa.is_dokel='1',IF(aa.jenis='RESEP',aa.id,NULL),NULL))) AS jml_lembar_dokel,
        COUNT(DISTINCT (IF(aa.jenis='MK',aa.id,NULL))) AS jml_lembar_mk,
        SUM(IF(aa.is_dokel IS NULL AND aa.jenis='RESEP',bb.racik_rp,0)) AS racik_resep,
        SUM(IF(aa.is_dokel='1' AND aa.jenis='RESEP',bb.racik_rp,0)) AS racik_dokel,
        SUM(IF(aa.is_dokel IS NULL AND aa.jenis='RESEP',bb.embalase_rp,0)) AS embalase_resep,
        SUM(IF(aa.is_dokel='1' AND aa.jenis='RESEP',bb.embalase_rp,0)) AS embalase_dokel,
        SUM(IF(aa.is_dokel='1' AND aa.jenis='UMUM',bb.ppn_rp,0)) AS ppn_umum,
        SUM(IF(aa.is_dokel IS NULL AND aa.jenis='RESEP',bb.ppn_rp,0)) AS ppn_resep
        FROM jual_h aa
        LEFT JOIN jual_d bb ON bb.id_penjualan = aa.id
        WHERE aa.isactive = 1 AND bb.isactive=1
        and aa.id_cabang = '$cabang'
        $where
        group by tanggal, shift
        order by tanggal desc
        ")->result();
        // echo $this->db->last_query();die();
        //wfDebug([]);
        if ($jenis == 'UMUM') {
            $page = 'backend/laporan/penjualan/umum_prin';
        } elseif ($jenis == 'MK') {
            $page = 'backend/laporan/penjualan/mk_prin';
        } elseif ($jenis == 'RESEP') {
            $page = 'backend/laporan/penjualan/resep_prin';
        } elseif ($jenis == 'DOKEL') {
            $page = 'backend/laporan/penjualan/dokel_prin';
        } elseif ($jenis == 'ALL') {
            $page = 'backend/laporan/penjualan/all_prin';
        } else {
            $page = 'backend/laporan/penjualan/all_prin';
        }

        $data = array(
            'h'       => $h,
            'y'       => $y,
            'date1'   => $date1,
            'date2'   => $date2,
            'header'   => $header,
            'content' => $page,
        );
        //wfDebug($data['h']);
        $this->load->view('layout_print', $data);
    }
    
    public function prinSo()
    {
        $date1 = date_format(date_create($this->input->get("date1")), "Y-m-d");
        $cabang = $this->input->get("cabang");
        // $where ="tanggal_so='".$date1." 00:00:00' AND id_cabang='".$cabang."'";
        $where = "1=1 AND ";
        $where .= "id_cabang='$cabang'";
        $h = $this->db->query("SELECT bb.id,tanggal_so,aa.id_cabang,cc.`nama`,bb.`qty_fisik`,bb.`qty_selisih`,bb.`harga`,bb.`keterangan` 
            FROM so_h aa
        INNER JOIN so_d AS bb
        ON aa.id=bb.`id_so`
        INNER JOIN m_barang cc
        ON bb.`id_barang`=cc.id
        WHERE $where
        ORDER BY id_cabang ASC, tanggal_so DESC

        ")->result();
        $data = array(
            'h'       => $h,
            'date1'   => $date1,
            'content' => 'backend/laporan/so/so_prin',
        );
        // echo $this->db->last_query();die();
        // wfDebug($h);
        $this->load->view('layout_print', $data);
    }

    public function prinMutasiBulanan()
    {
        // $date1 = date_format(date_create($this->input->get("date1")), "Y-m");
        $cabang = $this->input->get("cabang");
        $where = "1=1";
        $h = $this->db->query("SELECT LEFT(tanggal,7) bulan,SUM(total) total FROM mutasi_h 
        where dari='$cabang' -- left(tanggal,7)='2023-01'
        GROUP BY LEFT(tanggal,7) 
        ORDER BY LEFT(tanggal,7) DESC")->result();
        $data = array(
            'h'       => $h,
            // 'date1'   => $date1,
            'content' => 'backend/laporan/mutasi/mutasi_bulanan_prin',
        );
        $this->load->view('layout_print', $data);
    }


    public function prinTagihanBpjs()
    {
        // $date1 = date_format(date_create($this->input->get("date1")),"Y-m-d");
        // $cabang = $this->input->get("cabang");
        // $where ="tanggal_so='".$date1." 00:00:00' AND id_cabang='".$cabang."'";
        // $where="1=1";

        $h = $this->db->query("select SUM(tagihan_disetujui) as total,COUNT(id) as count_transaksi,LEFT(tgl_pelayanan,7) as bulan from tagihan_bpjs group by LEFT(tgl_pelayanan,7)")->result();
        $data = array(
            'h'       => $h,
            // 'date1'   => $date1,
            'content' => 'backend/laporan/tagihan_bpjs/tagihan_bpjs_prin',
        );
        // echo $this->db->last_query();die();
        // wfDebug($h);
        $this->load->view('layout_print', $data);
    }

    public function prinKasKeluar()
    {
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");
        $date2 = $this->input->get("date2");
        $y     = date("Y", strtotime($date1));
        $bulan = $this->input->get("bulan");
        $tahun = $this->input->get("tahun");
        $pilihan = $this->input->get("pilihan");
        $cabang = $this->input->get("cabang");
        $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $where = "";
        $header = "";
        if ($pilihan == "tanggal") {
            $where = "and tanggal between '$date1' AND '$date2'";
            $header = "Tanggal " . ($date1) . " s.d. " . ($date2);
        } elseif ($pilihan == "bulan") {
            $where = "and month(tanggal) = '$bulan' and year(tanggal) = '$tahun'";
            $header = "Bulan " . $bln[$bulan - 1] . " Tahun $tahun";
        } else {
            $where = "and year(tanggal) = '$tahun'";
            $header = "Tahun $tahun";
        }


        $h     = $this->db->query("select tanggal,
        no_faktur as no_trs, jenis_customer as jenis, id,potongan_rp,total,
        (select nama from m_supplier where id=id_suplier) as supplier
        from beli_h  where isactive=1 and id_cabang = '$cabang' $where
        order by tanggal asc
        ")->result();

        $data = array(
            'h'       => $h,
            'y'       => $y,
            'date1'   => $date1,
            'date2'   => $date2,
            'header'   => $header,
            'content' => 'backend/laporan/kas_keluar/kas_keluar_prin',
        );
        $this->load->view('layout_print', $data);
    }

    public function prinOmset()
    {
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");
        $y     = date("Y", strtotime($date1));
        $h     = $this->db->query("SELECT aa.*,sum(bb.harga_satuan*bb.qty_entry) as omset FROM `jual_h` as aa
        inner join jual_d as bb
        on aa.id=bb.id_penjualan
        group by aa.id")->result();

        $data = array(
            'h'       => $h,
            'y'       => $y,
            'date1'   => $date1,
            'date2'   => $date2,
            'content' => 'backend/laporan/omset/omset_prin',
        );
        $this->load->view('layout_print', $data);
    }

    public function prinJual()
    {
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");
        $y     = date("Y", strtotime($date1));
        $h     = $this->db->query("select * from m_barang")->result();

        $data = array(
            'h'       => $h,
            'y'       => $y,
            'date1'   => $date1,
            'date2'   => $date2,
            'content' => 'backend/jual_h/jual_h_prin',
        );
        $this->load->view('layout_print', $data);
    }
    public function prinBarang()
    {
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");
        $y     = date("Y", strtotime($date1));
        $h     = $this->db->query("select aa.id,aa.tipe,aa.barcode,aa.nama,aa.id_satuan,bb.harga_jual
        from m_barang as aa
        inner join m_harga as bb
        on aa.id=bb.id_barang
        where aa.id_satuan=bb.id_satuan")->result();
        // wfDebug($h);
        $data = array(
            'h'       => $h,
            'y'       => $y,
            'date1'   => $date1,
            'date2'   => $date2,
            'content' => 'backend/laporan/barang/barang_prin',
        );
        $this->load->view('layout_print', $data);
    }
    public function cetakresep()
    {
        $this->load->view("cetakresep");
    }
}
