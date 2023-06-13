<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sia_transaksi_waringin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //sf_construct();
        $this->load->model('Sia_transaksi_waringin_model');
        $this->load->model('Sia_akun_waringin_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
       // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        $koderek = urldecode($this->input->get('koderek', TRUE)) <> "" ? urldecode($this->input->get('koderek', TRUE)) : "x0";
        $tgl = urldecode($this->input->get('tgl', TRUE))<>""?urldecode($this->input->get('tgl', TRUE)):"x0";
        $thn = urldecode($this->input->get('thn', TRUE))<>""?urldecode($this->input->get('thn', TRUE)):"x0";
        $thn = urldecode($this->input->get('thn', TRUE))<>""?urldecode($this->input->get('thn', TRUE)):"x0";
        $start = intval($this->input->get('start'));
        
        if ($koderek <> '' or $tgl <> '' or $thn <> '' ) {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin/index?koderek=' . urlencode($koderek) . '&tgl=' . $tgl . '&thn=' . $thn;
            $config['first_url'] = base_url() . 'sia_transaksi_waringin/index?koderek=' . urlencode($koderek) . '&tgl=' . $tgl . '&thn=' . $thn;
        } else {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin/index';
            $config['first_url'] = base_url() . 'sia_transaksi_waringin/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sia_transaksi_waringin_model->total_rows_buku_besar($koderek, $tgl,$thn);
        $sia_transaksi_waringin = $this->Sia_transaksi_waringin_model->get_limit_data_buku_besar($config['per_page'], $start, $koderek, $tgl,$thn);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sia_transaksi_waringin_data' => $sia_transaksi_waringin,
            'koderek' => $koderek,
            'tgl' => $tgl,
            'thn' => $thn,
            //'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sia_transaksi_waringin/sia_transaksi_waringin_list',
        );
        $this->load->view(layout(), $data);
    }

    public function buku_besar()
    {   
       // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $koderek = urldecode($this->input->get('koderek', TRUE)) <> "" ? urldecode($this->input->get('koderek', TRUE)) : "x0";
        $tgl = urldecode($this->input->get('tgl', TRUE))<>""?urldecode($this->input->get('tgl', TRUE)):"x0";
        $thn = urldecode($this->input->get('thn', TRUE))<>""?urldecode($this->input->get('thn', TRUE)):"x0";
        $thn = urldecode($this->input->get('thn', TRUE))<>""?urldecode($this->input->get('thn', TRUE)):"x0";
        $start = intval($this->input->get('start'));
        
        if ($koderek <> '' or $tgl <> '' or $thn <> '' ) {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin/buku_besar?koderek=' . urlencode($koderek) . '&tgl=' . $tgl . '&thn=' . $thn;
            $config['first_url'] = base_url() . 'sia_transaksi_waringin/buku_besar?koderek=' . urlencode($koderek) . '&tgl=' . $tgl . '&thn=' . $thn;
        } else {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin/buku_besar';
            $config['first_url'] = base_url() . 'sia_transaksi_waringin/buku_besar';
        }

        $config['per_page'] = 1000;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sia_akun_waringin_model->total_rows($koderek, $tgl,$thn);
        $sia_transaksi_waringin = $this->Sia_akun_waringin_model->get_limit_data_buku_besar($config['per_page'], $start, $koderek, $tgl,$thn);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
             'koderek' => $koderek,
            'tgl' => $tgl,
            'thn' => $thn,
            'sia_transaksi_waringin_data' => $sia_transaksi_waringin,
            //'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sia_transaksi_waringin/sia_buku_besar_waringin_list',
        );
        $this->load->view(layout(), $data);
    }

    public function neraca_lajur()
    {   
       // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $koderek = urldecode($this->input->get('koderek', TRUE)) <> "" ? urldecode($this->input->get('koderek', TRUE)) : "x0";
        $tgl = urldecode($this->input->get('tgl', TRUE))<>""?urldecode($this->input->get('tgl', TRUE)):"x0";
        $thn = urldecode($this->input->get('thn', TRUE))<>""?urldecode($this->input->get('thn', TRUE)):"x0";
        $thn = urldecode($this->input->get('thn', TRUE))<>""?urldecode($this->input->get('thn', TRUE)):"x0";
        $start = intval($this->input->get('start'));
        
        if ($koderek <> '' or $tgl <> '' or $thn <> '' ) {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin/neraca_lajur?koderek=' . urlencode($koderek) . '&tgl=' . $tgl . '&thn=' . $thn;
            $config['first_url'] = base_url() . 'sia_transaksi_waringin/neraca_lajur?koderek=' . urlencode($koderek) . '&tgl=' . $tgl . '&thn=' . $thn;
        } else {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin/neraca_lajur';
            $config['first_url'] = base_url() . 'sia_transaksi_waringin/neraca_lajur';
        }

        $config['per_page'] = 1000;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sia_akun_waringin_model->total_rows($koderek, $tgl,$thn);
        $sia_transaksi_waringin = $this->Sia_akun_waringin_model->get_limit_data_buku_besar($config['per_page'], $start, $koderek, $tgl,$thn);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
             'koderek' => $koderek,
            'tgl' => $tgl,
            'thn' => $thn,
            'sia_transaksi_waringin_data' => $sia_transaksi_waringin,
            //'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sia_transaksi_waringin/sia_neraca_lajur_waringin_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        //sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sia_transaksi_waringin/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin/index.html';
            $config['first_url'] = base_url() . 'sia_transaksi_waringin/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sia_transaksi_waringin_model->total_rows($q);
        $sia_transaksi_waringin = $this->Sia_transaksi_waringin_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'sia_transaksi_waringin_data' => $sia_transaksi_waringin,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sia_transaksi_waringin/sia_transaksi_waringin_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
       // sf_validate('R');
        $row = $this->Sia_transaksi_waringin_model->get_by_id($id);
        if ($row) {
        $data = array(
		'id_transaksi' => $row->id_transaksi,
		'id_akun' => $row->id_akun,
		'tgl_input' => $row->tgl_input,
		'jenis_saldo' => $row->jenis_saldo,
		'saldo' => $row->saldo,
		'created_by' => $row->created_by,
		'update_by' => $row->update_by,
		'created_at' => $row->created_at,
		'update_at' => $row->update_at,
		'isactive' => $row->isactive,
	    'content' => 'backend/sia_transaksi_waringin/sia_transaksi_waringin_read',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sia_transaksi_waringin'));
        }
    }

    public function create() 
    {
        //sf_validate('C');
        $data = array(
        'button' => 'Create',
        'action' => site_url('sia_transaksi_waringin/create_action'),
	    'id_transaksi' => set_value('id_transaksi'),
	    'id_akun_lawan' => set_value('id_akun_lawan'),
        'id_akun' => set_value('id_akun'),
	    'tgl_input' => set_value('tgl_input'),
        'no_ref' => set_value('no_ref'),
	    'jenis_saldo' => set_value('jenis_saldo'),
        'jenis_saldo_lawan' => set_value('jenis_saldo_lawan'),
	    'saldo' => set_value('saldo'),
        'saldo_lawan' => set_value('saldo'),
	    'created_by' => set_value('created_by'),
	    'update_by' => set_value('update_by'),
	    'created_at' => set_value('created_at'),
	    'update_at' => set_value('update_at'),
        'ket' => set_value('ket'),
	    'isactive' => set_value('isactive'),
	    'content' => 'backend/sia_transaksi_waringin/sia_transaksi_waringin_form',
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
		'id_akun' => $this->input->post('id_akun',TRUE),
		'tgl_input' => $this->input->post('tgl_input',TRUE),
        'no_ref' => $this->input->post('no_ref',TRUE),
		'jenis_saldo' => $this->input->post('jenis_saldo',TRUE),
		'saldo' => $this->input->post('saldo',TRUE),
        'ket' => $this->input->post('ket',TRUE),
		'created_by' => $this->session->userdata('username'),
		'created_at' => date('Y-m-d H:i:s'),
        'penanda' => $this->input->post('id_transaksi',TRUE),
		'isactive' => 1,
	    );

            $this->Sia_transaksi_waringin_model->insert($data);

           // $id_transaksi = $this->db->insert_id() ;
            $penanda = $this->input->post('id_transaksi',TRUE) ;

            //insert lawan================//

            $data_lawan = array(
                'penanda' =>  $penanda,
                'tgl_input' => $this->input->post('tgl_input',TRUE),
                'no_ref' => $this->input->post('no_ref',TRUE),
                'id_akun' =>$this->input->post('id_akun_lawan',TRUE),
                'jenis_saldo' => $this->input->post('jenis_saldo_lawan',TRUE),
                'saldo' => $this->input->post('saldo',TRUE),
                'ket' => $this->input->post('ket',TRUE),
                'created_by' => $this->session->userdata('username'),
                'created_at' => date('Y-m-d H:i:s'),
                'isactive' => 1,
            );

            $this->Sia_transaksi_waringin_model->insert($data_lawan);

            $this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
            redirect(site_url('sia_transaksi_waringin'));
        }
    }
    
    public function update($id) 
    {
        //sf_validate('U');
        $row = $this->Sia_transaksi_waringin_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('sia_transaksi_waringin/update_action'),
		'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
		'id_akun' => set_value('id_akun', $row->id_akun),
		'tgl_input' => set_value('tgl_input', $row->tgl_input),
		'jenis_saldo' => set_value('jenis_saldo', $row->jenis_saldo),
		'saldo' => set_value('saldo', $row->saldo),
		'created_by' => set_value('created_by', $row->created_by),
		'update_by' => set_value('update_by', $row->update_by),
		'created_at' => set_value('created_at', $row->created_at),
		'update_at' => set_value('update_at', $row->update_at),
		'isactive' => set_value('isactive', $row->isactive),
        'ket' => set_value('ket', $row->ket),
	    'content' => 'backend/sia_transaksi_waringin/sia_transaksi_waringin_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('sia_transaksi_waringin'));
        }
    }
    
    public function update_action() 
    {
        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_transaksi', TRUE));
        } else {
            $data = array(
		
        'id_akun' => $this->input->post('id_akun',TRUE),
		'jenis_saldo' => $this->input->post('jenis_saldo',TRUE),
		'saldo' => $this->input->post('saldo',TRUE),
        'update_by' => $this->input->post('update_by',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
        'ket' => $this->input->post('ket',TRUE),
		'isactive' => $this->input->post('isactive',TRUE),
	    );

            $this->Sia_transaksi_waringin_model->update($this->input->post('id_transaksi', TRUE), $data);
            $this->session->set_flashdata('message', 'Edit data telah berhasil!');
            redirect(site_url('sia_transaksi_waringin'));
        }
    }
    
    public function delete($id) 
    {
       // sf_validate('D');
        $row = $this->Sia_transaksi_waringin_model->get_by_id($id);

        if ($row) {
            /*$data = array(
                'isactive'=>0,
            );
            $this->Berita_model->update($id,$data);*/
            $this->Sia_transaksi_waringin_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus data berhasil!');
            redirect(site_url('sia_transaksi_waringin'));
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('sia_transaksi_waringin'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_akun', 'id akun', 'trim|required');
	$this->form_validation->set_rules('tgl_input', 'tgl input', 'trim');
	$this->form_validation->set_rules('jenis_saldo', 'jenis saldo', 'trim|required');
	$this->form_validation->set_rules('saldo', 'saldo', 'trim|required');
	$this->form_validation->set_rules('created_by', 'created by', 'trim');
	$this->form_validation->set_rules('update_by', 'update by', 'trim');
	$this->form_validation->set_rules('created_at', 'created at', 'trim');
	$this->form_validation->set_rules('update_at', 'update at', 'trim');
	$this->form_validation->set_rules('isactive', 'isactive', 'trim');
	$this->form_validation->set_rules('id_transaksi', 'id_transaksi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        //sf_validate('E');
        $this->load->helper('exportexcel');
        $namaFile = "sia_transaksi_waringin.xls";
        $judul = "sia_transaksi_waringin";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Akun");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Input");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Saldo");
	xlsWriteLabel($tablehead, $kolomhead++, "Saldo");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Update By");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Update At");
	xlsWriteLabel($tablehead, $kolomhead++, "Isactive");

	foreach ($this->Sia_transaksi_waringin_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_akun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_input);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_saldo);
	    xlsWriteNumber($tablebody, $kolombody++, $data->saldo);
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
        sf_validate('W');
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=sia_transaksi_waringin.doc");

        $data = array(
            'sia_transaksi_waringin_data' => $this->Sia_transaksi_waringin_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('sia_transaksi_waringin/sia_transaksi_waringin_doc',$data);
    }

}

/* End of file Sia_transaksi_waringin.php */
/* Location: ./application/controllers/Sia_transaksi_waringin.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-01 04:41:29 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */