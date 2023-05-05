<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peserta extends CI_Model {

	var $table = 'm_user';
	var $column_order = array(null,null,'nama_user','no_identitas','jenis_kelamin','tempat_lahir','tanggal_lahir','nama_lokasi');
	var $column_search = array('nama_user','no_identitas','m_jenis_kelamin.jenis_kelamin','tempat_lahir','tanggal_lahir','m_lokasi.nama_lokasi');
	var $order = array('nama_user' => 'asc');

	var $table_lisensi = 'm_lisensi_temp';
	var $column_order_lisensi = array(null,null,'no_lisensi','nama_lisensi','tgl_terbit','tgl_berlaku','file_lisensi');
	var $column_search_lisensi = array('no_lisensi','m_lisensi.nama_lisensi','tgl_terbit','tgl_berlaku','file_lisensi');
	var $order_lisensi = array('id' => 'desc');

	var $table_medex = 'm_medex_temp';
	var $column_order_medex = array(null,null,'no_sertifikat','hasil','tgl_dikeluarkan','tgl_berlaku','file_sertifikat');
	var $column_search_medex = array('no_sertifikat','hasil','tgl_dikeluarkan','tgl_berlaku','file_sertifikat');
	var $order_medex = array('id_medex' => 'desc');

	var $table_icao = 'm_icao_temp';
	var $column_order_icao = array(null,null,'no_sertifikat','level','tgl_dikeluarkan','tgl_berlaku','file_sertifikat');
	var $column_search_icao = array('no_sertifikat','level','tgl_dikeluarkan','tgl_berlaku','file_sertifikat');
	var $order_icao = array('id_icao' => 'desc');

	var $table_rating = 'm_history_rating_temp';
	var $column_order_rating = array(null,null,'nama_rating','tgl_terbit_rating','tgl_berlaku_rating','file_rating');
	var $column_search_rating = array('m_rating_atc.nama_rating','tgl_terbit_rating','tgl_berlaku_rating','file_rating');
	var $order_rating = array('id_history_rating' => 'desc');

	var $table_serkom = 'm_sertifikat_kompetensi_temp_assessment';
	var $column_order_serkom = array(null,'nama_bidang','nama_tipe_sertifikat_kompetensi',null);
	var $column_search_serkom = array('m_bidang.nama_bidang','m_tipe_sertifikat_kompetensi.nama_tipe_sertifikat_kompetensi');
	var $order_serkom = array('id_sk' => 'desc');

	var $table_serpel = 'm_sertifikat_pelatihan_temp_assessment';
	var $column_order_serpel = array(null,'nama_tipe_sertifikat_pelatihan',null);
	var $column_search_serpel = array('m_tipe_sertifikat_pelatihan.nama_tipe_sertifikat_pelatihan');
	var $order_serpel = array('id_sp' => 'desc');

	public function __construct()
	{
		parent::__construct();
	}

	public function get_user()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_jk()
	{
		$query = $this->db->get('m_jenis_kelamin');
		return $query->result();
	}

	public function get_bidang()
	{
		$query = $this->db->get('m_bidang');
		return $query->result();
	}

	public function get_lisensi()
	{
		$query = $this->db->get('m_lisensi');
		return $query->result();
	}

	public function get_rating()
	{
		$query = $this->db->get('m_rating_atc');
		return $query->result();
	}

	public function get_negara()
	{
		$query = $this->db->get('m_negara');
		return $query->result();
	}

	private function _get_datatables_query()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_user.id_lokasi','left');
		$this->db->join('m_bidang','m_bidang.id_bidang = m_user.id_bidang','left');
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

	private function _get_datatables_query_lisensi()
	{
		$this->db->from($this->table_lisensi);
		$this->db->join('m_lisensi','m_lisensi.id_lisensi = m_lisensi_temp.id_lisensi','left');
		$i = 0;
		foreach ($this->column_search_lisensi as $item)
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
				if(count($this->column_search_lisensi) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_lisensi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_lisensi))
		{
			$order = $this->order_lisensi;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_medex()
	{
		$this->db->from($this->table_medex);
		$i = 0;
		foreach ($this->column_search_medex as $item)
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
				if(count($this->column_search_medex) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_medex[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_medex))
		{
			$order = $this->order_medex;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_icao()
	{
		$this->db->from($this->table_icao);
		$i = 0;
		foreach ($this->column_search_icao as $item)
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
				if(count($this->column_search_icao) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_icao[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_icao))
		{
			$order = $this->order_icao;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_rating()
	{
		$this->db->from($this->table_rating);
		$this->db->join('m_rating_atc','m_rating_atc.id_rating = m_history_rating_temp.id_rating','left');
		$i = 0;
		foreach ($this->column_search_rating as $item)
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
				if(count($this->column_search_rating) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_rating[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_rating))
		{
			$order = $this->order_rating;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_serkom()
	{
		$this->db->select('*');
		$this->db->from($this->table_serkom);
		$this->db->join('m_tipe_sertifikat_kompetensi','m_tipe_sertifikat_kompetensi.id_tipe_sertifikat_kompetensi = m_sertifikat_kompetensi_temp_assessment.id_tipe_sertifikat_kompetensi','right');
		$this->db->join('m_bidang','m_bidang.id_bidang = m_tipe_sertifikat_kompetensi.id_bidang','left');
		$this->db->group_by('m_sertifikat_kompetensi_temp_assessment.id_tipe_sertifikat_kompetensi');
		$i = 0;
		foreach ($this->column_search_serkom as $item)
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
				if(count($this->column_search_serkom) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_serkom[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_serkom))
		{
			$order = $this->order_serkom;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_serpel()
	{
		$this->db->select('*');
		$this->db->from($this->table_serpel);
		$this->db->join('m_tipe_sertifikat_pelatihan','m_tipe_sertifikat_pelatihan.id_tipe_sertifikat_pelatihan = m_sertifikat_pelatihan_temp_assessment.id_tipe_sertifikat_pelatihan','right');
		$this->db->group_by('m_sertifikat_pelatihan_temp_assessment.id_tipe_sertifikat_pelatihan');
		$i = 0;
		foreach ($this->column_search_serpel as $item)
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
				if(count($this->column_search_serpel) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_serpel[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_serpel))
		{
			$order = $this->order_serpel;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->db->where('m_user.id_tipe',5);
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_user.id_lokasi', $this->session->userdata('id_lokasi'));
		}
		if ($this->session->userdata('id_tipe')==5) {
			$this->db->where('m_user.id_user', $this->session->userdata('id_user'));
		}
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->db->where('m_user.id_tipe',5);
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_user.id_lokasi', $this->session->userdata('id_lokasi'));
		}
		if ($this->session->userdata('id_tipe')==5) {
			$this->db->where('m_user.id_user', $this->session->userdata('id_user'));
		}
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->where('m_user.id_tipe',5);
		if ($this->session->userdata('id_tipe')==13) {
			$this->db->where('m_user.id_lokasi', $this->session->userdata('id_lokasi'));
		}
		if ($this->session->userdata('id_tipe')==5) {
			$this->db->where('m_user.id_user', $this->session->userdata('id_user'));
		}
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function get_datatables_peserta($id)
	{
		$this->db->where('m_user.id_tipe',5);
		$this->db->where('m_user.id_lokasi', $id);
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_peserta($id)
	{
		$this->db->where('m_user.id_tipe',5);
		$this->db->where('m_user.id_lokasi', $id);
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_peserta($id)
	{
		$this->db->where('m_user.id_tipe',5);
		$this->db->where('m_user.id_lokasi', $id);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function get_datatables_lisensi()
	{
		$this->_get_datatables_query_lisensi();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_lisensi()
	{
		$this->_get_datatables_query_lisensi();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_lisensi()
	{
		$this->db->from($this->table_lisensi);
		return $this->db->count_all_results();
	}

	function get_datatables_medex()
	{
		$this->_get_datatables_query_medex();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_medex()
	{
		$this->_get_datatables_query_medex();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_medex()
	{
		$this->db->from($this->table_medex);
		return $this->db->count_all_results();
	}

	function get_datatables_icao()
	{
		$this->_get_datatables_query_icao();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_icao()
	{
		$this->_get_datatables_query_icao();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_icao()
	{
		$this->db->from($this->table_icao);
		return $this->db->count_all_results();
	}

	function get_datatables_rating()
	{
		$this->_get_datatables_query_rating();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_rating()
	{
		$this->_get_datatables_query_rating();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_rating()
	{
		$this->db->from($this->table_rating);
		return $this->db->count_all_results();
	}

	function get_datatables_serkom()
	{
		$this->db->where('m_tipe_sertifikat_kompetensi.id_bidang', $this->input->post('id_bidang'));
		$this->_get_datatables_query_serkom();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_serkom()
	{
		$this->db->where('m_tipe_sertifikat_kompetensi.id_bidang', $this->input->post('id_bidang'));
		$this->_get_datatables_query_serkom();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_serkom()
	{
		$this->db->from($this->table_serkom);
		$this->db->where('id_bidang', $this->input->post('id_bidang'));
		return $this->db->count_all_results();
	}

	function get_datatables_serpel()
	{
		$this->_get_datatables_query_serpel();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_serpel()
	{
		$this->_get_datatables_query_serpel();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_serpel()
	{
		$this->db->from($this->table_serpel);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_user',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_lisensi_by_id($id)
	{
		$this->db->from($this->table_lisensi);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_rating_by_id($id)
	{
		$this->db->from($this->table_rating);
		$this->db->where('id_history_rating',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_medex_by_id($id)
	{
		$this->db->from($this->table_medex);
		$this->db->where('id_medex',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_icao_by_id($id)
	{
		$this->db->from($this->table_icao);
		$this->db->where('id_icao',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_serkom_by_id($id)
	{
		$this->db->from($this->table_serkom);
		$this->db->where('id_sk',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_serpel_by_id($id)
	{
		$this->db->from($this->table_serpel);
		$this->db->where('id_sp',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_view_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_lokasi','m_lokasi.id_lokasi = m_user.id_lokasi','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_negara','left');
		$this->db->join('m_bidang','m_bidang.id_bidang = m_user.id_bidang','left');
		$this->db->where('m_user.id_user',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function save_lisensi($data)
	{
		$this->db->insert($this->table_lisensi, $data);
		return $this->db->insert_id();
	}

	public function save_rating($data)
	{
		$this->db->insert($this->table_rating, $data);
		return $this->db->insert_id();
	}

	public function save_medex($data)
	{
		$this->db->insert($this->table_medex, $data);
		return $this->db->insert_id();
	}

	public function save_icao($data)
	{
		$this->db->insert($this->table_icao, $data);
		return $this->db->insert_id();
	}

	public function save_serkom($data)
	{
		$this->db->insert($this->table_serkom, $data);
		return $this->db->insert_id();
	}

	public function save_serpel($data)
	{
		$this->db->insert($this->table_serpel, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_serkom($where, $data)
	{
		$this->db->update($this->table_serkom, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_serpel($where, $data)
	{
		$this->db->update($this->table_serpel, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->table);
	}

	public function delete_lisensi_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table_lisensi);
	}

	public function delete_rating_by_id($id)
	{
		$this->db->where('id_history_rating', $id);
		$this->db->delete($this->table_rating);
	}

	public function delete_medex_by_id($id)
	{
		$this->db->where('id_medex', $id);
		$this->db->delete($this->table_medex);
	}

	public function delete_icao_by_id($id)
	{
		$this->db->where('id_icao', $id);
		$this->db->delete($this->table_icao);
	}
}