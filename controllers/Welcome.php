<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function cek()
	{
		$query = $this->db->get('m_kuota_usulan');
		foreach ($query->result() as $value) {
			$data = array(
				'id_kuota_usulan' => $value->id_kuota_usulan,
			);
			$this->db->update('m_kuota_persetujuan', $data, array('no_entry' => $value->no_entry));
		}
	}
}
