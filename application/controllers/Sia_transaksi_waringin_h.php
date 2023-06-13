<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sia_transaksi_waringin_h extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //sf_construct();
        $this->load->model('Sia_transaksi_waringin_h_model');
        $this->load->model('Sia_transaksi_waringin_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        //sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin_h/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sia_transaksi_waringin_h/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin_h/index.html';
            $config['first_url'] = base_url() . 'sia_transaksi_waringin_h/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sia_transaksi_waringin_h_model->total_rows($q);
        $sia_transaksi_waringin_h = $this->Sia_transaksi_waringin_h_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(

                'id_transaksi' => set_value('id_transaksi'),
                'id_transaksi_h' => set_value('id_transaksi_h'),
                'id_akun' => set_value('id_akun'),
                'jenis_saldo' => set_value('jenis_saldo'),
                'saldo' => set_value('saldo'),
                'penanda' => set_value('penanda'),

            'sia_transaksi_waringin_h_data' => $sia_transaksi_waringin_h,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sia_transaksi_waringin_h/sia_transaksi_waringin_h_list',
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
            $config['base_url'] = base_url() . 'sia_transaksi_waringin_h/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sia_transaksi_waringin_h/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sia_transaksi_waringin_h/index.html';
            $config['first_url'] = base_url() . 'sia_transaksi_waringin_h/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sia_transaksi_waringin_h_model->total_rows($q);
        $sia_transaksi_waringin_h = $this->Sia_transaksi_waringin_h_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'sia_transaksi_waringin_h_data' => $sia_transaksi_waringin_h,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sia_transaksi_waringin_h/sia_transaksi_waringin_h_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        //sf_validate('R');
        $row = $this->Sia_transaksi_waringin_h_model->get_by_id($id);
        if ($row) {
        $data = array(
		'id_transaksi' => $row->id_transaksi,
		'tgl_input' => $row->tgl_input,
		'no_ref' => $row->no_ref,
		'ket' => $row->ket,
		'created_by' => $row->created_by,
		'update_by' => $row->update_by,
		'created_at' => $row->created_at,
		'update_at' => $row->update_at,
		'isactive' => $row->isactive,
	    'content' => 'backend/sia_transaksi_waringin_h/sia_transaksi_waringin_h_read',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sia_transaksi_waringin_h'));
        }
    }

    public function create() 
    {
        //sf_validate('C');
        $data = array(
        'button' => 'Create',
        'action' => site_url('sia_transaksi_waringin_h/create_action'),
	    'id_transaksi' => set_value('id_transaksi'),
	    'tgl_input' => set_value('tgl_input'),
	    'no_ref' => set_value('no_ref'),
	    'ket' => set_value('ket'),
	    'created_by' => set_value('created_by'),
	    'update_by' => set_value('update_by'),
	    'created_at' => set_value('created_at'),
	    'update_at' => set_value('update_at'),
	    'isactive' => set_value('isactive'),
	    'content' => 'backend/sia_transaksi_waringin_h/sia_transaksi_waringin_h_form',
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
		'tgl_input' => $this->input->post('tgl_input',TRUE),
		'no_ref' => $this->input->post('no_ref',TRUE),
		'ket' => $this->input->post('ket',TRUE),
		'created_by' => $this->session->userdata('username'),
		'update_by' => $this->input->post('update_by',TRUE),
		'created_at' => date('Y-m-d H:i:s'),
		'update_at' => $this->input->post('update_at',TRUE),
		'isactive' => 1,
	    );

            $this->Sia_transaksi_waringin_h_model->insert($data);
            $id_transaksi_h = $this->db->insert_id() ;
            $tgl_input = $this->input->post('tgl_input',TRUE) ;

                
             $data_akun_pembalik = array(
                'tgl_input' => $tgl_input,
                'created_by' => $this->session->userdata('username'),
                'created_at' => date('Y-m-d H:i:s'),
                'id_transaksi_h' => $id_transaksi_h,
                'penanda' => 26,
                'isactive' => 1,
                );
            $this->Sia_transaksi_waringin_model->insert($data_akun_pembalik);

            $data_akun = array(
                'tgl_input' => $tgl_input,
                'created_by' => $this->session->userdata('username'),
                'created_at' => date('Y-m-d H:i:s'),
                'id_transaksi_h' => $id_transaksi_h,
                'penanda' => 25,
                'isactive' => 1,
                );
            $this->Sia_transaksi_waringin_model->insert($data_akun);



            $this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
            redirect(site_url('sia_transaksi_waringin'));
        }
    }
    
    public function update($id) 
    {
        //sf_validate('U');
        $row = $this->Sia_transaksi_waringin_h_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('sia_transaksi_waringin_h/update_action'),
		'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
		'tgl_input' => set_value('tgl_input', $row->tgl_input),
		'no_ref' => set_value('no_ref', $row->no_ref),
		'ket' => set_value('ket', $row->ket),
		'created_by' => set_value('created_by', $row->created_by),
		'update_by' => set_value('update_by', $row->update_by),
		'created_at' => set_value('created_at', $row->created_at),
		'update_at' => set_value('update_at', $row->update_at),
		'isactive' => set_value('isactive', $row->isactive),
	    'content' => 'backend/sia_transaksi_waringin_h/sia_transaksi_waringin_h_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('sia_transaksi_waringin_h'));
        }
    }
    
    public function update_action() 
    {
        //sf_validate('U');
        if(!is_allow('U_'.ucwords($this->router->fetch_class()))){
            $this->session->set_flashdata('message', 'Maaf, Anda tidak memiliki akses untuk membuat data '.ucwords($this->router->fetch_class()));
            redirect(site_url(strtolower($this->router->fetch_class())));
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_transaksi', TRUE));
        } else {
            $data = array(
        		'tgl_input' => $this->input->post('tgl_input',TRUE),
        		'no_ref' => $this->input->post('no_ref',TRUE),
        		'ket' => $this->input->post('ket',TRUE),
        		'created_by' => $this->input->post('created_by',TRUE),
        		'update_by' => $this->input->post('update_by',TRUE),
        		'created_at' => $this->input->post('created_at',TRUE),
        		'update_at' => $this->input->post('update_at',TRUE),
        		'isactive' => $this->input->post('isactive',TRUE),
        	    );

            $this->Sia_transaksi_waringin_h_model->update($this->input->post('id_transaksi', TRUE), $data);

            $data_detail = array(
                'tgl_input' => $this->input->post('tgl_input',TRUE),
            );
            $this->Sia_transaksi_waringin_model->update($this->input->post('id_transaksi', TRUE), $data_detail);

            $this->session->set_flashdata('message', 'Edit data telah berhasil!');
            redirect(site_url('sia_transaksi_waringin_h'));
        }
    }
    
    public function delete($id) 
    {
        //sf_validate('D');
        $row = $this->Sia_transaksi_waringin_h_model->get_by_id($id);

        if ($row) {
            
            $this->Sia_transaksi_waringin_model->delete_all($id);
            $this->Sia_transaksi_waringin_h_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus data berhasil!');
            redirect(site_url('sia_transaksi_waringin'));
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('sia_transaksi_waringin'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_input', 'tgl input', 'trim|required');
	$this->form_validation->set_rules('no_ref', 'no ref', 'trim');
	$this->form_validation->set_rules('ket', 'ket', 'trim');
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
        $namaFile = "sia_transaksi_waringin_h.xls";
        $judul = "sia_transaksi_waringin_h";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Input");
	xlsWriteLabel($tablehead, $kolomhead++, "No Ref");
	xlsWriteLabel($tablehead, $kolomhead++, "Ket");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Update By");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Update At");
	xlsWriteLabel($tablehead, $kolomhead++, "Isactive");

	foreach ($this->Sia_transaksi_waringin_h_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_input);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_ref);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ket);
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
        header("Content-Disposition: attachment;Filename=sia_transaksi_waringin_h.doc");

        $data = array(
            'sia_transaksi_waringin_h_data' => $this->Sia_transaksi_waringin_h_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('sia_transaksi_waringin_h/sia_transaksi_waringin_h_doc',$data);
    }

    public function create_action_ajax()
    { //echo "<pre>";print_r($_POST);die();

        $data = array(
                'id_akun' => $this->input->post('id_akun',TRUE),
                'id_transaksi_h' =>$this->input->post('idtransaksi_h',TRUE),
                'jenis_saldo' => $this->input->post('jenis_saldo',TRUE),
                'saldo' => $this->input->post('saldo',TRUE),
                'penanda' => $this->input->post('penanda',TRUE),
            );

           $this->Sia_transaksi_waringin_model->insert($data);
        //die($this->db->last_query());
        //=================================//

        $response['msg'] = "Data Sudah n";
        echo json_encode($response);
    }

}

/* End of file Sia_transaksi_waringin_h.php */
/* Location: ./application/controllers/Sia_transaksi_waringin_h.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-03-23 03:34:58 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */