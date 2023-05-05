<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ujian extends CI_Controller {

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
			'title' => 'Pelaksanaan Ujian', 
			'page' => 'v_ujian',
			'script' => 's_ujian',
		);
		$this->load->view('template', $data);
	}

	public function mulai($id)
	{
		$data = array(
			'title' => 'Pelaksanaan Ujian', 
			'page' => 'v_ujian',
			'script' => 's_ujian',
			'id' => $id,
			'soal' => $this->m_ujian->soal($id),
			'nomor' => $this->m_ujian->nomor($id),
			'nomor_essay' => $this->m_ujian->nomor_essay($id),
		);
		$this->load->view('template', $data);
	}

	public function get_soal_by_user()
	{
		$data = $this->m_ujian->get_soal_by_user();
		echo json_encode($data);
	}

	public function ajax_add($id)
	{
		$this->db->order_by('rand()');
		$this->db->limit(50);
		$this->db->where('id_bidang', $this->session->userdata('id_bidang'));
		$this->db->where('id_jenis_soal', 1);
		$soal = $this->db->get('m_soal_assessment');
		if ($soal->num_rows()!=0) {
			$no = 0;
			foreach ($soal->result() as $value) {
				$no++;
				$check = $this->db->get_where('m_ujian_assessment', array(
					'id_user' => $this->session->userdata('id_user'),
					'id_soal' => $value->id_soal,
					'id_kegiatan_assessment' => $id,
				));
				if ($check->num_rows()==0) {
					$data = array(
						'id_user' => $this->session->userdata('id_user'),
						'id_soal' => $value->id_soal,
						'id_kegiatan_assessment' => $id,
						'nomor' => $no,
					);
					$insert = $this->m_ujian->save($data);
				}
			}
			$this->db->select_max('nomor','max');
			$this->db->where('id_user',$this->session->userdata('id_user'));
			$this->db->where('id_kegiatan_assessment',$id);
			$query = $this->db->get('m_ujian_assessment');
			$max = $query->row()->max;

			$this->db->limit(1);
			$this->db->where('id_bidang', $this->session->userdata('id_bidang'));
			$this->db->where('id_jenis_soal', 2);
			$soal_essay = $this->db->get('m_soal_assessment');
			if ($soal_essay->num_rows()!=0) {
				$no = 1;
				foreach ($soal_essay->result() as $value) {
					$check = $this->db->get_where('m_ujian_assessment', array(
						'id_user' => $this->session->userdata('id_user'),
						'id_soal' => $value->id_soal,
						'id_kegiatan_assessment' => $id,
					));
					if ($check->num_rows()==0) {
						$data = array(
							'id_user' => $this->session->userdata('id_user'),
							'id_soal' => $value->id_soal,
							'id_kegiatan_assessment' => $id,
							'nomor' => $max+$no,
						);
						$insert = $this->m_ujian->save($data);
					}
				}
				$no++;
			}
			echo json_encode(array("status" => TRUE));
		}
	}

	public function ajax_edit($id)
	{
		$data = $this->m_jadwal_ujian->get_kegiatan_by_id($id);
		echo json_encode($data);
	}

	public function ajax_ragu()
	{
		$query = $this->db->get_where('m_soal_assessment', array(
			'id_soal' => $this->input->post('id_soal'),
			'jawaban' => $this->input->post('jawaban'),
		));
		if ($query->num_rows()==0) {
			$betul = 0;
		} else {
			$betul = 1;
		}
		$data = array(
			'menjawab' => $this->input->post('jawaban'),
			'betul' => $betul,
			'ragu' => 1,
		);
		$this->m_ujian->update(array('id_ujian' => $this->input->post('id_ujian')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_jawab()
	{
		$query = $this->db->get_where('m_soal_assessment', array(
			'id_soal' => $this->input->post('id_soal'),
			'jawaban' => $this->input->post('jawaban'),
		));
		if ($query->num_rows()==0) {
			$betul = 0;
		} else {
			$betul = 1;
		}
		$data = array(
			'menjawab' => $this->input->post('jawaban'),
			'betul' => $betul,
			'ragu' => 0,
		);
		$this->m_ujian->update(array('id_ujian' => $this->input->post('id_ujian')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_selesai($id)
	{
		$this->db->from('m_ujian_assessment');
		$this->db->join('m_soal_assessment','m_soal_assessment.id_soal = m_ujian_assessment.id_soal','left');
		$this->db->where('m_ujian_assessment.id_kegiatan_assessment', $id);
		$this->db->where('m_ujian_assessment.id_user', $this->session->userdata('id_user'));
		$this->db->where('m_soal_assessment.id_jenis_soal', 1);
		$jumlah = $this->db->get();
		$betul = $this->db->get_where('m_ujian_assessment', array(
			'id_kegiatan_assessment' => $id,
			'id_user' => $this->session->userdata('id_user'),
			'betul' => 1,
		));
		$point = 100 / $jumlah->num_rows();
		$nilai = $betul->num_rows() * $point;

		if ($nilai >= 70) {
			$lulus = 1;
			$nilai_recheck = 70;
		} else {
			$lulus = 0;
			$nilai_recheck = $nilai;
		}
		$kategori = $this->db->get_where('m_jadwal_kegiatan_assessment', array(
			'id_kegiatan_assessment' => $id,
			'id_kategori' => 2
		));
		if ($kategori->num_rows()==1) {
			$data = array(
				'nilai' => floor($nilai_recheck),
				'lulus' => $lulus,
			);
		} else {
			$data = array(
				'nilai' => floor($nilai),
				'lulus' => $lulus,
			);
		}
		$this->m_ujian->update_peserta(array(
			'id_kegiatan_assessment' => $id,
			'id_user' => $this->session->userdata('id_user'),
		), $data);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('jawaban')=='')
		{
			$data['inputerror'][] = 'jawaban';
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