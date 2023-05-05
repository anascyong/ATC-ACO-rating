<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {

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
			'title' => 'Manajemen User', 
			'page' => 'v_user',
			'script' => 's_user',
		);
		$this->load->view('template', $data);
	}

	public function get_user()
	{
		$data = $this->m_user->get_user();
		echo json_encode($data);
	}

	public function get_tipe()
	{
		$data = $this->m_user->get_tipe();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_user->get_datatables();
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
			<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data('."'".$value->id_user."'".')">Ubah</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$value->id_user."'".')">Hapus</a>
			</div>
			</div>';
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = $value->nama_tipe;
			$row[] = $value->nama_lokasi;
			$row[] = $value->no_hp;
			$row[] = $value->email;
			$row[] = $value->last_login;
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_user->count_all(),
			"recordsFiltered" => $this->m_user->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	
	public function ajax_edit($id)
	{
		$data = $this->m_user->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'id_tipe' => $this->input->post('id_tipe'),
			'id_lokasi' => $this->input->post('id_lokasi'),
			'nama_user' => $this->input->post('nama_user'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'status' => 1,
			'created' => date('Y-m-d H:i:s'),
			'creator' => $this->session->userdata('nama_user'),
		);
		$insert = $this->m_user->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate_update();
		if ($this->input->post('password')) {
			$data = array(
				'id_tipe' => $this->input->post('id_tipe'),
				'id_lokasi' => $this->input->post('id_lokasi'),
				'nama_user' => $this->input->post('nama_user'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'status' => 1,
				'edited' => date('Y-m-d H:i:s'),
				'editor' => $this->session->userdata('nama_user'),
			);
		} else {
			$data = array(
				'id_tipe' => $this->input->post('id_tipe'),
				'id_lokasi' => $this->input->post('id_lokasi'),
				'nama_user' => $this->input->post('nama_user'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'status' => 1,
				'edited' => date('Y-m-d H:i:s'),
				'editor' => $this->session->userdata('nama_user'),
			);
		}
		$this->m_user->update(array('id_user' => $this->input->post('id_user')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->m_user->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		$query = $this->db->get_where('m_user', array(
			'username' => $this->input->post('username'),
		));

		if($this->input->post('id_tipe')=='')
		{
			$data['inputerror'][] = 'id_tipe';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('id_tipe')==13 || $this->input->post('id_tipe')==5)
		{
			if($this->input->post('id_lokasi')=='')
			{
				$data['inputerror'][] = 'id_lokasi';
				$data['error_string'][] = 'Tidak Boleh Kosong';
				$data['status'] = FALSE;
			}
		}

		if($this->input->post('nama_user')=='')
		{
			$data['inputerror'][] = 'nama_user';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('no_hp')=='')
		{
			$data['inputerror'][] = 'no_hp';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('email')=='')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('username')=='')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($query->num_rows()>=1)
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Sudah Digunakan';
			$data['status'] = FALSE;
		}

		if($this->input->post('password')=='')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('ulangi_password')=='')
		{
			$data['inputerror'][] = 'ulangi_password';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('password') != $this->input->post('ulangi_password'))
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('ulangi_password') != $this->input->post('password'))
		{
			$data['inputerror'][] = 'ulangi_password';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	private function _validate_update()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_user')=='')
		{
			$data['inputerror'][] = 'nama_user';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('no_hp')=='')
		{
			$data['inputerror'][] = 'no_hp';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('email')=='')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('username')=='')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('password') != $this->input->post('ulangi_password'))
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('ulangi_password') != $this->input->post('password'))
		{
			$data['inputerror'][] = 'ulangi_password';
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