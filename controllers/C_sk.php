<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_sk extends CI_Controller {

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
			'title' => 'SK Checker', 
			'page' => 'v_sk',
			'script' => 's_sk',
		);
		$this->load->view('template', $data);
	}

	public function get_sk()
	{
		$data = $this->m_sk->get_sk();
		echo json_encode($data);
	}

	public function ajax_view_evidance($id)
	{
		$data = $this->m_sk->get_join_by_id($id);
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_sk->get_datatables();
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
				<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data('."'".$value->id_sk."'".')">Ubah</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$value->id_sk."'".')">Hapus</a>
				</div>
				</div>';
			}
			$row[] = $no;
			$row[] = $value->no_sk;
			$row[] = $value->tgl_terbit;
			$row[] = $value->tgl_berlaku;
			$row[] = $value->nama_lokasi;
			$row[] = '<a href="javascript:void(0)" title="Lihat SK" onclick="edit_data('."'".$value->id_sk."'".')">Lihat SK</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_sk->count_all(),
			"recordsFiltered" => $this->m_sk->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_peserta($id)
	{
		$list = $this->m_jadwal_ujian->get_datatables_peserta($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==1 || $this->session->userdata('id_tipe')==11) {
				if ($value->file_sk =='') {
					$row[] = '<form action="#" id="form_peserta'.$value->id.'"><input type="hidden" name="id" value="'.$value->id.'"><input id="file" type="file" name="file_sk" onchange="upload_sk('.$value->id.')"><br><small>* Format File : pdf, jpg, png</small>';
				} else {
					$row[] = '<a href="javascript:void(0)" class="text-danger" title="Hapus" onclick="delete_sk('."'".$value->id."'".')"><i class="fa fa-trash"></i></a>';
				}
			} 
			$row[] = '<a href="javascript:void(0)" title="Evidance" onclick="evidance('."'".$value->id."'".')"> '.' Evidance</a>';
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = $value->no_lisensi;
			$row[] = $value->nama_lokasi;
			if ($value->file_sk =='') {
				$row[] = '-';
			} else {
				$row[] = '<a href="'.base_url('assets/archive/'.$value->file_sk).'" target="_blank">Lihat File SK</a>';
			}
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_jadwal_ujian->count_all_peserta($id),
			"recordsFiltered" => $this->m_jadwal_ujian->count_filtered_peserta($id),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_evidance($id)
	{
		$list = $this->m_sk->get_datatables_evidance($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a class="btn btn-danger btn-xs btn-flat" href="javascript:void(0)" title="Delete" onclick="delete_evidance('."'".$value->id."'".')"><i class="fa fa-trash"></i></a>';
			$row[] = $value->evidance;

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_sk->count_all_evidance(),
			"recordsFiltered" => $this->m_sk->count_filtered_evidance($id),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_sk->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'id_lokasi' => $this->input->post('id_lokasi'),
			'id_permohonan' => $this->input->post('id_permohonan'),
			'no_sk' => $this->input->post('no_sk'),
			'tgl_terbit' => $this->input->post('tgl_terbit'),
			'tgl_berlaku' => date('Y-m-d', strtotime('+2 year')),
		);
		$insert = $this->m_sk->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate_update();
		$data = array(
			'id_lokasi' => $this->input->post('id_lokasi'),
			'id_permohonan' => $this->input->post('id_permohonan'),
			'no_sk' => $this->input->post('no_sk'),
			'tgl_terbit' => $this->input->post('tgl_terbit'),
			'tgl_berlaku' => date('Y-m-d', strtotime('+2 year')),
		);
		$this->m_sk->update(array('id_sk' => $this->input->post('id_sk')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_upload_sk()
	{
		if(!empty($_FILES['file_sk']['name']))
		{
			$upload = $this->_do_upload_file_sk();
			$data['file_sk'] = $upload;
		}
		$this->m_jadwal_ujian->update_peserta(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_evidance()
	{
		$data = array(
			'id' => $this->input->post('id'),
		);
		if(!empty($_FILES['evidance']['name']))
		{
			$upload = $this->_do_upload_file_evidance();
			$data['evidance'] = $upload;
		}
		$insert = $this->m_sk->save_evidance($data);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload_file_sk()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'SK-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file_sk'))
		{
			$data['inputerror'][] = 'file_sk';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _do_upload_file_evidance()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'Evidance-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('evidance'))
		{
			$data['inputerror'][] = 'evidance';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	public function ajax_delete_sk($id)
	{
		$row = $this->m_jadwal_ujian->get_peserta_by_id($id);
		if(file_exists('assets/archive/'.$row->file_sk) && $row->file_sk) {
			unlink('assets/archive/'.$row->file_sk);
		}
		$data = array(
			'file_sk' => '',
		);
		$this->m_jadwal_ujian->update_peserta(array('id' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$row = $this->m_sk->get_by_id($id);
		if(file_exists('assets/archive/'.$row->file_sk) && $row->file_sk) {
			unlink('assets/archive/'.$row->file_sk);
		}
		$this->m_sk->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_evidance($id)
	{
		$row = $this->m_sk->get_evidance_by_id($id);
		if(file_exists('assets/archive/'.$row->evidance) && $row->evidance) {
			unlink('assets/archive/'.$row->evidance);
		}
		$this->m_sk->delete_evidance_by_id($id);
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

		if($this->input->post('no_sk')=='')
		{
			$data['inputerror'][] = 'no_sk';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('tgl_terbit')=='')
		{
			$data['inputerror'][] = 'tgl_terbit';
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

		if($this->input->post('no_sk')=='')
		{
			$data['inputerror'][] = 'no_sk';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('tgl_terbit')=='')
		{
			$data['inputerror'][] = 'tgl_terbit';
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