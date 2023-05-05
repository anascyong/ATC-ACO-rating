<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal_ujian extends CI_Model {

	var $table = 'm_jadwal_assessment2';
	var $column_order = array(null,null,'nama_jadwal','nama_lokasi','status_jadwal');
	var $column_search = array('nama_jadwal','m_lokasi.nama_lokasi','status_jadwal');
	var $order = array('id_jadwal_assessment' => 'desc');

	var $table_kegiatan = 'm_jadwal_kegiatan_assessment';
	var $column_order_kegiatan = array(null,null,'kegiatan','hari','tanggal','dari_pukul');
	var $column_search_kegiatan = array('kegiatan','m_lokasi.nama_lokasi','hari','tanggal','dari_pukul');
	var $order_kegiatan = array('id_kegiatan_assessment' => 'asc');

	var $table_peserta = 'm_peserta_ujian_assessment';
	var $column_order_peserta = array(null,null,'nama_user','no_identitas','jenis_kelamin','tempat_lahir','tanggal_lahir','nama_lokasi');
	var $column_search_peserta = array('m_user.nama_user','m_user.no_identitas','m_jenis_kelamin.jenis_kelamin','m_user.tempat_lahir','m_user.tanggal_lahir','m_lokasi.nama_lokasi');
	var $order_peserta = array('m_user.nama_user' => 'asc');

	var $table_asesor = 'm_asesor_assessment';
	var $column_order_asesor = array(null,null,'nama_user','no_identitas','jenis_kelamin','tempat_lahir','tanggal_lahir');
	var $column_search_asesor = array('m_user.nama_user','m_user.no_identitas','m_jenis_kelamin.jenis_kelamin','m_user.tempat_lahir','m_user.tanggal_lahir');
	var $order_asesor = array('m_user.nama_user' => 'asc');

	var $table_pilih_asesor = 'm_user';
	var $column_order_pilih_asesor = array(null,null,'nama_user','no_identitas','jenis_kelamin','tempat_lahir','tanggal_lahir');
	var $column_search_pilih_asesor = array('nama_user','no_identitas','m_jenis_kelamin.jenis_kelamin','tempat_lahir','tanggal_lahir');
	var $order_pilih_asesor = array('nama_user' => 'asc');

	public function __construct()
	{
		parent::__construct();
	}

	public function get_jadwal_ujian()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_jadwal_aktif()
	{
		$query = $this->db->get_where($this->table, array(
			'status_jadwal' => 1,
		));
		return $query->result();
	}

	public function get_jadwal_mulai()
	{
		$query = $this->db->get_where($this->table, array(
			'status_jadwal' => 1,
		));
		return $query->result();
	}

	public function get_jadwal_selesai()
	{
		$query = $this->db->get_where($this->table, array(
			'status_jadwal' => 2,
		));
		return $query->result();
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->join('m_permohonan_assessment','m_permohonan_assessment.id_permohonan = m_jadwal_assessment2.id_permohonan','left');
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_jadwal_assessment2.id_lokasi','left');
		$i = 0;
		foreach ($this->column_search as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} 
				else 
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_kegiatan()
	{
		$this->db->from($this->table_kegiatan);
		$i = 0;
		foreach ($this->column_search_kegiatan as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} 
				else 
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search_kegiatan) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_kegiatan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_kegiatan))
		{
			$order = $this->order_kegiatan;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_peserta()
	{
		$this->db->from($this->table_peserta);
		$this->db->join('m_jadwal_kegiatan_assessment','m_jadwal_kegiatan_assessment.id_kegiatan_assessment = m_peserta_ujian_assessment.id_kegiatan_assessment','left');
		$this->db->join('m_user','m_user.id_user = m_peserta_ujian_assessment.id_user','left');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_user.id_lokasi','left');
		$i = 0;
		foreach ($this->column_search_peserta as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} 
				else 
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search_peserta) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_peserta[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_peserta))
		{
			$order = $this->order_peserta;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_asesor()
	{
		$this->db->from($this->table_asesor);
		$this->db->join('m_jadwal_assessment2','m_jadwal_assessment2.id_jadwal_assessment = m_asesor_assessment.id_jadwal_assessment','left');
		$this->db->join('m_user','m_user.id_user = m_asesor_assessment.id_user','left');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$i = 0;
		foreach ($this->column_search_asesor as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} 
				else 
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search_asesor) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_asesor[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_asesor))
		{
			$order = $this->order_asesor;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_pilih_asesor()
	{
		$this->db->from($this->table_pilih_asesor);
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$i = 0;
		foreach ($this->column_search_pilih_asesor as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} 
				else 
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search_pilih_asesor) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_pilih_asesor[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_pilih_asesor))
		{
			$order = $this->order_pilih_asesor;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_jadwal_assessment2.status_jadwal >=',1);
			$this->db->where('m_jadwal_assessment2.id_lokasi',$this->session->userdata('id_lokasi'));
		}
		if ($this->session->userdata('id_tipe')==5) {
			$this->db->where('m_jadwal_assessment2.status_jadwal >=',1);
			$this->db->where('m_jadwal_assessment2.id_lokasi',$this->session->userdata('id_lokasi'));
			// $this->db->where('m_jadwal_assessment2.id_bidang',$this->session->userdata('id_bidang'));
			// $this->db->join('m_peserta_ujian_assessment','m_peserta_ujian_assessment.id_kegiatan_assessment = m_jadwal_kegiatan_assessment.id_kegiatan_assessment','left');
			// $this->db->where('m_peserta_ujian_assessment.id_user', $this->session->userdata('id_user'));
		}
		if ($this->input->post('id_lokasi')) {
			$this->db->where('m_jadwal_assessment2.id_lokasi',$this->input->post('id_lokasi'));
		}
		if ($this->input->post('status_jadwal')) {
			$this->db->where('m_jadwal_assessment2.status_jadwal',$this->input->post('status_jadwal'));
		}
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_kegiatan($id)
	{
		$this->db->where('m_jadwal_kegiatan_assessment.id_jadwal_assessment',$id);
		$this->_get_datatables_query_kegiatan();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_kegiatan_teori($id)
	{
		$this->db->where('m_jadwal_kegiatan_assessment.id_jadwal_assessment',$id);
		$this->_get_datatables_query_kegiatan();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_kegiatan_praktek($id)
	{
		$this->db->where('m_jadwal_kegiatan_assessment.id_jadwal_assessment',$id);
		$this->_get_datatables_query_kegiatan();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_peserta($id)
	{
		$this->db->where('m_peserta_ujian_assessment.id_kegiatan_assessment',$id);
		if ($this->session->userdata('id_tipe')==5) {
			$this->db->where('m_peserta_ujian_assessment.id_user',$this->session->userdata('id_user'));
		}
		$this->_get_datatables_query_peserta();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_asesor($id)
	{
		$this->db->where('m_asesor_assessment.id_jadwal_assessment',$id);
		$this->_get_datatables_query_asesor();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_pilih_asesor()
	{
		$this->db->where('m_user.id_tipe',10);
		$this->_get_datatables_query_pilih_asesor();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_jadwal_assessment2.status_jadwal >=',1);
			$this->db->where('m_jadwal_assessment2.id_lokasi',$this->session->userdata('id_lokasi'));
		}
		if ($this->session->userdata('id_tipe')==5) {
			$this->db->where('m_jadwal_assessment2.status_jadwal >=',1);
			$this->db->where('m_jadwal_assessment2.id_lokasi',$this->session->userdata('id_lokasi'));
			$this->db->where('m_jadwal_assessment2.id_bidang',$this->session->userdata('id_bidang'));
		}
		if ($this->input->post('id_lokasi')) {
			$this->db->where('m_jadwal_assessment2.id_lokasi',$this->input->post('id_lokasi'));
		}
		if ($this->input->post('status_jadwal')) {
			$this->db->where('m_jadwal_assessment2.status_jadwal',$this->input->post('status_jadwal'));
		}
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_filtered_kegiatan($id)
	{
		$this->db->where('m_jadwal_kegiatan_assessment.id_jadwal_assessment',$id);
		$this->_get_datatables_query_kegiatan();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_filtered_peserta($id)
	{
		$this->db->where('m_peserta_ujian_assessment.id_kegiatan_assessment',$id);
		if ($this->session->userdata('id_tipe')==5) {
			$this->db->where('m_peserta_ujian_assessment.id_user',$this->session->userdata('id_user'));
		}
		$this->_get_datatables_query_peserta();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_filtered_asesor($id)
	{
		$this->db->where('m_asesor_assessment.id_jadwal_assessment',$id);
		$this->_get_datatables_query_asesor();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_filtered_pilih_asesor()
	{
		$this->db->where('m_user.id_tipe',10);
		$this->_get_datatables_query_pilih_asesor();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_jadwal_assessment2.status_jadwal >=',1);
			$this->db->where('m_jadwal_assessment2.id_lokasi',$this->session->userdata('id_lokasi'));
		}
		if ($this->session->userdata('id_tipe')==5) {
			$this->db->where('m_jadwal_assessment2.status_jadwal >=',1);
			$this->db->where('m_jadwal_assessment2.id_lokasi',$this->session->userdata('id_lokasi'));
			$this->db->where('m_jadwal_assessment2.id_bidang',$this->session->userdata('id_bidang'));
		}
		if ($this->input->post('id_lokasi')) {
			$this->db->where('m_jadwal_assessment2.id_lokasi',$this->input->post('id_lokasi'));
		}
		if ($this->input->post('status_jadwal')) {
			$this->db->where('m_jadwal_assessment2.status_jadwal',$this->input->post('status_jadwal'));
		}
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function count_all_kegiatan($id)
	{
		$this->db->where('m_jadwal_kegiatan_assessment.id_jadwal_assessment',$id);
		$this->db->from($this->table_kegiatan);
		return $this->db->count_all_results();
	}

	public function count_all_peserta($id)
	{
		$this->db->where('m_peserta_ujian_assessment.id_kegiatan_assessment',$id);
		if ($this->session->userdata('id_tipe')==5) {
			$this->db->where('m_peserta_ujian_assessment.id_user',$this->session->userdata('id_user'));
		}
		$this->db->from($this->table_peserta);
		return $this->db->count_all_results();
	}

	public function count_all_asesor($id)
	{
		$this->db->where('m_asesor_assessment.id_jadwal_assessment',$id);
		$this->db->from($this->table_asesor);
		return $this->db->count_all_results();
	}

	public function count_all_pilih_asesor()
	{
		$this->db->where('m_user.id_tipe',10);
		$this->db->from($this->table_pilih_asesor);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_jadwal_assessment',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_kegiatan_by_id($id)
	{
		$this->db->from($this->table_kegiatan);
		$this->db->where('id_kegiatan_assessment',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_peserta_by_id($id)
	{
		$this->db->from($this->table_peserta);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_asesor_by_id($id)
	{
		$this->db->from($this->table_asesor);
		$this->db->where('id_asesor',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_view_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->join('m_permohonan_assessment','m_permohonan_assessment.id_permohonan = m_jadwal_assessment2.id_permohonan','left');
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_jadwal_assessment2.id_lokasi','left');
		$this->db->where('m_jadwal_assessment2.id_jadwal_assessment',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_review_by_id($id,$id2)
	{
		$this->db->from($this->table);
		$this->db->join('m_jadwal_kegiatan_assessment','m_jadwal_kegiatan_assessment.id_jadwal_assessment = m_jadwal_assessment2.id_jadwal_assessment','left');
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_jadwal_assessment2.id_lokasi','left');
		$this->db->join('m_peserta_ujian_assessment','m_peserta_ujian_assessment.id_kegiatan_assessment = m_jadwal_kegiatan_assessment.id_kegiatan_assessment','left');
		$this->db->join('m_user','m_user.id_user = m_peserta_ujian_assessment.id_user','left');
		$this->db->where('m_jadwal_kegiatan_assessment.id_kegiatan_assessment',$id);
		$this->db->where('m_peserta_ujian_assessment.id_user',$id2);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_view_peserta_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->join('m_permohonan_assessment','m_permohonan_assessment.id_permohonan = m_jadwal_assessment2.id_permohonan','left');
		$this->db->join('m_jadwal_kegiatan_assessment','m_jadwal_kegiatan_assessment.id_jadwal_assessment = m_jadwal_assessment2.id_jadwal_assessment','left');
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_jadwal_assessment2.id_lokasi','left');
		$this->db->where('m_jadwal_kegiatan_assessment.id_kegiatan_assessment',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_view_asesor_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->join('m_permohonan_assessment','m_permohonan_assessment.id_permohonan = m_jadwal_assessment2.id_permohonan','left');
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_jadwal_assessment2.id_lokasi','left');
		$this->db->where('m_jadwal_assessment2.id_jadwal_assessment',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function save_kegiatan($data)
	{
		$this->db->insert($this->table_kegiatan, $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	public function save_peserta($data)
	{
		$this->db->insert($this->table_peserta, $data);
		return $this->db->insert_id();
	}

	public function save_asesor($data)
	{
		$this->db->insert($this->table_asesor, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_kegiatan($where, $data)
	{
		$this->db->update($this->table_kegiatan, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_peserta($where, $data)
	{
		$this->db->update($this->table_peserta, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_jadwal_assessment', $id);
		$this->db->delete($this->table);
	}

	public function delete_kegiatan_by_id($id)
	{
		$this->db->where('id_kegiatan_assessment', $id);
		$this->db->delete($this->table_kegiatan);
	}

	public function delete_peserta_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table_peserta);
	}

	public function delete_asesor_by_id($id)
	{
		$this->db->where('id_asesor', $id);
		$this->db->delete($this->table_asesor);
	}
}