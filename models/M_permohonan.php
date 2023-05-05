<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permohonan extends CI_Model {

	var $table = 'm_permohonan_assessment';
	var $column_order = array(null,null,'no_surat','tgl_surat','nama_lokasi','surat_permohonan','keterangan','status');
	var $column_search = array('no_surat','tgl_surat','m_lokasi.nama_lokasi','surat_permohonan','keterangan','status');
	var $order = array('id_permohonan' => 'desc');

	var $table_peserta = 'm_peserta_permohonan_assessment';
	var $column_order_peserta = array(null,null,'nama_user','no_identitas','jenis_kelamin','tempat_lahir','tanggal_lahir');
	var $column_search_peserta = array('m_user.nama_user','m_user.no_identitas','m_jenis_kelamin.jenis_kelamin','m_user.tempat_lahir','m_user.tanggal_lahir');
	var $order_peserta = array('m_user.nama_user' => 'asc');

	public function __construct()
	{
		parent::__construct();
	}

	public function get_permohonan()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_permohonan_by_id_lokasi($id)
	{
		$query = $this->db->get_where($this->table, array(
			'id_lokasi' => $id,
		));
		return $query->result();
	}

	public function get_permohonan_baru()
	{
		$query = $this->db->get_where($this->table, array(
			'status' => 2,
		));
		return $query->result();
	}

	public function get_permohonan_ditolak()
	{
		$query = $this->db->get_where($this->table, array(
			'status' => 0,
		));
		return $query->result();
	}

	public function get_permohonan_diterima()
	{
		$query = $this->db->get_where($this->table, array(
			'status' => 3,
		));
		return $query->result();
	}

	private function _get_datatables_query()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_permohonan_assessment.id_lokasi','left');
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

	private function _get_datatables_query_peserta()
	{
		$this->db->from($this->table_peserta);
		$this->db->join('m_user','m_user.id_user = m_peserta_permohonan_assessment.id_user','left');
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

	function get_datatables()
	{
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_permohonan_assessment.id_lokasi', $this->session->userdata('id_lokasi'));
		} else {
			$this->db->where('m_permohonan_assessment.status >=',2);
		}
		if ($this->input->post('id_lokasi')) {
			$this->db->where('m_permohonan_assessment.id_lokasi', $this->input->post('id_lokasi'));
		}
		if ($this->input->post('status')) {
			$this->db->where('m_permohonan_assessment.status', $this->input->post('status'));
		}
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_peserta($id)
	{
		$this->db->where('m_peserta_permohonan_assessment.id_permohonan',$id);
		$this->_get_datatables_query_peserta();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_permohonan_assessment.id_lokasi', $this->session->userdata('id_lokasi'));
		} else {
			$this->db->where('m_permohonan_assessment.status >=',2);
		}
		if ($this->input->post('id_lokasi')) {
			$this->db->where('m_permohonan_assessment.id_lokasi', $this->input->post('id_lokasi'));
		}
		if ($this->input->post('status')) {
			$this->db->where('m_permohonan_assessment.status', $this->input->post('status'));
		}
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_filtered_peserta($id)
	{
		$this->db->where('m_peserta_permohonan_assessment.id_permohonan',$id);
		$this->_get_datatables_query_peserta();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_permohonan_assessment.id_lokasi', $this->session->userdata('id_lokasi'));
		} else {
			$this->db->where('m_permohonan_assessment.status >=',2);
		}
		if ($this->input->post('id_lokasi')) {
			$this->db->where('m_permohonan_assessment.id_lokasi', $this->input->post('id_lokasi'));
		}
		if ($this->input->post('status')) {
			$this->db->where('m_permohonan_assessment.status', $this->input->post('status'));
		}
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function count_all_peserta($id)
	{
		$this->db->where('m_peserta_permohonan_assessment.id_permohonan',$id);
		$this->db->from($this->table_peserta);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_permohonan',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_view_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_permohonan_assessment.id_lokasi','left');
		$this->db->where('m_permohonan_assessment.id_permohonan',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_view_peserta_by_id($id)
	{
		$this->db->from($this->table_peserta);
		$this->db->join('m_user','m_user.id_user = m_peserta_permohonan_assessment.id_user','left');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_negara','left');
		$this->db->join('m_bidang_pelatihan','m_bidang_pelatihan.id_bidang_pelatihan = m_user.id_bidang','left');
		$this->db->where('m_peserta_permohonan_assessment.id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	public function save_peserta($data)
	{
		$this->db->insert($this->table_peserta, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_peserta($where, $data)
	{
		$this->db->update($this->table_peserta, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_permohonan', $id);
		$this->db->delete($this->table);
	}

	public function delete_peserta_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table_peserta);
	}

	public function delete_all_peserta_by_id($id)
	{
		$this->db->where('id_permohonan', $id);
		$this->db->delete($this->table_peserta);
	}
}