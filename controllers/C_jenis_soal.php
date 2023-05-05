<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jenis_soal extends CI_Controller {

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
			'title' => 'Jenis Pengetahuan',
			'page' => 'v_jenis_soal',
			'script' => 's_jenis_soal',
		);
		$this->load->view('template', $data);
	}

	public function get_jenis_soal()
	{
		$data = $this->m_jenis_soal->get_jenis_soal();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_jenis_soal->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] = 
			'<div class="dropdown no-arrow">
			<a class="dropdown-toggle btn btn-info btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-sm fa-fw fa-list"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-left shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data('."'".$value->id_jenis_soal."'".')">Ubah</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$value->id_jenis_soal."'".')">Hapus</a>
			</div>
			</div>';
			$row[] = $no;
			$row[] = $value->nama_jenis;

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_jenis_soal->count_all(),
			"recordsFiltered" => $this->m_jenis_soal->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_jenis_soal->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'nama_jenis' => $this->input->post('nama_jenis'),
		);
		$insert = $this->m_jenis_soal->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'nama_jenis' => $this->input->post('nama_jenis'),
		);
		$this->m_jenis_soal->update(array('id_jenis_soal' => $this->input->post('id_jenis_soal')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->m_jenis_soal->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_jenis')=='')
		{
			$data['inputerror'][] = 'nama_jenis';
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
