<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_review_ujian extends CI_Controller {

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
			'title' => 'Review Ujian', 
			'page' => 'v_review_ujian',
			'script' => 's_review_ujian',
		);
		$this->load->view('template', $data);
	}

	public function get_review_ujian()
	{
		$data = $this->m_review_ujian->get_review_ujian();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_review_ujian->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] = '';
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_review_ujian->count_all(),
			"recordsFiltered" => $this->m_review_ujian->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_review_ujian->get_by_id($id);
		echo json_encode($data);
	}
}