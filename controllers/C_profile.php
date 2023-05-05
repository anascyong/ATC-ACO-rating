<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_profile extends CI_Controller {

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
			'title' => 'Profile', 
			'page' => 'v_profile',
			'script' => 's_profile',
		);
		$this->load->view('template', $data);
	}

	public function password()
	{
		$data = array(
			'title' => 'Password', 
			'page' => 'v_password',
			'script' => 's_password',
		);
		$this->load->view('template', $data);
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'nama_user' => $this->input->post('nama_user'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
		);
		$this->m_profile->update(array('id_user' => $this->input->post('id_user')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_password()
	{
		$this->_validate_password();
		$data = array(
			'password' => $this->input->post('password_baru'),
		);
		$this->m_profile->update(array('id_user' => $this->input->post('id_user')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit()
	{
		$data = $this->m_profile->get_by_id();
		echo json_encode($data);
	}

	private function _validate()
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

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_password()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		$query = $this->db->get_where('m_user', array(
			'id_user' => $this->input->post('id_user'),
		));
		foreach ($query->result() as $value) {
			if ($value->password != $this->input->post('password')) {
				$data['inputerror'][] = 'password';
				$data['error_string'][] = 'Password Lama Salah';
				$data['status'] = FALSE;
			}
		}

		if($this->input->post('password')=='')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('password_baru')=='')
		{
			$data['inputerror'][] = 'password_baru';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('ulangi_password_baru')=='')
		{
			$data['inputerror'][] = 'ulangi_password_baru';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('password_baru') != $this->input->post('ulangi_password_baru'))
		{
			$data['inputerror'][] = 'password_baru';
			$data['error_string'][] = 'Password Tidak Sama';
			$data['status'] = FALSE;
		}

		if($this->input->post('ulangi_password_baru') != $this->input->post('password_baru'))
		{
			$data['inputerror'][] = 'password_baru';
			$data['error_string'][] = 'Password Tidak Sama';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}