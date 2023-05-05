<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jumlah_soal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		if (!$this->session->userdata('id_user')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data = array(
			'title' => 'Jumlah Soal',
			'page' => 'v_jumlah_soal',
			'script' => 's_jumlah_soal',
		);
		$this->load->view('template', $data);
	}

	public function get_jumlah_soal()
	{
		$data = $this->m_jumlah_soal->get_jumlah_soal();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_jumlah_soal->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-circle btn-sm" onclick="edit_data('."'".$value->id."'".')"><i class="fas fa-pencil-alt"></i></a>';
			$row[] = 'Jumlah Soal Ujian Teori Assessment';
			$row[] = $value->jumlah;

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_jumlah_soal->count_all(),
			"recordsFiltered" => $this->m_jumlah_soal->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_jumlah_soal->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'jumlah' => $this->input->post('jumlah'),
		);
		$this->m_jumlah_soal->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('jumlah')=='')
		{
			$data['inputerror'][] = 'jumlah';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
