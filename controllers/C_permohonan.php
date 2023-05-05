<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_permohonan extends CI_Controller {

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
			'title' => 'Permohonan Assessment', 
			'page' => 'v_permohonan',
			'script' => 's_permohonan',
		);
		$this->load->view('template', $data);
	}

	public function get_permohonan()
	{
		$data = $this->m_permohonan->get_permohonan();
		echo json_encode($data);
	}

	public function get_permohonan_by_id_lokasi($id)
	{
		$data = $this->m_permohonan->get_permohonan_by_id_lokasi($id);
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_permohonan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$jumlah = $this->db->get_where('m_peserta_permohonan_assessment', array(
				'id_permohonan' => $value->id_permohonan,
			));
			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==1) {
				if ($value->status==2) {
					$row[] = '<a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="verifikasi_data('."'".$value->id_permohonan."'".')">Verifikasi</a>';
				} else {
					$row[] = '<i class="fas fa-check"></i>';
				}
			} else {
				if ($value->status <= 1) {
					$row[] =
					'<div class="dropdown no-arrow">
					<a class="dropdown-toggle btn btn-info btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-sm fa-fw fa-list"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="javascript:void(0)" onclick="edit_data('."'".$value->id_permohonan."'".')">Ubah</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="javascript:void(0)" onclick="delete_data('."'".$value->id_permohonan."'".')">Hapus</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="javascript:void(0)" onclick="send_data('."'".$value->id_permohonan."'".')">Kirim</a>
					</div>
					</div>';
				} elseif ($value->status == 2) {
					$row[] =
					'<div class="dropdown no-arrow">
					<a class="dropdown-toggle btn btn-info btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-sm fa-fw fa-list"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="javascript:void(0)" onclick="edit_data('."'".$value->id_permohonan."'".')">Ubah</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="javascript:void(0)" onclick="delete_data('."'".$value->id_permohonan."'".')">Hapus</a>
					</div>
					</div>';
				} elseif ($value->status == 3) {
					$row[] =
					'<button href="#" class="btn btn-info btn-circle btn-sm" disabled="true">
					<i class="fas fa-sm fa-fw fa-list"></i>
					</button>';
				}
			}
			$row[] = $no;
			$row[] = $value->no_surat;
			$row[] = $value->tgl_surat;
			$row[] = $value->keterangan;
			if ($this->session->userdata('id_tipe')==1) {
				$row[] = $value->nama_lokasi;
			}
			$row[] = '<a href="'.base_url('assets/archive/'.$value->surat_permohonan).'" target="_blank">Lihat Surat Permohonan</a>';
			$row[] = '<a href="javascript:void(0)" onclick="data_peserta('."'".$value->id_permohonan."'".')">'.$jumlah->num_rows().' Peserta</a>';
			if ($value->status==0) {
				$row[] = 'Ditolak';
			}
			if ($value->status==1) {
				$row[] = 'Draft';
			}
			if ($value->status==2) {
				$row[] = 'Verifikasi';
			}
			if ($value->status==3) {
				$row[] = 'Diterima';
			}
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_permohonan->count_all(),
			"recordsFiltered" => $this->m_permohonan->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_peserta($id)
	{
		$list = $this->m_permohonan->get_datatables_peserta($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$query = $this->db->get_where('m_permohonan_assessment', array(
				'id_permohonan' => $value->id_permohonan,
				'status' => 2,
			));
			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==13) {
				if ($query->num_rows()==1) {
					$row[] = '<a href="javascript:void(0)" class="btn btn-danger btn-circle btn-sm" onclick="delete_data_peserta('."'".$value->id."'".')"><i class="fas fa-trash"></i></a>';
				} else {
					$row[] = '<i class="fa fa-check"></i>';
				}
			} else {
				if ($query->num_rows()==1) {
					$row[] = '<a href="javascript:void(0)" onclick="verifikasi_data_peserta('."'".$value->id."'".')">Verifikasi</a>';
				} else {
					$row[] = '<i class="fa fa-check"></i>';
				}
			}
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = $value->no_lisensi;
			$row[] = $value->nama_lokasi;
			if ($value->status_peserta == 0) {
				$row[] = 'Tidak Lengkap';
			} elseif ($value->status_peserta == 1) {
				$row[] = 'Verifikasi';
			} elseif ($value->status_peserta == 2) {
				$row[] = 'Lengkap';
			}
			$row[] = $value->catatan_peserta;
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_permohonan->count_all_peserta($id),
			"recordsFiltered" => $this->m_permohonan->count_filtered_peserta($id),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_permohonan->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_view($id)
	{
		$data = $this->m_permohonan->get_view_by_id($id);
		echo json_encode($data);
	}

	public function ajax_view_peserta($id)
	{
		$data = $this->m_permohonan->get_view_peserta_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'no_surat' => $this->input->post('no_surat'),
			'tgl_surat' => $this->input->post('tgl_surat'),
			'tgl_permohonan' => date('Y-m-d H:i:s'),
			'id_lokasi' => $this->session->userdata('id_lokasi'),
			'keterangan' => $this->input->post('keterangan'),
			'status' => 1,
			'created' => date('Y-m-d H:i:s'),
			'creator' => $this->session->userdata('nama_user'),
		);
		if(!empty($_FILES['surat_permohonan']['name']))
		{
			$upload = $this->_do_upload_surat_permohonan();
			$data['surat_permohonan'] = $upload;
		}
		$id = $this->m_permohonan->save($data);
		$user = $this->input->post('id_user');
		$result = array();
		foreach($user AS $key => $val) {
			$peserta = array(
				'id_permohonan' => $id,
				'id_user' => $this->input->post('id_user')[$key],
				'status_peserta' => 1,
			);
			$insert = $this->m_permohonan->save_peserta($peserta);
		}
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_peserta()
	{
		$user = $this->input->post('id_user');
		$result = array();
		foreach($user AS $key => $val) {
			$data = array(
				'id_permohonan' => $this->input->post('id_permohonan'),
				'id_user' => $this->input->post('id_user')[$key],
				'status_peserta' => 1,
			);
			$check = $this->db->get_where('m_peserta_permohonan_assessment', array(
				'id_permohonan' => $this->input->post('id_permohonan'),
				'id_user' => $this->input->post('id_user')[$key],
			));
			if ($check->num_rows()==0) {
				$insert = $this->m_permohonan->save_peserta($data);
			}
		}
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
			'no_surat' => $this->input->post('no_surat'),
			'tgl_surat' => $this->input->post('tgl_surat'),
			'tgl_permohonan' => date('Y-m-d H:i:s'),
			'id_lokasi' => $this->session->userdata('id_lokasi'),
			'keterangan' => $this->input->post('keterangan'),
			'status' => 1,
			'edited' => date('Y-m-d H:i:s'),
			'editor' => $this->session->userdata('nama_user'),
		);
		if(!empty($_FILES['surat_permohonan']['name']))
		{
			$upload = $this->_do_upload_surat_permohonan();
			$value = $this->m_permohonan->get_by_id($this->input->post('id_permohonan'));
			if(file_exists('assets/archive/'.$value->surat_permohonan) && $value->surat_permohonan) {
				unlink('assets/archive/'.$value->surat_permohonan);
			}
			$data['surat_permohonan'] = $upload;
		}
		$this->m_permohonan->update(array('id_permohonan' => $this->input->post('id_permohonan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_kirim($id)
	{
		$data = array(
			'status' => 2,
		);
		$this->m_permohonan->update(array('id_permohonan' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_terima()
	{
		$data = array(
			'status' => 3,
			'catatan' => $this->input->post('catatan')
		);
		$this->m_permohonan->update(array('id_permohonan' => $this->input->post('id_permohonan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_tolak()
	{
		$data = array(
			'status' => 0,
			'catatan' => $this->input->post('catatan')
		);
		$this->m_permohonan->update(array('id_permohonan' => $this->input->post('id_permohonan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_lengkap()
	{
		$data = array(
			'status_peserta' => 2,
			'catatan_peserta' => $this->input->post('catatan_peserta')
		);
		$this->m_permohonan->update_peserta(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_Tidak_lengkap()
	{
		$data = array(
			'status_peserta' => 0,
			'catatan_peserta' => $this->input->post('catatan_peserta')
		);
		$this->m_permohonan->update_peserta(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload_surat_permohonan()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf';
		$config['file_name']            = 'Surat-Permohonan-'.date('Y-m-d-H-i-s').'-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('surat_permohonan'))
		{
			$data['inputerror'][] = 'surat_permohonan';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	public function ajax_delete($id)
	{
		$row = $this->m_permohonan->get_by_id($id);
		if(file_exists('assets/archive/'.$row->surat_permohonan) && $row->surat_permohonan) {
			unlink('assets/archive/'.$row->surat_permohonan);
		}
		$this->m_permohonan->delete_by_id($id);
		$this->m_permohonan->delete_all_peserta_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_peserta($id)
	{
		$this->m_permohonan->delete_peserta_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('no_surat')=='')
		{
			$data['inputerror'][] = 'no_surat';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('tgl_surat')=='')
		{
			$data['inputerror'][] = 'tgl_surat';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if (empty($_FILES['surat_permohonan']['name'])) {
			$data['inputerror'][] = 'surat_permohonan';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('keterangan')=='')
		{
			$data['inputerror'][] = 'keterangan';
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