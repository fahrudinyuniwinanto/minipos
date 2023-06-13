<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sia_akun_waringin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       // sf_construct();
        $this->load->model('Sia_akun_waringin_model');
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
       // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sia_akun_waringin/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sia_akun_waringin/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sia_akun_waringin/index.html';
            $config['first_url'] = base_url() . 'sia_akun_waringin/index.html';
        }

        $config['per_page'] = 10000;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sia_akun_waringin_model->total_rows($q);
        $sia_akun_waringin = $this->Sia_akun_waringin_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sia_akun_waringin_data' => $sia_akun_waringin,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sia_akun_waringin/sia_akun_waringin_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
       // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sia_akun_waringin/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sia_akun_waringin/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sia_akun_waringin/index.html';
            $config['first_url'] = base_url() . 'sia_akun_waringin/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sia_akun_waringin_model->total_rows($q);
        $sia_akun_waringin = $this->Sia_akun_waringin_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'sia_akun_waringin_data' => $sia_akun_waringin,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sia_akun_waringin/sia_akun_waringin_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
       // sf_validate('R');
        $row = $this->Sia_akun_waringin_model->get_by_id($id);
        if ($row) {
        $data = array(
		'id_akun' => $row->id_akun,
		'no_coa' => $row->no_coa,
		'nama_coa' => $row->nama_coa,
		'keterangan' => $row->keterangan,
		'parent' => $row->parent,
		'created_by' => $row->created_by,
		'update_by' => $row->update_by,
		'created_at' => $row->created_at,
		'update_at' => $row->update_at,
		'isactive' => $row->isactive,
	    'content' => 'backend/sia_akun_waringin/sia_akun_waringin_read',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sia_akun_waringin'));
        }
    }

    public function create() 
    {
        //sf_validate('C');
        $data = array(
        'button' => 'Create',
        'action' => site_url('sia_akun_waringin/create_action'),
	    'id_akun' => set_value('id_akun'),
	    'no_coa' => set_value('no_coa'),
        'status' => set_value('status'),
	    'nama_coa' => set_value('nama_coa'),
	    'keterangan' => set_value('keterangan'),
	    'parent' => set_value('parent'),
        'saldo_debit' => set_value('saldo_debit'),
        'saldo_kredit' => set_value('saldo_kredit'),
        'jenis_laporan' => set_value('jenis_laporan'),
        'jenis_saldo' => set_value('jenis_saldo'),
	    'created_by' => set_value('created_by'),
	    'update_by' => set_value('update_by'),
	    'created_at' => set_value('created_at'),
	    'update_at' => set_value('update_at'),
	    'isactive' => set_value('isactive'),
        'query' => set_value('query'),
	    'content' => 'backend/sia_akun_waringin/sia_akun_waringin_form',
	);
        $this->load->view(layout(), $data);
    }
    
    public function create_action() 
    {
        //sf_validate('c');        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'status' => $this->input->post('status',TRUE),
        'no_coa' => $this->input->post('no_coa',TRUE),
        'query' => $this->input->post('query',TRUE),
		'nama_coa' => $this->input->post('nama_coa',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'parent' => $this->input->post('parent',TRUE),
        'saldo_debit' => $this->input->post('saldo_debit',TRUE),
        'saldo_kredit' => $this->input->post('saldo_kredit',TRUE),
        'jenis_saldo' => $this->input->post('jenis_saldo',TRUE),
        'jenis_laporan' => $this->input->post('jenis_laporan',TRUE),
		'created_by' => $this->session->userdata('username'),
		'update_by' => $this->input->post('update_by',TRUE),
		'created_at' => date('Y-m-d H:i:s'),
		'update_at' => $this->input->post('update_at',TRUE),
		'isactive' => $this->input->post('isactive',TRUE),
	    );
            $this->Sia_akun_waringin_model->insert($data);
            // $no_coa = $this->db->insert_id();
            // $no_coa_2 = 0;
            // $no_coa_3 = 0;
            // $no_coa_4 = 0;
            // $siaakun = $this->db->query("select * from sia_akun_waringin where id_akun = $no_coa ")->row();
            // $siaakun_id = $siaakun->parent;
            // $siakun_parent = $this->db->query("select bb.no_coa as coa_parent from sia_akun_waringin aa left join sia_akun_waringin bb on bb.parent = $siaakun_id where aa.no_coa = $no_coa ")->row();
            // echo "<pre>";
            //  echo $this->db->last_query();
            //  die('stop');

            // $no_akun_parent = $siakun_parent->coa_parent;
            // $parent = $siaakun->parent_parent;
            // if ($parent == $no_coa) {
            //     $no_coa_auto =$no_coa.".".$no_coa_2.".".$no_coa_3.".".$no_coa_4;
            // }else{
            //     $no_coa_auto =$no_coa.".".($no_akun_parent+ 1) .".".$no_coa_3.".".$no_coa_4;
            // }
            // $data_no_coa = array('no_coa' =>  $coa_auto, TRUE);
            // $this->Sia_akun_waringin_model->update($no_coa, $data_no_coa);

            $this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
            redirect(site_url('sia_akun_waringin'));
        }
    }
    
    public function update($id) 
    {
        //sf_validate('U');
        $row = $this->Sia_akun_waringin_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('sia_akun_waringin/update_action'),
		'id_akun' => set_value('id_akun', $row->id_akun),
		'no_coa' => set_value('no_coa', $row->no_coa),
		'nama_coa' => set_value('nama_coa', $row->nama_coa),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'parent' => set_value('parent', $row->parent),
        'saldo_debit' => set_value('saldo_debit', $row->saldo_debit),
        'saldo_kredit' => set_value('saldo_kredit', $row->saldo_kredit),
        'jenis_laporan' => set_value('jenis_laporan', $row->jenis_laporan),
        'jenis_saldo' => set_value('jenis_saldo', $row->jenis_saldo),
		'created_by' => set_value('created_by', $row->created_by),
		'update_by' => set_value('update_by', $row->update_by),
		'created_at' => set_value('created_at', $row->created_at),
		'update_at' => set_value('update_at', $row->update_at),
		'isactive' => set_value('isactive', $row->isactive),
        'query' => set_value('query', $row->query),
        'status' => set_value('query', $row->status),
	    'content' => 'backend/sia_akun_waringin/sia_akun_waringin_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('sia_akun_waringin'));
        }
    }
    
    public function update_action() 
    {
        //sf_validate('U');
        // if(!is_allow('U_'.ucwords($this->router->fetch_class()))){
        //     $this->session->set_flashdata('message', 'Maaf, Anda tidak memiliki akses untuk membuat data '.ucwords($this->router->fetch_class()));
        //     redirect(site_url(strtolower($this->router->fetch_class())));
        // }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_akun', TRUE));
        } else {
            $data = array(
		'status' => $this->input->post('status',TRUE),
        'query' => $this->input->post('query',TRUE),
        'no_coa' => $this->input->post('no_coa',TRUE),
		'nama_coa' => $this->input->post('nama_coa',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'parent' => $this->input->post('parent',TRUE),
        'saldo_kredit' => $this->input->post('saldo_kredit',TRUE),
        'saldo_debit' => $this->input->post('saldo_debit',TRUE),
        'jenis_saldo' => $this->input->post('jenis_saldo',TRUE),
        'jenis_laporan' => $this->input->post('jenis_laporan',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'update_by' => $this->input->post('update_by',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
		'isactive' => $this->input->post('isactive',TRUE),
	    );

            $this->Sia_akun_waringin_model->update($this->input->post('id_akun', TRUE), $data);
            $this->session->set_flashdata('message', 'Edit data telah berhasil!');
            redirect(site_url('sia_akun_waringin'));
        }
    }
    
    public function delete($id) 
    {
        //sf_validate('D');
        $row = $this->Sia_akun_waringin_model->get_by_id($id);

        if ($row) {
            /*$data = array(
                'isactive'=>0,
            );
            $this->Berita_model->update($id,$data);*/
            $this->Sia_akun_waringin_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus data berhasil!');
            redirect(site_url('sia_akun_waringin'));
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('sia_akun_waringin'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_coa', 'no coa', 'trim');
	$this->form_validation->set_rules('nama_coa', 'nama coa', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
	$this->form_validation->set_rules('parent', 'parent', 'trim|required');
	$this->form_validation->set_rules('created_by', 'created by', 'trim');
	$this->form_validation->set_rules('update_by', 'update by', 'trim');
	$this->form_validation->set_rules('created_at', 'created at', 'trim');
	$this->form_validation->set_rules('update_at', 'update at', 'trim');
	$this->form_validation->set_rules('isactive', 'isactive', 'trim');
	$this->form_validation->set_rules('id_akun', 'id_akun', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        //sf_validate('E');
        $this->load->helper('exportexcel');
        $namaFile = "sia_akun_waringin.xls";
        $judul = "sia_akun_waringin";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "No Coa");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Coa");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Parent");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Update By");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Update At");
	xlsWriteLabel($tablehead, $kolomhead++, "Isactive");

	foreach ($this->Sia_akun_waringin_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_coa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_coa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->parent);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->update_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
	    xlsWriteLabel($tablebody, $kolombody++, $data->update_at);
	    xlsWriteNumber($tablebody, $kolombody++, $data->isactive);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        //sf_validate('W');
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=sia_akun_waringin.doc");

        $data = array(
            'sia_akun_waringin_data' => $this->Sia_akun_waringin_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('sia_akun_waringin/sia_akun_waringin_doc',$data);
    }

    public function penerimaan() {

       // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $laporan = urldecode($this->input->get('kategori', TRUE)) <> "" ? urldecode($this->input->get('kategori', TRUE)) : "x0";
        $tgl = urldecode($this->input->get('tgl_input', TRUE))<>""?urldecode($this->input->get('tgl_input', TRUE)):"x0";
        $thn = urldecode($this->input->get('tgl_input', TRUE))<>""?urldecode($this->input->get('tgl_input', TRUE)):"x0";
        
        if ($laporan <> '' or $tgl <> '' or $thn <> '') {
            $config['base_url'] = base_url() . 'sia_akun_waringin/penerimaan/index.html?koderek=' . urlencode($laporan) . '&tgl=' . $tgl . '&thn=' . $thn ;
            $config['first_url'] = base_url() . 'sia_akun_waringin/penerimaan/index.html?koderek=' . urlencode($laporan) . '&tgl=' . $tgl . '&thn=' . $thn;
        } else {
            $config['base_url'] = base_url() . 'sia_akun_waringin/penerimaan/index.html';
            $config['first_url'] = base_url() . 'sia_akun_waringin/penerimaan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sia_akun_waringin_model->total_rows($q);
        $sia_akun_waringin = $this->Sia_akun_waringin_model->get_limit_data($config['per_page'], $start, $q);
        $row = $this->Sia_akun_waringin_model->get_cetak_lapkas_coa_bank();
        $row2 = $this->Sia_akun_waringin_model->get_cetak_lapkas_pendapatan_manual();
        $row3 = $this->Sia_akun_waringin_model->get_cetak_lapkas_beban();
        $row4 = $this->Sia_akun_waringin_model->get_cetak_lapkas_modal();
        $row5 = $this->Sia_akun_waringin_model->get_cetak_lapkas_penerimaan_kas();
        $row6 = $this->Sia_akun_waringin_model->get_cetak_lapkas_penambahan_modal();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx' => $row,
            'trx2' => $row2,
            'trx3' => $row3,
            'trx4' => $row4,
            'trx5' => $row5,
            'trx6' => $row6,
            'action' => site_url('sia_akun_waringin/lapkas'),
            'laporan' => $laporan,
            'tgl' => $tgl,
            'thn' => $thn,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/format_laporan/list_laporan',
        );
        $this->load->view('layout_backend.php', $data);
    }

    public function lapkas() {
        
        $row = $this->Sia_akun_waringin_model->get_cetak_lapkas_coa_bank();
        $row2 = $this->Sia_akun_waringin_model->get_cetak_lapkas_pendapatan_manual();
        $row3 = $this->Sia_akun_waringin_model->get_cetak_lapkas_beban();
        $row4 = $this->Sia_akun_waringin_model->get_cetak_lapkas_modal();
        $row5 = $this->Sia_akun_waringin_model->get_cetak_lapkas_penerimaan_kas();
        $row6 = $this->Sia_akun_waringin_model->get_cetak_lapkas_penambahan_modal();
        $data = array(
            'trx' => $row,
            'trx2' => $row2,
            'trx3' => $row3,
            'trx4' => $row4,
            'trx5' => $row5,
            'trx6' => $row6,
            'content' => 'backend/format_laporan/lapkas',
        );
        $this->load->view('layout_backend.php', $data);
    }

    public function neraca() {
    
        $data = array(
            'content' => 'backend/format_laporan/neraca',
        );
        $this->load->view('layout_backend.php', $data);
    }
    public function laba_rugi() {
    
        $data = array(
            'content' => 'backend/format_laporan/laba_rugi',
        );
        $this->load->view('layout_backend.php', $data);
    }

}

/* End of file Sia_akun_waringin.php */
/* Location: ./application/controllers/Sia_akun_waringin.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-01 04:41:19 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */