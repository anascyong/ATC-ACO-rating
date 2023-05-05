<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ujian extends CI_Model {

	var $table = 'm_ujian_assessment';
	var $column_order = array(null,'soal');
	var $column_search = array('m_soal.soal');
	var $order = array('id_ujian' => 'asc');

	var $table_peserta = 'm_peserta_ujian_assessment';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_ujian()
	{
		$query = $this->db->get_where($this->table, array(
			'id_user' => $this->session->userdata('id_user'),
		));
		return $query->result();
	}

	public function soal($id)
	{
		$this->db->from('m_ujian_assessment');
		$this->db->join('m_soal_assessment','m_soal_assessment.id_soal = m_ujian_assessment.id_soal','left');
		$this->db->where('m_ujian_assessment.id_kegiatan_assessment', $id);
		$this->db->where('m_ujian_assessment.id_user', $this->session->userdata('id_user'));
		$this->db->where('m_ujian_assessment.nomor', $this->input->get('nomor'));
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	public function nomor($id)
	{
		$this->db->from('m_ujian_assessment');
		$this->db->join('m_soal_assessment','m_soal_assessment.id_soal = m_ujian_assessment.id_soal','left');
		$this->db->where('m_soal_assessment.id_jenis_soal', 1);
		$this->db->where('m_ujian_assessment.id_kegiatan_assessment', $id);
		$this->db->where('m_ujian_assessment.id_user', $this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query->result();
	}

	public function nomor_essay($id)
	{
		$this->db->from('m_ujian_assessment');
		$this->db->join('m_soal_assessment','m_soal_assessment.id_soal = m_ujian_assessment.id_soal','left');
		$this->db->where('m_soal_assessment.id_jenis_soal', 2);
		$this->db->where('m_ujian_assessment.id_kegiatan_assessment', $id);
		$this->db->where('m_ujian_assessment.id_user', $this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query->result();
	}

	public function get_soal_by_user()
	{
		$this->db->from($this->table);
		$this->db->join('m_soal_assessment','m_soal_assessment.id_soal = m_ujian_assessment.id_soal','left');
		$this->db->where('m_ujian_assessment.id_user',$this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_datatables_query()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('m_soal_assessment','m_soal_assessment.id_soal = m_ujian_assessment.id_soal','left');
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

	function get_datatables()
	{
		$this->db->where('m_ujian_assessment.id_user', $this->session->userdata('id_user'));
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->db->where('m_ujian_assessment.id_user', $this->session->userdata('id_user'));
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->where('m_ujian_assessment.id_user', $this->session->userdata('id_user'));
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function get_datatables_review($id,$id2)
	{
		$this->db->where('m_ujian_assessment.id_kegiatan_assessment', $id);
		$this->db->where('m_ujian_assessment.id_user', $id2);
		$this->db->order_by('m_ujian_assessment.id_ujian','asc');
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_review($id,$id2)
	{
		$this->db->where('m_ujian_assessment.id_kegiatan_assessment', $id);
		$this->db->where('m_ujian_assessment.id_user', $id2);
		$this->db->order_by('m_ujian_assessment.id_ujian','asc');
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_review($id,$id2)
	{
		$this->db->from($this->table);
		$this->db->join('m_soal_assessment','m_soal_assessment.id_soal = m_ujian_assessment.id_soal','left');
		$this->db->where('m_ujian_assessment.id_kegiatan_assessment', $id);
		$this->db->where('m_ujian_assessment.id_user', $id2);
		$this->db->order_by('m_ujian_assessment.id_ujian','asc');
		return $this->db->count_all_results();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
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
}