<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Madmin extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function insert_pengumuman($pengumuman){
		$this->db->insert('pengumuman', $pengumuman);
		if ($this->db->affected_rows()==1) {
			return true;
		}
		else{
			return false;
		}
	}

	public function search_pengumuman($clue)
	{
		$this->db->select('*');
		$this->db->from('pengumuman');
		$this->db->like('judul', $clue);
		$query = $this->db->get();
		return $query->result();
	}

	public function select_data(){
		$this->db->select('*');
		$this->db->from('pengumuman');
		$this->db->order_by('last_edited', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function edit_pengumuman($id){
		$this->db->select('*');
		$this->db->from('pengumuman');
		$this->db->where('id_peng', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function no_visimisi(){
		$this->db->select('*');
		$this->db->from('visimisi');
		$this->db->order_by('no_kandidat', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}
	public function proses_edit_pengumuman($id_peng, $data_update)
	{
		$this->db->update('pengumuman', $data_update, 'id_peng = '.$id_peng);
		if($this->db->affected_rows()=='1'){
			return true;
		}
		else{
			return false;
		}
	}
	public function delete_pengumuman($id_peng){
		$this->db->where('id_peng', $id_peng);
		$this->db->delete('pengumuman');
		if($this->db->affected_rows()=='1'){
			return true;
		}
		else{
			return false;
		}
	}

	public function tambah_user($data_login){
		$this->db->select('*');
		$this->db->from('akun');
		$this->db->where('nim', $data_login['nim']);
		$query = $this->db->get();
		if($query->num_rows() == 0){
			$this->db->insert('akun', $data_login);
			if($this->db->affected_rows()>0){
				return true;
			}
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
	//search user
	public function search_user($clue)
	{
		$this->db->select('*');
		$this->db->from('detail_user');
		$this->db->like('nim', $clue);
		$this->db->or_like('nama', $clue);
		$this->db->or_like('jurusan', $clue);
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_user($data_akun){
		$this->db->insert('detail_user', $data_akun);
		if($this->db->affected_rows()=='1'){
			return true;
		}
		else{
			return false;
		}
	}
	public function image_user($data_image){
		$this->db->insert('image_user', $data_image);
		if($this->db->affected_rows()=='1'){
			return true;
		}
		else{
			return false;
		}
	}

	public function user_detail_gagal($nim){
		$this->db->where('nim', $nim);
		$this->db->delete('akun');
	}

	public function user_image_gagal($nim){
		$this->db->where('nim', $nim);
		$this->db->delete('akun');
		if($this->db->affected_rows()=='1'){
			$this->db->where('nim', $nim);
			$this->db->delete('detail_user');
		}
	}

	//daftar user
	public function select_all(){
		$this->db->select('akun.nim, detail_user.nama, detail_user.jurusan');
		$this->db->from('akun');
		$this->db->join('detail_user', 'detail_user.nim = akun.nim');
		$query = $this->db->get();
		return $query->num_rows();

	}
	public function daftar_user($limit=array()){
		$this->db->select('akun.nim, detail_user.nama, detail_user.jurusan');
		$this->db->from('akun');
		$this->db->join('detail_user', 'detail_user.nim = akun.nim');
		if ($limit != NULL)
		$this->db->limit($limit['perpage'], $limit['offset']);
		return $this->db->get();
		
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
	//update akun
	public function update_akun($nim, $data){
		$this->db->update('akun', $data, 'nim='.$nim);
		if($this->db->affected_rows()=='1'){
			return true;
		}
		else{
			return false;
		}
	}
	//update photo
	public function photo($nim, $data){
		$this->db->update('image_user', $data, 'nim='.$nim);
		if($this->db->affected_rows()=='1'){
			return true;
		}
		else{
			return false;
		}
	}
	//hapus user
	public function hapus_akun($nim){
		$tables = array('akun', 'detail_user', 'image_user');
		$this->db->where('nim', $nim);
		$this->db->delete($tables);
		if($this->db->affected_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}

	//tambah kandidat
	public function tambah_kandidat($data_kandidat){
		$this->db->insert('kandidat', $data_kandidat);
		if($this->db->affected_rows() == 1){
			return true;
		}
		else{
			return false;
		}
	}
	//ceknim
	public function ceknim($nim){
		$this->db->select('*');
		$this->db->from('kandidat');
		$this->db->where('nim', $nim);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function photo_kandidat($data){
		$this->db->insert('image_kadidat', $data);
		if($this->db->affected_rows() == 1){
			return true;
		}
		else{
			return false;
		}
	}

	//daftar semua kandidat
	public function vkandidat(){
		$this->db->select('nim, nama, jurusan, no_kandidat');
		$this->db->from('kandidat');
		$query = $this->db->get();
		return $query->result();
	}

	//detail kandidat
	public function detail_kandidat($nim){
		$this->db->select('*');
		$this->db->from('kandidat');
		$this->db->join('image_kadidat', 'image_kadidat.nim = kandidat.nim');
		$this->db->join('visimisi', 'visimisi.no_kandidat = kandidat.no_kandidat');
		$this->db->where('kandidat.nim', $nim);
		$query = $this->db->get();
			if($query->num_rows() >0){
				return $query->result();
			}
			else{
				return false;
			}
	}

	//update profile kandidat
	public function update_kandidat($nim, $data){
		$this->db->where('nim', $nim);
		$this->db->update('kandidat', $data);
		if($this->db->affected_rows()==1){
			return true;
		}
		else{
			return false;
		}
	}
	//visi misi
	public function visi_misi($no, $data){
		$this->db->update('visimisi', $data, 'no_kandidat='.$no);
		if($this->db->affected_rows()==1){
			return true;
		}
		else{
			return false;
		}
	}

	//update photo
	public function photo_kandidat_update($nim, $data){
		$this->db->update('image_kadidat', $data, 'nim='.$nim);
		if($this->db->affected_rows()==1){
			return true;
		}
		else{
			return false;
		}
	}

	//hapus kandidat
	public  function hapus_kandidat($nim){
		$tables = array('kandidat','image_kadidat');
		$this->db->where('nim', $nim);
		$this->db->delete($tables);
		if($this->db->affected_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}

	//search kandidat 
	public function search_kandidat($clue)
	{
		$this->db->select('*');
		$this->db->from('kandidat');
		$this->db->like('nama', $clue);
		$this->db->or_like('no_kandidat', $clue);
		$query = $this->db->get();
		return $query->result();
	}

	//visi misi
	public function visimisi(){
		$this->db->select('*');
		$this->db->from('visimisi');
		$query = $this->db->get();
		return $query->result();
	}

	//proses tambah visi misi
	public function proses_tambah_visimisi($data)
	{	$this->db->select('*');
		$this->db->from('visimisi');
		$this->db->where('no_kandidat', $data['no_kandidat']);
		if($query->num_rows()==0){
			$this->db->insert('visimisi', $data);
			if($this->db->affected_rows()>0){
				return true;
			}
		}else{
			return false;
		}
	}

	//cek voting
	public function cekvoting(){
		$this->db->select('*');
		$this->db->from('tgl_voting');
		$query = $this->db->get();
		if($query->num_rows()>0){
		return $query->result();
		}else{
			return;
		}
	}
	//datevoting
	public function datevoting($data){
		$this->db->insert('tgl_voting', $data);
		if($this->db->affected_rows()>0){
			return true;
		}
	}

	//hapus voting
	public function delete_voting($id){
		$this->db->where('id', $id);
		$this->db->delete('tgl_voting');
		if($this->db->affected_rows()==1){
			return true;
		}
		else{
			return false;
		}

	}

	public function update_voting($id, $data){
		$this->db->update('tgl_voting', $data, 'id='.$id);
		if ($this->db->affected_rows() ==1) {
			return true;
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
	public function no_calon(){
		$query ="select * from kandidat order by no_kandidat DESC limit 1";
		$res = $this->db->query($query);
		return $res->row_array();
	}

	public function reset_count(){
		$query = "DELETE from hasil_voting";
		$res = $this->db->query($query);
		return true;
	}

	public function reset_status(){
		$query = "UPDATE detail_user SET status = 'n'";
		$res = $this->db->query($query);
		return true;
	}

	public function select_all_pesan(){
		$this->db->select('*');
		$this->db->from('keluhan');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function pesan($limit=array()){
		$this->db->select('*');
		$this->db->from('keluhan');
		if ($limit != NULL)
		$this->db->limit($limit['perpage'], $limit['offset']);
		return $this->db->get();
		}

}

/* End of file madmin.php */
/* Location: ./application/models/madmin.php */