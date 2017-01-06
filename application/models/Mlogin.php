<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function check_akun($akun){
		$this->db->select('*');
		$this->db->from('akun');
		$this->db->where('nim', $akun['nim']);
		$this->db->where('password', $akun['password']);
		$query = $this->db->get();
			if($query->num_rows() == 1){
				return $query->result();
			}
			else{
				return false;
			}
	}
	public function get_information($akun){
		$this->db->select('detail_user.nama, detail_user.status, image_user.name, akun.akses');
		$this->db->from('akun');
		$this->db->join('detail_user', 'detail_user.nim = akun.nim');
		$this->db->join('image_user', 'akun.nim = image_user.nim');
		$this->db->where('akun.nim', $akun['nim']);
		$query = $this->db->get();
			if($query->num_rows() == 1){
				return $query->result();
			}
			else{
				return false;
			}
	}

}

/* End of file mlogin.php */
/* Location: ./application/models/mlogin.php */