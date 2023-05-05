<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sk extends CI_Model {

	var $table = 'm_sk';
	var $column_order = array(null,null,'no_sk','tgl_terbit','tgl_berlaku','nama_lokasi');
	var $column_search = array('no_sk','tgl_terbit','tgl_berlaku','m_lokasi.nama_lokasi');
	var $order = array('id_sk' => 'desc');

	public function __construct()
	{
		parent::__construct();
	}

	public function get_sk()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_sk.id_lokasi','left');
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
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_sk.id_lokasi', $this->session->userdata('id_lokasi'));
		}
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_sk.id_lokasi', $this->session->userdata('id_lokasi'));
		}
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_sk.id_lokasi', $this->session->userdata('id_lokasi'));
		}
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_sk',$id);
		$query = $this->db->get();

		return $query->row();
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

	public function delete_by_id($id)
	{
		$this->db->where('id_sk', $id);
		$this->db->delete($this->table);
	}
}