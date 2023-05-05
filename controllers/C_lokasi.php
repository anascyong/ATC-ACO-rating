<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_lokasi extends CI_Controller {

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
			'title' => 'Airnav', 
			'page' => 'v_lokasi',
			'script' => 's_lokasi',
		);
		$this->load->view('template', $data);
	}

	public function get_lokasi()
	{
		$data = $this->m_lokasi->get_lokasi();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_lokasi->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==13) {
				$row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-circle btn-sm" title="Ubah" onclick="edit_data('."'".$value->id_lokasi."'".')"><i class="fas fa-pencil-alt"></i></a>';
			} else {
				$row[] = 
				'<div class="dropdown no-arrow">
				<a class="dropdown-toggle btn btn-info btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-sm fa-fw fa-list"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-left shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data('."'".$value->id_lokasi."'".')">Ubah</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$value->id_lokasi."'".')">Hapus</a>
				</div>
				</div>';
			}
			$row[] = $no;
			$row[] = $value->nama_lokasi;
			$row[] = $value->alamat_lokasi;
			$row[] = $value->telp;
			$row[] = $value->email_lokasi;
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_lokasi->count_all(),
			"recordsFiltered" => $this->m_lokasi->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_lokasi->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'nama_lokasi' => $this->input->post('nama_lokasi'),
			'alamat_lokasi' => $this->input->post('alamat'), 
			'telp' => $this->input->post('telp'),
			'email_lokasi' => $this->input->post('email'),
			'creator' => $this->session->userdata('nama_user'),
			'created' => date('Y-m-d H:i:s'),
		);
		$insert = $this->m_lokasi->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'nama_lokasi' => $this->input->post('nama_lokasi'),
			'alamat_lokasi' => $this->input->post('alamat'), 
			'telp' => $this->input->post('telp'),
			'email_lokasi' => $this->input->post('email'),
			'editor' => $this->session->userdata('nama_user'),
			'edited' => date('Y-m-d H:i:s'),
		);
		$this->m_lokasi->update(array('id_lokasi' => $this->input->post('id_lokasi')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->m_lokasi->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_lokasi')=='')
		{
			$data['inputerror'][] = 'nama_lokasi';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat')=='')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('telp')=='')
		{
			$data['inputerror'][] = 'telp';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('email')=='')
		{
			$data['inputerror'][] = 'email';
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