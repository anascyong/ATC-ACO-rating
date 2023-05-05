<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_soal extends CI_Controller {

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
			'title' => 'Bank Soal',
			'page' => 'v_soal',
			'script' => 's_soal',
		);
		$this->load->view('template', $data);
	}

	public function get_soal()
	{
		$data = $this->m_soal->get_soal();
		echo json_encode($data);
	}

	public function get_bidang()
	{
		$data = $this->m_soal->get_bidang();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_soal->get_datatables();
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
			<a class="dropdown-item" href="javascript:void(0)" title="Lihat" onclick="view_data('."'".$value->id_soal."'".')">Lihat</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data('."'".$value->id_soal."'".')">Ubah</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$value->id_soal."'".')">Hapus</a>
			</div>
			</div>';
			$row[] = $no;
			$row[] = $value->soal;
			$row[] = $value->nama_bidang;
			if ($value->id_jenis_soal==1) {
				$row[] = 'Multiple Choice';
			} else {
				$row[] = 'Essay';
			}

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_soal->count_all(),
			"recordsFiltered" => $this->m_soal->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_soal->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_view($id)
	{
		$data = $this->m_soal->get_view_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'id_jenis_soal' => $this->input->post('id_jenis_soal'),
			'id_bidang' => $this->input->post('id_bidang'),
			'soal' => $this->input->post('soal'),
			'jawaban' => $this->input->post('jawaban'),
			'pilihan_a' => $this->input->post('pilihan_a'),
			'pilihan_b' => $this->input->post('pilihan_b'),
			'pilihan_c' => $this->input->post('pilihan_c'),
			'pilihan_d' => $this->input->post('pilihan_d'),
			'created' => date('Y-m-d H:i:s'),
			'creator' => $this->session->userdata('nama_user'),
		);
		$insert = $this->m_soal->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'id_jenis_soal' => $this->input->post('id_jenis_soal'),
			'id_bidang' => $this->input->post('id_bidang'),
			'soal' => $this->input->post('soal'),
			'jawaban' => $this->input->post('jawaban'),
			'pilihan_a' => $this->input->post('pilihan_a'),
			'pilihan_b' => $this->input->post('pilihan_b'),
			'pilihan_c' => $this->input->post('pilihan_c'),
			'pilihan_d' => $this->input->post('pilihan_d'),
			'edited' => date('Y-m-d H:i:s'),
			'editor' => $this->session->userdata('nama_user'),
		);
		$this->m_soal->update(array('id_soal' => $this->input->post('id_soal')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->m_soal->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('id_bidang')=='')
		{
			$data['inputerror'][] = 'id_bidang';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('id_jenis_soal')=='')
		{
			$data['inputerror'][] = 'id_jenis_soal';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('soal')=='')
		{
			$data['inputerror'][] = 'soal';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_jenis_soal')==1) {

			if($this->input->post('jawaban')=='')
			{
				$data['inputerror'][] = 'jawaban';
				$data['error_string'][] = 'Tidak Boleh Kosong';
				$data['status'] = FALSE;
			}

			if($this->input->post('pilihan_a')=='')
			{
				$data['inputerror'][] = 'pilihan_a';
				$data['error_string'][] = 'Tidak Boleh Kosong';
				$data['status'] = FALSE;
			}

			if($this->input->post('pilihan_b')=='')
			{
				$data['inputerror'][] = 'pilihan_b';
				$data['error_string'][] = 'Tidak Boleh Kosong';
				$data['status'] = FALSE;
			}

			if($this->input->post('pilihan_c')=='')
			{
				$data['inputerror'][] = 'pilihan_c';
				$data['error_string'][] = 'Tidak Boleh Kosong';
				$data['status'] = FALSE;
			}

			if($this->input->post('pilihan_d')=='')
			{
				$data['inputerror'][] = 'pilihan_d';
				$data['error_string'][] = 'Tidak Boleh Kosong';
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
