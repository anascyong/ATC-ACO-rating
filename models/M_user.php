<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	var $table = 'm_user';
	var $column_order = array(null,null,'nama_user','nama_tipe','nama_lokasi','no_hp','email','last_login');
	var $column_search = array('nama_user','m_tipe.nama_tipe','m_lokasi.nama_lokasi','no_hp','email','last_login');
	var $order = array('nama_user' => 'asc');

	public function __construct()
	{
		parent::__construct();
	}

	public function get_user()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_tipe()
	{
		$this->db->order_by('nama_tipe','asc');
		$this->db->where_in('id_tipe',[1,5,10,11,13,29]);
		// $this->db->or_where('id_tipe',5);
		// $this->db->or_where('id_tipe',11);
		// $this->db->or_where('id_tipe',13);
		// $this->db->or_where('id_tipe',29);
		$query = $this->db->get('m_tipe');
		return $query->result();
	}

	private function _get_datatables_query()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('m_tipe','m_tipe.id_tipe = m_user.id_tipe','left');
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_user.id_lokasi','left');
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
		// $this->db->where('m_tipe.id_tipe',1);
		// $this->db->or_where('m_tipe.id_tipe',5);
		// $this->db->or_where('m_tipe.id_tipe',11);
		// $this->db->or_where('m_tipe.id_tipe',13);
		// $this->db->or_where('m_tipe.id_tipe',29);
		$this->db->where_in('m_tipe.id_tipe',[1,5,10,11,13,29]);
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		// $this->db->where('m_tipe.id_tipe',1);
		// $this->db->or_where('m_tipe.id_tipe',5);
		// $this->db->or_where('m_tipe.id_tipe',11);
		// $this->db->or_where('m_tipe.id_tipe',13);
		// $this->db->or_where('m_tipe.id_tipe',29);
		$this->db->where_in('m_tipe.id_tipe',[1,5,10,11,13,29]);
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		$this->db->join('m_tipe','m_tipe.id_tipe = m_user.id_tipe','left');
		// $this->db->where('m_tipe.id_tipe',1);
		// $this->db->or_where('m_tipe.id_tipe',5);
		// $this->db->or_where('m_tipe.id_tipe',11);
		// $this->db->or_where('m_tipe.id_tipe',13);
		// $this->db->or_where('m_tipe.id_tipe',29);
		$this->db->where_in('m_tipe.id_tipe',[1,5,10,11,13,29]);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_user',$id);
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
		$this->db->where('id_user', $id);
		$this->db->delete($this->table);
	}
}