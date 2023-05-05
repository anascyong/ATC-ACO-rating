<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_hasil_ujian extends CI_Controller {

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
			'title' => 'Hasil Ujian', 
			'page' => 'v_hasil_ujian',
			'script' => 's_hasil_ujian',
		);
		$this->load->view('template', $data);
	}

	public function get_hasil_ujian()
	{
		$data = $this->m_hasil_ujian->get_hasil_ujian();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_hasil_ujian->get_datatables();
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
			<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="javascript:void(0)" title="Nilai Ujian" onclick="edit_data('."'".$value->id."'".')">Nilai Ujian</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$value->id."'".')">Hapus</a>
			</div>
			</div>';
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = $value->no_identitas;
			$row[] = $value->jenis_kelamin;
			$row[] = $value->tempat_lahir.', '.$value->tanggal_lahir;
			$row[] = $value->nama_lembaga;
			$row[] = 'Teori :<br>'.'<b>'.$value->nilai.'</b><br>'.'Re-check Teori :<br>'.'<b>'.$value->nilai_recheck_teori.'</b><br>'.'Praktek :<br>'.'<b>'.$value->nilai_praktek.'</b><br>'.'Re-check Praktek :<br>'.'<b>'.$value->nilai_recheck_praktek.'</b><br>';
			$row[] = '';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_hasil_ujian->count_all(),
			"recordsFiltered" => $this->m_hasil_ujian->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_hasil_ujian->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$data = array(
			'nilai' => $this->input->post('nilai'),
			'nilai_recheck_teori' => $this->input->post('nilai_recheck_teori'),
			'nilai_praktek' => $this->input->post('nilai_praktek'),
			'nilai_recheck_praktek' => $this->input->post('nilai_recheck_praktek'),
		);
		$this->m_hasil_ujian->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
}