<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muser extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function daftar_pengumuman()
	{
		$this->db->select('*');
		$this->db->from('pengumuman');
		$this->db->order_by('last_edited', 'desc');
		$query = $this->db->get();
		if($query->num_rows()!=0){
			return $query->result_array();
		}
	}
	public function user_akun_detail($nim){
		$this->db->select('*');
		$this->db->from('akun');
		$this->db->join('detail_user', 'detail_user.nim = akun.nim');
		$this->db->join('image_user', 'akun.nim = image_user.nim');
		$this->db->where('akun.nim', $nim);
		$query = $this->db->get();
			if($query->num_rows() >0){
				return $query->result();
			}
			else{
				return false;
			}
	}
	public function no_calon(){
		$query ="select * from kandidat order by no_kandidat DESC limit 1";
		$res = $this->db->query($query);
		return $res->row_array();
	}
	public function detail_kandidat($id){
		$this->db->select('*');
		$this->db->from('kandidat');
		$this->db->join('image_kadidat', 'image_kadidat.nim = kandidat.nim');
		$this->db->join('visimisi', 'visimisi.no_kandidat = kandidat.no_kandidat');
		$this->db->where('kandidat.no_kandidat', $id);
		$query = $this->db->get();
			if($query->num_rows() >0){
				return $query->result();
			}
			else{
				return false;
			}
	}
	public function tanggal(){
		$this->db->select('*');
		$this->db->from('tgl_voting');
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function getTanggal(){
		$this->db->select('*');
		$this->db->from('tgl_voting');
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
	}

	public function hasil_voting($nim, $data){
		$this->db->insert('hasil_voting', $data);
		if($this->db->affected_rows()>0){
			$this->db->set('status', 'y');
			$this->db->where('nim', $nim);
			$this->db->update('detail_user');
			if ($this->db->affected_rows()>0) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function quickcount($i){
		$this->db->where('no_pilihan='.$i);
		$query = $this->db->get('hasil_voting');
		if($query->num_rows()>0){
			return $query->num_rows();
		}else{
			return 0;
		}
	}

	//update info
	public function update_info($nim, $data){
		$this->db->update('detail_user', $data, 'nim='.$nim);
		if($this->db->affected_rows()=='1'){
			return true;
		}
		else{
			return false;
		}
	}

	//get information
	public function get_information($nim){
		$this->db->select('detail_user.nama, detail_user.status, image_user.name, akun.akses');
		$this->db->from('akun');
		$this->db->join('detail_user', 'detail_user.nim = akun.nim');
		$this->db->join('image_user', 'akun.nim = image_user.nim');
		$this->db->where('akun.nim', $nim);
		$query = $this->db->get();
			if($query->num_rows() == 1){
				return $query->result();
			}
			else{
				return false;
			}
	}

	public function update_akun($nim, $data){
		$this->db->update('akun', $data, 'nim='.$nim);
		if($this->db->affected_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}

	public function photo($nim, $data){
		$this->db->update('image_user', $data, 'nim='.$nim);
		if($this->db->affected_rows()=='1'){
			return true;
		}
		else{
			return false;
		}
	}

	public function masalah($data){
		$this->db->insert('keluhan', $data);
		if($this->db->affected_rows()>0){
			return true;
		}
	}

}

/* End of file muser.php */
/* Location: ./application/models/muser.php */