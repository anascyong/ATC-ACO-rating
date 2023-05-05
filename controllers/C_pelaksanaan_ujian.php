<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pelaksanaan_ujian extends CI_Controller {

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
			'title' => 'Pelaksanaan & Hasil Assessment', 
			'page' => 'v_pelaksanaan_ujian',
			'script' => 's_pelaksanaan_ujian',
		);
		$this->load->view('template', $data);
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
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $value->keterangan;
			$row[] = $value->nama_lokasi;
			$row[] = '<a href="javascript:void(0)" onclick="detail_data_kegiatan('."'".$value->id_jadwal_assessment."'".')"><b>'.$jumlah->num_rows().'</b> Detail Kegiatan Pengujian</a>';
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

	public function ajax_list_kegiatan_teori($id)
	{
		$list = $this->m_jadwal_ujian->get_datatables_kegiatan_teori($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$jumlah = $this->db->get_where('m_peserta_ujian_assessment', array(
				'id_kegiatan_assessment' => $value->id_kegiatan_assessment,
			));
			$no++;
			$row = array();
			if ($this->session->userdata('id_tipe')==1 || $this->session->userdata('id_tipe')==11 || $this->session->userdata('id_tipe')==10) {
				if ($value->mulai==0) {
					$row[] = '<a href="javascript:void(0)" class="btn btn-info btn-circle btn-sm" onclick="mulai_ujian('."'".$value->id_kegiatan_assessment."'".')"><i class="fas fa-sm fa-fw fa-play"></i></a>';
				} else {
					$row[] = '-';
				}
			}
			$row[] = $no;
			$row[] = $value->kegiatan;
			$row[] = $value->hari;
			$row[] = $value->tanggal;
			$row[] = $value->dari_pukul.' s/d '.$value->sampai_pukul.' '.$value->waktu;
			if ($this->session->userdata('id_tipe')==1 || $this->session->userdata('id_tipe')==11 || $this->session->userdata('id_tipe')==10) {
				$row[] = '<a href="javascript:void(0)" onclick="detail_data_peserta('."'".$value->id_kegiatan_assessment."'".')">Nilai <b>'.$jumlah->num_rows().'</b> Peserta</a>';
			} elseif ($this->session->userdata('id_tipe')==13) {
				$row[] = '<a href="javascript:void(0)" onclick="detail_data_peserta('."'".$value->id_kegiatan_assessment."'".')">Nilai <b>'.$jumlah->num_rows().'</b> Peserta</a>';
			} else {
				$row[] = '<a href="javascript:void(0)" onclick="detail_data_peserta('."'".$value->id_kegiatan_assessment."'".')">Nilai Saya</a>';
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

	public function ajax_list_kegiatan_praktek($id)
	{
		$list = $this->m_jadwal_ujian->get_datatables_kegiatan_praktek($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$jumlah = $this->db->get_where('m_peserta_ujian_assessment', array(
				'id_kegiatan_assessment' => $value->id_kegiatan_assessment,
			));
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $value->kegiatan;
			$row[] = $value->hari;
			$row[] = $value->tanggal;
			$row[] = $value->dari_pukul.' s/d '.$value->sampai_pukul.' '.$value->waktu;
			$row[] = '<a href="javascript:void(0)" onclick="detail_data_peserta('."'".$value->id_kegiatan_assessment."'".')">Input Nilai <b>'.$jumlah->num_rows().'</b> Peserta</a>';
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
			if ($this->session->userdata('id_tipe')==1 || $this->session->userdata('id_tipe')==11 || $this->session->userdata('id_tipe')==10) {
				$row[] = '<a href="javascript:void(0)" class="btn btn-info btn-circle btn-sm" title="Review Ujian" onclick="review_ujian('."'".$id.'/'.$value->id_user."'".')"><i class="fas fa-sm fa-fw fa-list"></i></a>';
			}
			$row[] = $no;
			$row[] = $value->nama_user;
			$row[] = $value->no_lisensi;
			if ($this->session->userdata('id_tipe')==1 || $this->session->userdata('id_tipe')==11 || $this->session->userdata('id_tipe')==10) {
				if ($value->nilai == '') {
					$row[] = '<input type="hidden" name="id[]" value="'.$value->id.'">'.$value->nilai;
					$row[] = '<input type="number" name="nilai_essay[]" value="'.$value->nilai_essay.'" placeholder="Nilai Essay" disabled="true">';
					$row[] = '<input type="number" name="nilai_wawancara[]" value="'.$value->nilai_wawancara.'" placeholder="Nilai Wawancara" disabled="true">';
				} else {
					if ($value->id_kategori==2 && $value->nilai >= 70) {
						$row[] = '<input type="hidden" name="id[]" value="'.$value->id.'">'.floor($value->nilai).'<span style="color: red;">*</span>';
					} else {
						$row[] = '<input type="hidden" name="id[]" value="'.$value->id.'">'.floor($value->nilai);
					}
					// $row[] = '<input type="hidden" name="id[]" value="'.$value->id.'">'.$value->nilai;
					$row[] = '<input type="number" name="nilai_essay[]" value="'.$value->nilai_essay.'" placeholder="Nilai Essay">';
					$row[] = '<input type="number" name="nilai_wawancara[]" value="'.$value->nilai_wawancara.'" placeholder="Nilai Wawancara">';
				}
			} else {
				$row[] = $value->nilai;
				$row[] = $value->nilai_essay;
				$row[] = $value->nilai_wawancara;
				// $row[] = 'Menunggu Pengumuman';
				// $row[] = 'Menunggu Pengumuman';
			}
			if ($this->session->userdata('id_tipe')==1 || $this->session->userdata('id_tipe')==11 || $this->session->userdata('id_tipe')==10) {
				if ($value->keterangan_lulus=='Disarankan') {
					$row[] = 
					'<select name="keterangan_lulus[]" class="form-control">
					<option value="Disarankan">Disarankan</option>
					<option value="Belum Disarankan">Belum Disarankan</option>
					<option value="Tidak Disarankan">Tidak Disarankan</option>
					<span class="help-block"></span>
					</select>';
				} elseif ($value->keterangan_lulus=='Belum Disarankan') {
					$row[] = 
					'<select name="keterangan_lulus[]" class="form-control">
					<option value="Belum Disarankan">Belum Disarankan</option>
					<option value="Disarankan">Disarankan</option>
					<option value="Tidak Disarankan">Tidak Disarankan</option>
					<span class="help-block"></span>
					</select>';
				} elseif ($value->keterangan_lulus=='Tidak Disarankan') {
					$row[] = 
					'<select name="keterangan_lulus[]" class="form-control">
					<option value="Tidak Disarankan">Tidak Disarankan</option>
					<option value="Disarankan">Disarankan</option>
					<option value="Belum Disarankan">Belum Disarankan</option>
					<span class="help-block"></span>
					</select>';
				} else {
					$row[] = 
					'<select name="keterangan_lulus[]" class="form-control">
					<option value="Disarankan">Disarankan</option>
					<option value="Belum Disarankan">Belum Disarankan</option>
					<option value="Tidak Disarankan">Tidak Disarankan</option>
					<span class="help-block"></span>
					</select>';
				}
			} else {
				$row[] = $value->keterangan_lulus;
				// $row[] = 'Menunggu Pengumuman';
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

	public function ajax_list_review($id,$id2)
	{
		$list = $this->m_ujian->get_datatables_review($id,$id2);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $value->soal;
			if ($value->id_jenis_soal == 1) {
				$row[] = 'A. '. $value->pilihan_a.'<br>'.'B. '. $value->pilihan_b.'<br>'.'C. '. $value->pilihan_c.'<br>'.'D. '. $value->pilihan_d.'<br>';
				$row[] = $value->jawaban;
			} else {
				$row[] = '';
				$row[] = '';
			}
			$row[] = $value->menjawab;
			if ($value->id_jenis_soal == 1) {
				if ($value->menjawab !='' && $value->betul == 1) {
					$row[] = '<span style="color: green;">Betul</span>';
				} elseif ($value->menjawab !='' && $value->betul == 0) {
					$row[] = '<span style="color: red;">Salah</span>';
				} else {
					$row[] = '<span style="color: orange;">Belum Menjawab</span>';
				}
			} else {
				if ($value->menjawab =='') {
					$row[] = '<span style="color: orange;">Belum Menjawab</span>';
				} else {
					$row[] = '<span style="color: green;">Sudah Menjawab</span>';
				}
			}
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_ujian->count_all_review($id,$id2),
			"recordsFiltered" => $this->m_ujian->count_filtered_review($id,$id2),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_update()
	{
		$nilai = $this->input->post('id');
		$result = array();
		foreach($nilai AS $key => $val) {
			if ($this->input->post('nilai_wawancara')[$key] >= 70) {
				$lulus = 1;
				$keterangan = 'Disarankan';
			} else {
				$lulus = 0;
				$keterangan = 'Belum Disarankan';
			}
			$data = array(
				'nilai_essay' => $this->input->post('nilai_essay')[$key],
				'nilai_wawancara' => $this->input->post('nilai_wawancara')[$key],
				'lulus' => $lulus,
				'keterangan_lulus' => $this->input->post('keterangan_lulus')[$key],
			);
			$this->m_jadwal_ujian->update_peserta(array('id' => $this->input->post('id')[$key]), $data);
		}
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_mulai($id)
	{
		$data = array(
			'mulai' => 1,
		);
		$this->m_pelaksanaan_ujian->update_kegiatan(array('id_kegiatan_assessment' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_selesai($id)
	{
		$data = array(
			'mulai' => 2,
		);
		$this->m_pelaksanaan_ujian->update_kegiatan(array('id_kegiatan_assessment' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}
	
}