<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_berita_acara extends CI_Controller {

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
			'title' => 'Berita Acara', 
			'page' => 'v_berita_acara',
			'script' => 's_berita_acara',
		);
		$this->load->view('template', $data);
	}

	public function get_berita_acara()
	{
		$data = $this->m_berita_acara->get_berita_acara();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_berita_acara->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==1 || $this->session->userdata('id_tipe')==11) {
				$row[] = 
				'<div class="dropdown no-arrow">
				<a class="dropdown-toggle btn btn-info btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-sm fa-fw fa-list"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-left shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data('."'".$value->id_ba."'".')">Ubah</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$value->id_ba."'".')">Hapus</a>
				</div>
				</div>';
			}
			$row[] = $no;
			$row[] = $value->no_ba;
			$row[] = $value->nama_lokasi;
			$row[] = $value->keterangan;
			$row[] = '<a href="'.base_url('assets/archive/'.$value->file_ba).'" target="_blank" title="Lihat">Lihat Berita Acara</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_berita_acara->count_all(),
			"recordsFiltered" => $this->m_berita_acara->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_berita_acara->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'id_lokasi' => $this->input->post('id_lokasi'),
			'id_permohonan' => $this->input->post('id_permohonan'),
			'no_ba' => $this->input->post('no_ba'), 
		);
		if(!empty($_FILES['file_ba']['name']))
		{
			$upload = $this->_do_upload_file_ba();
			$data['file_ba'] = $upload;
		}
		$insert = $this->m_berita_acara->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate_update();
		$data = array(
			'id_lokasi' => $this->input->post('id_lokasi'),
			'id_permohonan' => $this->input->post('id_permohonan'),
			'no_ba' => $this->input->post('no_ba'), 
		);
		if(!empty($_FILES['file_ba']['name']))
		{
			$upload = $this->_do_upload_file_ba();
			$value = $this->m_berita_acara->get_by_id($this->input->post('id_ba'));
			if(file_exists('assets/archive/'.$value->file_ba) && $value->file_ba) {
				unlink('assets/archive/'.$value->file_ba);
			}
			$data['file_ba'] = $upload;
		}
		$this->m_berita_acara->update(array('id_ba' => $this->input->post('id_ba')), $data);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload_file_ba()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'BA-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file_ba'))
		{
			$data['inputerror'][] = 'file_ba';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	public function ajax_delete($id)
	{
		$row = $this->m_berita_acara->get_by_id($id);
		if(file_exists('assets/archive/'.$row->file_ba) && $row->file_ba) {
			unlink('assets/archive/'.$row->file_ba);
		}
		$this->m_berita_acara->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('id_lokasi')=='')
		{
			$data['inputerror'][] = 'id_lokasi';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('id_permohonan')=='')
		{
			$data['inputerror'][] = 'id_permohonan';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('no_ba')=='')
		{
			$data['inputerror'][] = 'no_ba';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if (empty($_FILES['file_ba']['name'])) {
			$data['inputerror'][] = 'file_ba';
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

		if($this->input->post('id_lokasi')=='')
		{
			$data['inputerror'][] = 'id_lokasi';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('id_permohonan')=='')
		{
			$data['inputerror'][] = 'id_permohonan';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('no_ba')=='')
		{
			$data['inputerror'][] = 'no_ba';
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