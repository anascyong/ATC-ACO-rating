<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		// if ($this->session->userdata('id_user')) {
		// 	redirect('/');
		// }
		$this->form_validation->set_message('matches', '<small style="color: red">Password Tidak Sama</small>');
		$this->form_validation->set_message('required', '<small style="color: red">Tidak Boleh Kosong</small>');
		$this->form_validation->set_message('is_unique', '<small style="color: red">Sudah Digunakan</small>');
	}

	public function index()
	{
		$data = array(
			'title' => 'Login',
		);
		$this->load->view('v_login', $data);
	}

	public function registrasi()
	{
		$data = array(
			'title' => 'Registrasi',
		);
		$this->load->view('v_registrasi', $data);
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array (
				'username' => $this->input->post('username', TRUE),
				'password' => $this->input->post('password', TRUE),
			);
			$hasil = $this->my_model->login($data);
			if ($hasil->num_rows() == 1) {
				foreach ($hasil->result() as $sess) {
					$sess_data['logged_in'] = 'Sudah Login';
					$sess_data['id_user'] = $sess->id_user;
					$sess_data['id_tipe'] = $sess->id_tipe;
					$sess_data['id_lokasi'] = $sess->id_lokasi;
					$sess_data['id_bidang'] = $sess->id_bidang;
					$sess_data['nama_user'] = $sess->nama_user;
					$sess_data['status'] = $sess->status;
					$this->session->set_userdata($sess_data);
				}
				if ($sess->status == 0) {
					$this->session->set_flashdata('pesan', 
						'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Akun Belum Aktif, Dalam Proses Moderasi</div>'
					);
					redirect($this->agent->referrer());
				} else {
					$last_login = array(
						'last_login' => date('Y-m-d H:i:s'), 
					);
					$this->db->update('m_user', $last_login, array('id_user' => $sess->id_user));
					$this->session->set_userdata($last_login);
					redirect('/');
				}
			}
			$this->session->set_flashdata('pesan', 
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Username & Password Salah</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
