<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_peserta extends CI_Controller {

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
			'title' => 'Peserta Ujian', 
			'page' => 'v_peserta',
			'script' => 's_peserta',
		);
		$this->load->view('template', $data);
	}

	public function get_peserta()
	{
		$data = $this->m_peserta->get_peserta();
		echo json_encode($data);
	}

	public function get_jk()
	{
		$data = $this->m_peserta->get_jk();
		echo json_encode($data);
	}

	public function get_bidang()
	{
		$data = $this->m_peserta->get_bidang();
		echo json_encode($data);
	}

	public function get_lisensi()
	{
		$data = $this->m_peserta->get_lisensi();
		echo json_encode($data);
	}

	public function get_rating()
	{
		$data = $this->m_peserta->get_rating();
		echo json_encode($data);
	}

	public function get_negara()
	{
		$data = $this->m_peserta->get_negara();
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$list = $this->m_peserta->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==5) {
				$row[] =
				'<div class="dropdown no-arrow">
				<a class="dropdown-toggle btn btn-info btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-sm fa-fw fa-list"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="javascript:void(0)" title="Detail" onclick="view_data('."'".$value->id_user."'".')">Detail</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data('."'".$value->id_user."'".')">Ubah</a>
				</div>
				</div>';
			} else {
				$row[] =
				'<div class="dropdown no-arrow">
				<a class="dropdown-toggle btn btn-info btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-sm fa-fw fa-list"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="javascript:void(0)" title="Detail" onclick="view_data('."'".$value->id_user."'".')">Detail</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_data('."'".$value->id_user."'".')">Ubah</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$value->id_user."'".')">Hapus</a>
				</div>
				</div>';
			}
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = $value->no_lisensi;
			$row[] = $value->nama_bidang;
			$row[] = $value->no_hp;
			$row[] = $value->email;
			
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_peserta->count_all(),
			"recordsFiltered" => $this->m_peserta->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_lisensi()
	{
		$list = $this->m_peserta->get_datatables_lisensi();
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
			<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_lisensi('."'".$value->id."'".')">Ubah</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_lisensi('."'".$value->id."'".')">Hapus</a>
			</div>
			</div>';
			$row[] = $no;
			$row[] = $value->no_lisensi;
			$row[] = $value->nama_lisensi;
			$row[] = $value->tgl_terbit;
			$row[] = $value->tgl_berlaku;
			$row[] = '<a href="'.base_url('assets/archive/'.$value->file_lisensi).'" target="_blank" title="File Lisensi">File Lisensi</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_peserta->count_all_lisensi(),
			"recordsFiltered" => $this->m_peserta->count_filtered_lisensi(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_rating()
	{
		$list = $this->m_peserta->get_datatables_rating();
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
			<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_rating('."'".$value->id_history_rating."'".')">Ubah</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_rating('."'".$value->id_history_rating."'".')">Hapus</a>
			</div>
			</div>';
			$row[] = $no;
			$row[] = $value->nama_rating;
			$row[] = $value->tgl_terbit_rating;
			$row[] = $value->tgl_berlaku_rating;
			$row[] = '<a href="'.base_url('assets/archive/'.$value->file_rating).'" target="_blank" title="File Rating">File Rating</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_peserta->count_all_rating(),
			"recordsFiltered" => $this->m_peserta->count_filtered_rating(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_medex()
	{
		$list = $this->m_peserta->get_datatables_medex();
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
			<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_medex('."'".$value->id_medex."'".')">Ubah</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_medex('."'".$value->id_medex."'".')">Hapus</a>
			</div>
			</div>';
			$row[] = $no;
			$row[] = $value->no_sertifikat;
			$row[] = $value->hasil;
			$row[] = $value->tgl_dikeluarkan;
			$row[] = $value->tgl_berlaku;
			$row[] = '<a href="'.base_url('assets/archive/'.$value->file_sertifikat).'" target="_blank" title="File Sertifikat">File Sertifikat</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_peserta->count_all_medex(),
			"recordsFiltered" => $this->m_peserta->count_filtered_medex(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_icao()
	{
		$list = $this->m_peserta->get_datatables_icao();
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
			<a class="dropdown-item" href="javascript:void(0)" title="Ubah" onclick="edit_icao('."'".$value->id_icao."'".')">Ubah</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_icao('."'".$value->id_icao."'".')">Hapus</a>
			</div>
			</div>';
			$row[] = $no;
			$row[] = $value->no_sertifikat;
			$row[] = $value->level;
			$row[] = $value->tgl_dikeluarkan;
			$row[] = $value->tgl_berlaku;
			$row[] = '<a href="'.base_url('assets/archive/'.$value->file_sertifikat).'" target="_blank" title="File Sertifikat">File Sertifikat</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_peserta->count_all_icao(),
			"recordsFiltered" => $this->m_peserta->count_filtered_icao(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_serkom()
	{
		$list = $this->m_peserta->get_datatables_serkom();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $value->nama_bidang;
			$row[] = $value->nama_tipe_sertifikat_kompetensi;
			if ($value->file_sertifikat=='') {
				$row[] = '<form action="#" id="form_serkom'.$value->id_tipe_sertifikat_kompetensi.'">
				<input type="hidden" name="id_tipe_sertifikat_kompetensi" value="'.$value->id_tipe_sertifikat_kompetensi.'">
				<input type="hidden" name="id_bidang" value="'.$value->id_bidang.'">
				<input type="hidden" name="id_sk" value="'.$value->id_sk.'">
				<input id="file_serkom" type="file" name="file_sertifikat" onchange="upload_sertifikat('.$value->id_tipe_sertifikat_kompetensi.')"></form><br><small>* Format File : pdf, jpg, png</small>';
			} else {
				$row[] = '<a href="javascript:void(0)" class="text-danger" title="Hapus" onclick="delete_sertifikat('."'".$value->id_sk."'".')"><i class="fa fa-trash"></i></a> | <a href="'.base_url('assets/archive/'.$value->file_sertifikat).'" class="text-info" title="Lihat Sertifikat" target="_blank">Lihat Sertifikat</a>';
			}
			
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_peserta->count_all_serkom(),
			"recordsFiltered" => $this->m_peserta->count_filtered_serkom(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_serpel()
	{
		$list = $this->m_peserta->get_datatables_serpel();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $value->nama_tipe_sertifikat_pelatihan;
			if ($value->file_sertifikat=='') {
				$row[] = '<form action="#" id="form_serpel'.$value->id_tipe_sertifikat_pelatihan.'">
				<input type="hidden" name="id_tipe_sertifikat_pelatihan" value="'.$value->id_tipe_sertifikat_pelatihan.'">
				<input type="hidden" name="id_sp" value="'.$value->id_sp.'">
				<input id="file_serpel" type="file" name="file_sertifikat" onchange="upload_sertifikat_pelatihan('.$value->id_tipe_sertifikat_pelatihan.')"></form><br><small>* Format File : pdf, jpg, png</small>';
			} else {
				$row[] = '<a href="javascript:void(0)" class="text-danger" title="Hapus" onclick="delete_sertifikat_pelatihan('."'".$value->id_sp."'".')"><i class="fa fa-trash"></i></a> | <a href="'.base_url('assets/archive/'.$value->file_sertifikat).'" class="text-info" title="Lihat Sertifikat" target="_blank">Lihat Sertifikat</a>';
			}
			
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_peserta->count_all_serpel(),
			"recordsFiltered" => $this->m_peserta->count_filtered_serpel(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_get_peserta_by_lokasi($id)
	{
		$list = $this->m_peserta->get_datatables_peserta($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] =
			'<input type="checkbox" name="id_user[]" value="'.$value->id_user.'">';
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = $value->no_lisensi;
			$row[] = $value->nama_lokasi;
			
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_peserta->count_all_peserta($id),
			"recordsFiltered" => $this->m_peserta->count_filtered_peserta($id),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_peserta->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_lisensi($id)
	{
		$data = $this->m_peserta->get_lisensi_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_rating($id)
	{
		$data = $this->m_peserta->get_rating_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_medex($id)
	{
		$data = $this->m_peserta->get_medex_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_icao($id)
	{
		$data = $this->m_peserta->get_icao_by_id($id);
		echo json_encode($data);
	}

	public function ajax_view($id)
	{
		$data = $this->m_peserta->get_view_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add_new()
	{
		// $this->_validate();
		$data = array(
			'id_lokasi' => $this->input->post('id_lokasi'),
			'id_tipe' => 5,
			'id_jk' => $this->input->post('id_jk'),
			'nama_user' => $this->input->post('nama_user'),
			'no_lisensi' => $this->input->post('no_lisensi'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			//'id_negara' => $this->input->post('negara'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
			'keterangan' => $this->input->post('keterangan'),
			'status' => 1,
			'created' => date('Y-m-d H:i:s'),
			'creator' => $this->session->userdata('nama_user'),
		);
		if(!empty($_FILES['foto']['name']))
		{
			$upload = $this->_do_upload_foto();
			$data['foto'] = $upload;
		}
		if(!empty($_FILES['ktp']['name']))
		{
			$upload = $this->_do_upload_ktp();
			$data['ktp'] = $upload;
		}
		if(!empty($_FILES['ijazah']['name']))
		{
			$upload = $this->_do_upload_ijazah();
			$data['ijazah'] = $upload;
		}
		$insert = $this->m_peserta->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add()
	{
		//$this->_validate();
		$data = array(
			'id_lokasi' => $this->session->userdata('id_lokasi'),
			'id_tipe' => 5,
			'id_jk' => $this->input->post('id_jk'),
			'id_bidang' => $this->input->post('id_bidang'),
			'nama_user' => $this->input->post('nama_user'),
			'no_lisensi' => $this->input->post('no_lisensi'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			//'id_negara' => $this->input->post('negara'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'keterangan' => $this->input->post('keterangan'),
			'status' => 1,
			'created' => date('Y-m-d H:i:s'),
			'creator' => $this->session->userdata('nama_user'),
		);
		if(!empty($_FILES['lisensi_file']['name']))
		{
			$upload = $this->_do_upload_lisensi_file();
			$data['lisensi_file'] = $upload;
		}
		if(!empty($_FILES['rating_file']['name']))
		{
			$upload = $this->_do_upload_rating_file();
			$data['rating_file'] = $upload;
		}
		if(!empty($_FILES['medex_file']['name']))
		{
			$upload = $this->_do_upload_medex_file();
			$data['medex_file'] = $upload;
		}
		if(!empty($_FILES['ielp_file']['name']))
		{
			$upload = $this->_do_upload_ielp_file();
			$data['ielp_file'] = $upload;
		}
		if(!empty($_FILES['kompetensi_file']['name']))
		{
			$upload = $this->_do_upload_kompetensi_file();
			$data['kompetensi_file'] = $upload;
		}
		$insert = $this->m_peserta->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_lisensi()
	{
		// $this->_validate_lisensi();
		$data = array(
			'id_user' => $this->session->userdata('id_user'),
			'id_lisensi' => $this->input->post('id_lisensi'),
			'no_lisensi' => $this->input->post('no_lisensi'),
			'tgl_terbit' => $this->input->post('tgl_terbit'),
			'tgl_berlaku' => $this->input->post('tgl_berlaku'),
		);
		if(!empty($_FILES['file_lisensi']['name']))
		{
			$upload = $this->_do_upload_file_lisensi();
			$data['file_lisensi'] = $upload;
		}
		$insert = $this->m_peserta->save_lisensi($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_rating()
	{
		// $this->_validate_rating();
		$data = array(
			'id_user' => $this->session->userdata('id_user'),
			'id_lisensi' => $this->input->post('id_lisensi'),
			'id_rating' => $this->input->post('id_rating'),
			'tgl_terbit_rating' => $this->input->post('tgl_terbit_rating'),
			'tgl_berlaku_rating' => $this->input->post('tgl_berlaku_rating'),
		);
		if(!empty($_FILES['file_rating']['name']))
		{
			$upload = $this->_do_upload_file_rating();
			$data['file_rating'] = $upload;
		}
		$insert = $this->m_peserta->save_rating($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_medex()
	{
		// $this->_validate_medex();
		$data = array(
			'id_user' => $this->session->userdata('id_user'),
			'no_sertifikat' => $this->input->post('no_sertifikat'),
			'hasil' => $this->input->post('hasil'),
			'tgl_dikeluarkan' => $this->input->post('tgl_dikeluarkan'),
			'tgl_berlaku' => $this->input->post('tgl_berlaku'),
		);
		if(!empty($_FILES['file_sertifikat']['name']))
		{
			$upload = $this->_do_upload_file_sertifikat();
			$data['file_sertifikat'] = $upload;
		}
		$insert = $this->m_peserta->save_medex($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_icao()
	{
		// $this->_validate_icao();
		$data = array(
			'id_user' => $this->session->userdata('id_user'),
			'no_sertifikat' => $this->input->post('no_sertifikat'),
			'level' => $this->input->post('level'),
			'tgl_dikeluarkan' => $this->input->post('tgl_dikeluarkan'),
			'tgl_berlaku' => $this->input->post('tgl_berlaku'),
		);
		if(!empty($_FILES['file_sertifikat']['name']))
		{
			$upload = $this->_do_upload_file_sertifikat();
			$data['file_sertifikat'] = $upload;
		}
		$insert = $this->m_peserta->save_icao($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		//$this->_validate();
		$data = array(
			'id_lokasi' => $this->session->userdata('id_lokasi'),
			'id_tipe' => 5,
			'id_jk' => $this->input->post('id_jk'),
			'id_bidang' => $this->input->post('id_bidang'),
			'nama_user' => $this->input->post('nama_user'),
			'no_lisensi' => $this->input->post('no_lisensi'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			//'id_negara' => $this->input->post('negara'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'keterangan' => $this->input->post('keterangan'),
			'status' => 1,
			'edited' => date('Y-m-d H:i:s'),
			'editor' => $this->session->userdata('nama_user'),
		);
		if(!empty($_FILES['lisensi_file']['name']))
		{
			$upload = $this->_do_upload_lisensi_file();
			$value = $this->m_peserta->get_by_id($this->input->post('id_user'));
			if(file_exists('assets/archive/'.$value->lisensi_file) && $value->lisensi_file) {
				unlink('assets/archive/'.$value->lisensi_file);
			}
			$data['lisensi_file'] = $upload;
		}
		if(!empty($_FILES['rating_file']['name']))
		{
			$upload = $this->_do_upload_rating_file();
			$value = $this->m_peserta->get_by_id($this->input->post('id_user'));
			if(file_exists('assets/archive/'.$value->rating_file) && $value->rating_file) {
				unlink('assets/archive/'.$value->rating_file);
			}
			$data['rating_file'] = $upload;
		}
		if(!empty($_FILES['medex_file']['name']))
		{
			$upload = $this->_do_upload_medex_file();
			$value = $this->m_peserta->get_by_id($this->input->post('id_user'));
			if(file_exists('assets/archive/'.$value->medex_file) && $value->medex_file) {
				unlink('assets/archive/'.$value->medex_file);
			}
			$data['medex_file'] = $upload;
		}
		if(!empty($_FILES['ielp_file']['name']))
		{
			$upload = $this->_do_upload_ielp_file();
			$value = $this->m_peserta->get_by_id($this->input->post('id_user'));
			if(file_exists('assets/archive/'.$value->ielp_file) && $value->ielp_file) {
				unlink('assets/archive/'.$value->ielp_file);
			}
			$data['ielp_file'] = $upload;
		}
		if(!empty($_FILES['kompetensi_file']['name']))
		{
			$upload = $this->_do_upload_kompetensi_file();
			$value = $this->m_peserta->get_by_id($this->input->post('id_user'));
			if(file_exists('assets/archive/'.$value->kompetensi_file) && $value->kompetensi_file) {
				unlink('assets/archive/'.$value->kompetensi_file);
			}
			$data['kompetensi_file'] = $upload;
		}
		$this->m_peserta->update(array('id_user' => $this->input->post('id_user')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_upload_sertifikat()
	{
		$data = array(
			'id_user' => $this->session->userdata('id_user'),
			'id_bidang' => $this->input->post('id_bidang'),
			'id_tipe_sertifikat_kompetensi' => $this->input->post('id_tipe_sertifikat_kompetensi'),
		);
		if(!empty($_FILES['file_sertifikat']['name']))
		{
			$upload = $this->_do_upload_file_sertifikat();
			$data['file_sertifikat'] = $upload;
		}
		$insert = $this->m_peserta->save_serkom($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_upload_sertifikat_pelatihan()
	{
		$data = array(
			'id_user' => $this->session->userdata('id_user'),
			'id_tipe_sertifikat_pelatihan' => $this->input->post('id_tipe_sertifikat_pelatihan'),
		);
		if(!empty($_FILES['file_sertifikat']['name']))
		{
			$upload = $this->_do_upload_file_sertifikat();
			$data['file_sertifikat'] = $upload;
		}
		$insert = $this->m_peserta->save_serpel($data);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload_file_sertifikat()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'Sertifikat-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file_sertifikat'))
		{
			$data['inputerror'][] = 'file_sertifikat';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _do_upload_file_rating()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'Rating-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file_rating'))
		{
			$data['inputerror'][] = 'file_rating';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _do_upload_file_lisensi()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'Lisensi-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file_lisensi'))
		{
			$data['inputerror'][] = 'file_lisensi';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	public function ajax_submit($id)
	{
		$data = array(
			'status' => 2,
		);
		$this->m_peserta->update(array('id_user' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload_lisensi_file()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'Lisensi-'.date('Ymd').'-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('lisensi_file'))
		{
			$data['inputerror'][] = 'lisensi_file';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _do_upload_rating_file()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'Rating-'.date('Ymd').'-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('rating_file'))
		{
			$data['inputerror'][] = 'rating_file';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _do_upload_medex_file()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'MEDEX-'.date('Ymd').'-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('medex_file'))
		{
			$data['inputerror'][] = 'medex_file';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _do_upload_ielp_file()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'IELP-'.date('Ymd').'-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('ielp_file'))
		{
			$data['inputerror'][] = 'ielp_file';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _do_upload_kompetensi_file()
	{
		$config['upload_path']          = "./assets/archive";
		$config['allowed_types']        = 'pdf|jpg|jpeg|png';
		$config['file_name']            = 'Kompetensi-'.date('Ymd').'-'.uniqid();
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('kompetensi_file'))
		{
			$data['inputerror'][] = 'kompetensi_file';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	public function ajax_delete_sertifikat($id)
	{
		$row = $this->m_peserta->get_serkom_by_id($id);
		if(file_exists('assets/archive/'.$row->file_sertifikat) && $row->file_sertifikat) {
			unlink('assets/archive/'.$row->file_sertifikat);
		}
		$data = array(
			'file_sertifikat' => '',
		);
		$this->m_peserta->update_serkom(array('id_sk' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_sertifikat_pelatihan($id)
	{
		$row = $this->m_peserta->get_serpel_by_id($id);
		if(file_exists('assets/archive/'.$row->file_sertifikat) && $row->file_sertifikat) {
			unlink('assets/archive/'.$row->file_sertifikat);
		}
		$data = array(
			'file_sertifikat' => '',
		);
		$this->m_peserta->update_serpel(array('id_sp' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_lisensi($id)
	{
		$row = $this->m_peserta->get_lisensi_by_id($id);
		if(file_exists('assets/archive/'.$row->file_lisensi) && $row->file_lisensi) {
			unlink('assets/archive/'.$row->file_lisensi);
		}
		$this->m_peserta->delete_lisensi_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_rating($id)
	{
		$row = $this->m_peserta->get_rating_by_id($id);
		if(file_exists('assets/archive/'.$row->file_rating) && $row->file_rating) {
			unlink('assets/archive/'.$row->file_rating);
		}
		$this->m_peserta->delete_rating_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$row = $this->m_peserta->get_by_id($id);
		if(file_exists('assets/archive/'.$row->lisensi_file) && $row->lisensi_file) {
			unlink('assets/archive/'.$row->lisensi_file);
		}
		if(file_exists('assets/archive/'.$row->rating_file) && $row->rating_file) {
			unlink('assets/archive/'.$row->rating_file);
		}
		if(file_exists('assets/archive/'.$row->medex_file) && $row->medex_file) {
			unlink('assets/archive/'.$row->medex_file);
		}
		if(file_exists('assets/archive/'.$row->ielp_file) && $row->ielp_file) {
			unlink('assets/archive/'.$row->ielp_file);
		}
		if(file_exists('assets/archive/'.$row->kompetensi_file) && $row->kompetensi_file) {
			unlink('assets/archive/'.$row->kompetensi_file);
		}
		$this->m_peserta->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('id_jk')=='')
		{
			$data['inputerror'][] = 'id_jk';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('id_bidang')=='')
		{
			$data['inputerror'][] = 'id_bidang';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_user')=='')
		{
			$data['inputerror'][] = 'nama_user';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('no_lisensi')=='')
		{
			$data['inputerror'][] = 'no_lisensi';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('tempat_lahir')=='')
		{
			$data['inputerror'][] = 'tempat_lahir';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('tanggal_lahir')=='')
		{
			$data['inputerror'][] = 'tanggal_lahir';
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
			$data['error_string'][] = 'Password Tidak Sama';
			$data['status'] = FALSE;
		}

		if($this->input->post('ulangi_password') != $this->input->post('password'))
		{
			$data['inputerror'][] = 'ulangi_password';
			$data['error_string'][] = 'Password Tidak Sama';
			$data['status'] = FALSE;
		}

		// if (empty($_FILES['foto']['name'])) {
		// 	$data['inputerror'][] = 'foto';
		// 	$data['error_string'][] = 'Tidak Boleh Kosong';
		// 	$data['status'] = FALSE;
		// }

		// if (empty($_FILES['ktp']['name'])) {
		// 	$data['inputerror'][] = 'ktp';
		// 	$data['error_string'][] = 'Tidak Boleh Kosong';
		// 	$data['status'] = FALSE;
		// }

		// if (empty($_FILES['ijazah']['name'])) {
		// 	$data['inputerror'][] = 'ijazah';
		// 	$data['error_string'][] = 'Tidak Boleh Kosong';
		// 	$data['status'] = FALSE;
		// }

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}