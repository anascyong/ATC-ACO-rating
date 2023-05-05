<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

	public function login($data)
	{
		$query = $this->db->get_where('m_user', $data);
		return $query;
	}
}