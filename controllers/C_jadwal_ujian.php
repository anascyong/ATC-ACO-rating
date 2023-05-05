<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jadwal_ujian extends CI_Controller {

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
			'title' => 'Jadwal Assessment', 
			'page' => 'v_jadwal_ujian',
			'script' => 's_jadwal_ujian',
		);
		$this->load->view('template', $data);
	}

	public function get_jadwal_ujian()
	{
		$data = $this->m_jadwal_ujian->get_jadwal_ujian();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_jadwal_ujian->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$jumlah = $this->db->get_where('m_jadwal_kegiatan_assessment', array(
				'id_jadwal_assessment' => $value->id_jadwal_assessment,
			));
			$asesor = $this->db->get_where('m_asesor_assessment', array(
				'id_jadwal_assessment' => $value->id_jadwal_assessment,
			));
			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==1) {
				$row[] = 
				'<div class="dropdown no-arrow">
				<a class="dropdown-toggle btn btn-info btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-sm fa-fw fa-list"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data('."'".$value->id_jadwal_assessment."'".')">Ubah</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$value->id_jadwal_assessment."'".')">Hapus</a>
				</div>
				</div>';
			}
			$row[] = $no;
			$row[] = $value->keterangan;
			$row[] = $value->nama_lokasi;
			$row[] = '<a href="javascript:void(0)" onclick="detail_data_kegiatan('."'".$value->id_jadwal_assessment."'".')"><b>'.$jumlah->num_rows().'</b> Detail Kegiatan Pengujian</a>';
			$row[] = '<a href="javascript:void(0)" onclick="detail_data_asesor('."'".$value->id_jadwal_assessment."'".')"><b>'.$asesor->num_rows().'</b> Examiner</a>';
			if ($value->status_jadwal==0) {
				$row[] = 'Draft';
			} else {
				$row[] = 'Publish';
			}
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_jadwal_ujian->count_all(),
			"recordsFiltered" => $this->m_jadwal_ujian->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_kegiatan($id)
	{
		$list = $this->m_jadwal_ujian->get_datatables_kegiatan($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$jumlah = $this->db->get_where('m_peserta_ujian_assessment', array(
				'id_kegiatan_assessment' => $value->id_kegiatan_assessment,
			));
			$check = $this->db->get_where('m_peserta_ujian_assessment', array(
				'id_kegiatan_assessment' => $value->id_kegiatan_assessment,
				'id_user' => $this->session->userdata('id_user'),
				'nilai' => null
			));
			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==1) {
				$row[] = 
				'<div class="dropdown no-arrow">
				<a class="dropdown-toggle btn btn-info btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-sm fa-fw fa-list"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data_kegiatan('."'".$value->id_kegiatan_assessment."'".')">Ubah</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data_kegiatan('."'".$value->id_kegiatan_assessment."'".')">Hapus</a>
				</div>
				</div>';
			}
			if ($this->session->userdata('id_tipe')==5) {
				if ($check->num_rows()==1 && $value->mulai==1) {
					$row[] = '<a href="javascript:void(0)" class="btn btn-info btn-circle btn-sm" onclick="mulai_ujian('."'".$value->id_kegiatan_assessment."'".')" title="Mulai Ujian"><i class="fas fa-play"></i></a>';
				} elseif ($check->num_rows()==1 && $value->mulai==0) {
					$row[] = 'Belum Dimulai';
				} else {
					$row[] = 'Selesai';
				}
			}
			$row[] = $no;
			$row[] = $value->kegiatan;
			$row[] = $value->hari;
			$row[] = $value->tanggal;
			$row[] = $value->dari_pukul.' s/d '.$value->sampai_pukul.' '.$value->waktu;
			if ($this->session->userdata('id_tipe')!=5) {
				$row[] = '<a href="javascript:void(0)" onclick="detail_data_peserta('."'".$value->id_kegiatan_assessment."'".')"><b>'.$jumlah->num_rows().'</b> Peserta</a>';
			}
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_jadwal_ujian->count_all_kegiatan($id),
			"recordsFiltered" => $this->m_jadwal_ujian->count_filtered_kegiatan($id),
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
			if ($this->session->userdata('id_tipe')==1) {
				$row[] = '<a href="javascript:void(0)" class="btn btn-danger btn-circle btn-sm" onclick="delete_data_peserta('."'".$value->id."'".')"><i class="fas fa-trash"></i></a>';
			}
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = $value->no_lisensi;
			$row[] = $value->nama_lokasi;
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

	public function ajax_list_asesor($id)
	{
		$list = $this->m_jadwal_ujian->get_datatables_asesor($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {

			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==1) {
				$row[] = '<a href="javascript:void(0)" class="btn btn-danger btn-circle btn-sm" onclick="delete_data_asesor('."'".$value->id_asesor."'".')"><i class="fas fa-trash"></i></a>';
			}
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = 'Examiner';
			$row[] = 'DNP';
			$row[] = $value->no_surat_tugas;
			$row[] = $value->tgl_mulai.' s/d '. $value->tgl_selesai;
			$row[] = '<a href="'.base_url('assets/archive/'.$value->file_surat_tugas).'" target="_blank">File Surat Tugas</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_jadwal_ujian->count_all_asesor($id),
			"recordsFiltered" => $this->m_jadwal_ujian->count_filtered_asesor($id),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_pilih_asesor()
	{
		$list = $this->m_jadwal_ujian->get_datatables_pilih_asesor();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] =
			'<input type="checkbox" name="id_user[]" value="'.$value->id_user.'">';
			// $row[] = '<input type="radio" name="ketua" value="'.$value->id_user.'">';
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = 'Examiner';
			$row[] = 'DNP';
			
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_jadwal_ujian->count_all_pilih_asesor(),
			"recordsFiltered" => $this->m_jadwal_ujian->count_filtered_pilih_asesor(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_jadwal_ujian->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_kegiatan($id)
	{
		$data = $this->m_jadwal_ujian->get_kegiatan_by_id($id);
		echo json_encode($data);
	}

	public function ajax_view($id)
	{
		$data = $this->m_jadwal_ujian->get_view_by_id($id);
		echo json_encode($data);
	}

	public function ajax_review($id,$id2)
	{
		$data = $this->m_jadwal_ujian->get_review_by_id($id,$id2);
		echo json_encode($data);
	}

	public function ajax_view_peserta($id)
	{
		$data = $this->m_jadwal_ujian->get_view_peserta_by_id($id);
		echo json_encode($data);
	}

	public function ajax_view_asesor($id)
	{
		$data = $this->m_jadwal_ujian->get_view_asesor_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'id_permohonan' => $this->input->post('id_permohonan'),
			'id_lokasi' => $this->input->post('id_lokasi'),
			'status_jadwal' => $this->input->post('status_jadwal'),
		);
		$insert = $this->m_jadwal_ujian->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_kegiatan()
	{
		$this->_validate_kegiatan();
		$tanggal = $this->input->post('tanggal');
		$hari = date('D', strtotime($tanggal));
		$awal = strtotime($this->input->post('tanggal').' '.$this->input->post('dari_pukul'));
		$akhir = strtotime($this->input->post('tanggal').' '.$this->input->post('sampai_pukul'));
		$diff = $akhir - $awal;
		$jam = floor($diff / (60 * 60));
		$menit = $diff - $jam * (60 * 60);
		$waktu = $diff / 60;
		$hari_indonesia = array(
			'Mon'  => 'Senin',
			'Tue'  => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu',
			'Sun' => 'Minggu'
		);
		$data = array(
			'id_jadwal_assessment' => $this->input->post('id_jadwal_assessment'),
			'id_kategori' => $this->input->post('id_kategori'),
			'kegiatan' => $this->input->post('kegiatan'),
			'hari' => $hari_indonesia[$hari],
			'tanggal' => $this->input->post('tanggal'),
			'dari_pukul' => $this->input->post('dari_pukul'),
			'sampai_pukul' => $this->input->post('sampai_pukul'),
			'waktu' => $this->input->post('waktu'),
			'durasi' => $waktu
		);
		$id = $this->m_jadwal_ujian->save_kegiatan($data);
		$query = $this->db->get_where('m_jadwal_assessment2', array(
			'id_jadwal_assessment' => $this->input->post('id_jadwal_assessment'),
		));
		foreach ($query->result() as $value) {
			$peserta = $this->db->get_where('m_peserta_permohonan_assessment', array(
				'id_permohonan' => $value->id_permohonan,
			));
			foreach ($peserta->result() as $row) {
				$data_peserta = array(
					'id_kegiatan_assessment' => $id,
					'id_user' => $row->id_user,
				);
				$check = $this->db->get_where('m_peserta_ujian_assessment', array(
					'id_kegiatan_assessment' => $id,
					'id_user' => $row->id_user,
				));
				if ($check->num_rows()==0) {
					$insert = $this->m_jadwal_ujian->save_peserta($data_peserta);
				}
			}
		}
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_peserta()
	{
		$user = $this->input->post('id_user');
		$result = array();
		foreach($user AS $key => $val) {
			$data = array(
				'id_kegiatan_assessment' => $this->input->post('id_kegiatan_assessment'),
				'id_user' => $this->input->post('id_user')[$key],
			);
			$check = $this->db->get_where('m_peserta_ujian_assessment', array(
				'id_kegiatan_assessment' => $this->input->post('id_kegiatan_assessment'),
				'id_user' => $this->input->post('id_user')[$key],
			));
			if ($check->num_rows()==0) {
				$insert = $this->m_jadwal_ujian->save_peserta($data);
			}
		}
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_asesor()
	{
		$user = $this->input->post('id_user');
		$result = array();
		foreach($user AS $key => $val) {
			$data = array(
				'id_jadwal_assessment' => $this->input->post('id_jadwal_assessment'),
				'id_user' => $this->input->post('id_user')[$key],
				'no_surat_tugas' => $this->input->post('no_surat_tugas'),
				'tgl_mulai' => $this->input->post('tgl_mulai'),
				'tgl_selesai' => $this->input->post('tgl_selesai'),
				// 'ketua' => $this->input->post('ketua'),
			);
			if(!empty($_FILES['file_surat_tugas']['name']))
			{
				$upload = $this->_do_upload_file_surat_tugas();
				$data['file_surat_tugas'] = $upload;
			}
			$check = $this->db->get_where('m_asesor_assessment', array(
				'id_jadwal_assessment' => $this->input->post('id_jadwal_assessment'),
				'id_user' => $this->input->post('id_user')[$key],
			));
			if ($check->num_rows()==0) {
				$insert = $this->m_jadwal_ujian->save_asesor($data);
			}
		}
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload_file_surat_tugas()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'Surat-Tugas-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file_surat_tugas'))
		{
			$data['inputerror'][] = 'file_surat_tugas';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'id_permohonan' => $this->input->post('id_permohonan'),
			'id_lokasi' => $this->input->post('id_lokasi'),
			'status_jadwal' => $this->input->post('status_jadwal'),
		);
		$this->m_jadwal_ujian->update(array('id_jadwal_assessment' => $this->input->post('id_jadwal_assessment')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_kegiatan()
	{
		$this->_validate_kegiatan();
		$tanggal = $this->input->post('tanggal');
		$hari = date('D', strtotime($tanggal));
		$awal = strtotime($this->input->post('tanggal').' '.$this->input->post('dari_pukul'));
		$akhir = strtotime($this->input->post('tanggal').' '.$this->input->post('sampai_pukul'));
		$diff = $akhir - $awal;
		$jam = floor($diff / (60 * 60));
		$menit = $diff - $jam * (60 * 60);
		$waktu = $diff / 60;
		$hari_indonesia = array(
			'Mon'  => 'Senin',
			'Tue'  => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu',
			'Sun' => 'Minggu'
		);
		$data = array(
			'id_jadwal_assessment' => $this->input->post('id_jadwal_assessment'),
			'id_kategori' => $this->input->post('id_kategori'),
			'kegiatan' => $this->input->post('kegiatan'),
			'hari' => $hari_indonesia[$hari],
			'tanggal' => $this->input->post('tanggal'),
			'dari_pukul' => $this->input->post('dari_pukul'),
			'sampai_pukul' => $this->input->post('sampai_pukul'),
			'waktu' => $this->input->post('waktu'),
			'durasi' => $waktu
		);
		$this->m_jadwal_ujian->update_kegiatan(array('id_kegiatan_assessment' => $this->input->post('id_kegiatan_assessment')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->m_jadwal_ujian->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_kegiatan($id)
	{
		$this->m_jadwal_ujian->delete_kegiatan_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_peserta($id)
	{
		$this->m_jadwal_ujian->delete_peserta_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_asesor($id)
	{
		$row = $this->m_jadwal_ujian->get_asesor_by_id($id);
		if(file_exists('assets/archive/'.$row->file_surat_tugas) && $row->file_surat_tugas) {
			unlink('assets/archive/'.$row->file_surat_tugas);
		}
		$this->m_jadwal_ujian->delete_asesor_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('id_permohonan')=='')
		{
			$data['inputerror'][] = 'id_permohonan';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('id_lokasi')=='')
		{
			$data['inputerror'][] = 'id_lokasi';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('status_jadwal')=='')
		{
			$data['inputerror'][] = 'status_jadwal';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_kegiatan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kegiatan')=='')
		{
			$data['inputerror'][] = 'kegiatan';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('tanggal')=='')
		{
			$data['inputerror'][] = 'tanggal';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('dari_pukul')=='')
		{
			$data['inputerror'][] = 'dari_pukul';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('sampai_pukul')=='')
		{
			$data['inputerror'][] = 'sampai_pukul';
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