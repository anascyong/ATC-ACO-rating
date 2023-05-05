<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {

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
			'title' => 'Dashboard',
			'page' => 'v_dashboard',
			'script' => 's_dashboard',
			'jadwal' => $this->m_jadwal_ujian->get_jadwal_aktif(),
			'mulai' => $this->m_jadwal_ujian->get_jadwal_mulai(),
			'selesai' => $this->m_jadwal_ujian->get_jadwal_selesai(),
			'ditolak' => $this->m_permohonan->get_permohonan_ditolak(),
			'verifikasi' => $this->m_permohonan->get_permohonan_baru(),
			'diterima' => $this->m_permohonan->get_permohonan_diterima(),
		);
		$this->load->view('template', $data);
	}
}