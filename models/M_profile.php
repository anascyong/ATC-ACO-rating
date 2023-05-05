<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {

	var $table = 'm_user';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_by_id()
	{
		$this->db->from($this->table);
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$query = $this->db->get();

		return $query->row();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
}