<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Madmin');
			$nim = ($this->session->userdata['logged_in']['nim']);
			$login = ($this->session->userdata['logged_in']['loggedin']);
			$akses = ($this->session->userdata['logged_in']['akses']);
			if($akses == 'u'){
			redirect (site_url('User'));
			}

			if(!$login){
			redirect (site_url('Login'));
			}
	}

	public function index()
	{
		$this->load->view('admin/Dashboard');
	}


	public function vinsert_pengumuman(){
		$this->load->view('admin/Vinsert_pengumuman');
	}
	public function insert_pengumuman(){

		$this->form_validation->set_rules('judul', 'Title', 'required');
		$this->form_validation->set_rules('keterangan', 'Description', 'required');

		if($this->form_validation->run() == FALSE ){
			$this->load->view('admin/Vinsert_pengumuman');
		}
		else{
			date_default_timezone_set('Asia/Kuala_Lumpur');
			$date = date('Y-m-d H:i:s');
			$pengumuman=array(
				'judul' => $this->input->post('judul'),
				'deskripsi' => $this->input->post('keterangan'),
				'last_edited'	=>$date,
			);
			$result = $this->Madmin->insert_pengumuman($pengumuman);
			if ($result !=false){
				$hasil['hasil'] = 'true';
				echo json_encode($hasil);
			}
			else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
		}
	}
	//pengumuman
	public function daftar_pengumuman(){
		$data['data'] = $this->Madmin->select_data();
		$this->load->view('admin/Daftar_pengumuman', $data);
	}

	public function edit_pengumuman(){
		$id_peng = $this->input->get('id');
		$data['data'] = $this->Madmin->edit_pengumuman($id_peng);
		$this->load->view('admin/Vedit_pengumuman', $data);
		$this->session->set_flashdata('id', $id_peng);
	}

	public function proses_edit_pengumuman(){
		$id = $this->session->flashdata('id');
		date_default_timezone_set('Asia/Kuala_Lumpur');
		$date = date('Y-m-d H:i:s');
		$data_update = array(
			'judul'	=> $this->input->post('judul'),
			'deskripsi'	=> $this->input->post('keterangan'),
			'last_edited'	=> $date
			);
		$return = $this->Madmin->proses_edit_pengumuman($id, $data_update);
		if($return != false){
			$hasil['hasil'] = 'true';
			echo json_encode($hasil);
		}
		else{
			$hasil['hasil'] = 'false';
			echo json_encode($hasil);
		}

	}
	public function delete_pengumuman(){
		$id_peng = $this->input->get('id');
		$result = $this->Madmin->delete_pengumuman($id_peng);
		if ($result !=false){
			$hasil['hasil'] = 'true';
			echo json_encode($hasil);
			}
			else{
			$hasil['hasil'] = 'false';
			echo json_encode($hasil);
			}
	}

	public function search_pengumuman()
	{
		$clue = $this->input->post('search');
		$data['data'] = $this->Madmin->search_pengumuman($clue);
		$this->load->view('admin/Daftar_pengumuman', $data);
	}
	//akhir pengumuman
	//load view generate code
	public function generate_code(){
		$this->load->view('admin/Generate_code');
	}
	//tambah user baru
	public function tambah_user(){
		$this->form_validation->set_rules('nim', 'NIM', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('password', 'Generate Password', 'required');
		$this->form_validation->set_rules('user', 'User or Admin', 'required');

		if($this->form_validation->run() == FALSE ){
			$this->load->view('admin/Generate_code');
		}
		else{
			$data_login = array(
				'nim' => $this->input->post('nim'),
				'password'	=> md5(str_replace(' ', '', $this->input->post('password'))),
				'akses'	=> $this->input->post('user')
				);
			$get_angkatan = substr ($data_login['nim'], 0, 2 );
			$angkatan = "20".$get_angkatan;
			$nama = $this->input->post('nama');
			//daftar login akun
			$result = $this->Madmin->tambah_user($data_login);
			if($result !=false){
				//set user detail data
				$data_akun = array(
					'nim'	=> $data_login['nim'],
					'nama'	=> $nama,
					'no_telp' => 'null',
					'jurusan'	=> 'null',
					'angkatan'	=>$angkatan,
					'status'	=>'n'
					);
			$result_detail = $this->Madmin->detail_user($data_akun);
			if($result_detail != false){
				$data_image = array(
					'nim'	=> $data_login['nim'],
					'name'	=> '1.jpg',
					'type'	=> 'jpeg'
					);
				$result_image = $this->Madmin->image_user($data_image);
				if($result_image !=false){
						$hasil['hasil'] = 'true';
						echo json_encode($hasil);
					}
				else{
						echo '<script type="text/javascript">alert("Gagal!!!")</script>';
						$this->Madmin->user_image_gagal($data_login['nim']);
						redirect(site_url(), 'refresh');
				}
				}
			else{
					echo '<script type="text/javascript">alert("Gagal!!!")</script>';
					$this->Madmin->user_detail_gagal($data_login['nim']);
					redirect(site_url(), 'refresh');
				}
			}
			else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
		}
	}
	//akhir dari tambah user
	//menampilkan user
	public function daftar_user($offset=0){
		//tentukan jumlah tampil perpage
		$perpage= 4;


		//konfigurasi tampilan paging

		$config = array(
			'base_url'	=> site_url('admin/daftar_user'),
			'total_rows'=>$this->Madmin->select_all(),

			'per_page'	=>$perpage,
			'full_tag_open'	=> "<ul class='pagination'>",
			'full_tag_close'=> "</ul>",
			'num_tag_open'	=> '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open'	=> '<li class="active blue"><a href="#">',
			'cur_tag_close'	=> '</a></li>',
			'next_tag_open' => "<li>",
	  		'next_tagl_close' => "</li>",
	   		'prev_tag_open' => "<li>",
	   		'prev_tagl_close' => "</li>",
	   		'first_tag_open' => "<li>",
	   		'first_tagl_close' => "</li>",
	  		'last_tag_open'=>"<li>",
	   		'last_tagl_close' => "</li>",
			);

		//inisialisasi pagination dan config
		$this->pagination->initialize($config);
		$limit['perpage'] = $perpage;
		$limit['offset'] = $offset;
		$data['no'] = $offset+1;
		$data['data'] = $this->Madmin->daftar_user($limit)->result();
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('admin/Vdaftaruser', $data);
	}

	public function user_akun_detail(){
		$nim = $this->input->get('id');
		$detail['user_data'] = $this->Madmin->user_akun_detail($nim);
		$this->load->view('admin/Detail_user_pemilih', $detail);
		$this->session->set_flashdata('nim', $nim);
	}

	public function user_akun(){
		$nim = $this->input->get('id');
		$detail['user_data'] = $this->Madmin->user_akun_detail($nim);
		$this->load->view('admin/Detail_user', $detail);
		$this->session->set_flashdata('nim', $nim);
	}

	//update info
	public function update_info(){
		$nim = $this->session->flashdata('nim');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telephone', 'required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
		if($this->form_validation->run() == FALSE){
			redirect(site_url());
		}
		else{
			$data = array(
				'nama'		=> $this->input->post('nama'),
				'no_telp'	=> $this->input->post('no_telp'),
				'jurusan'	=> $this->input->post('jurusan')
				);
			$result = $this->Madmin->update_info($nim, $data);
			if($result == TRUE){
					$result = $this->Madmin->get_information($nim);
					$session_data = array(
						'nim'	=> $nim,
						'nama'	=> $result[0]->nama,
						'gambar'=> $result[0]->name,
						'akses'	=> $result[0]->akses,
						'status' => $result[0]->status,
						'loggedin' => true,
						);
				$this->session->set_userdata('logged_in', $session_data);
				$hasil['hasil'] = 'true';
				echo json_encode($hasil);
			}
			else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
		}
	}
	//hapus user
	public function hapus_user(){
		$nim = $this->input->get('id');
		$result = $this->Madmin->hapus_akun($nim);
		if($result == TRUE){
			$hasil['hasil'] = 'true';
			echo json_encode($hasil);
		}
		else{
			$hasil['hasil'] = 'false';
			echo json_encode($hasil);
		}
	}

	//update akun
	public function update_akun(){
		$nim = $this->session->flashdata('nim');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		if($this->form_validation->run() == FALSE){
			redirect(site_url());
		}
		else{
			$data = array(
				'password'	=> md5($this->input->post('pass')),
				);
			$result = $this->Madmin->update_akun($nim, $data);
			if($result == TRUE){
				$hasil['hasil'] = 'true';
				echo json_encode($hasil);
			}
			else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
		}
	}

	//update photo
	public function photo_user(){
		//berfungsi saat submit ditekan namun file kosong supaya tidak masuk ke database
		$nim = ($this->session->userdata['logged_in']['nim']);
		if (empty($_FILES['imgName']['name']))
			{
			    $this->form_validation->set_rules('imgName', 'Document', 'required');
			    redirect(base_url());
			}
		else{
		$this->load->library('upload');
		$namafile = "file_".time();
		//konfigurasi ukuran dan type yang bisa di upload
		$config = array(
		'upload_path' => "./pictures/", //mengatur lokasi penyimpanan gambar
		'allowed_types' => "gif|jpg|png|jpeg|pdf", // mengatur type yang boleh disimpan
		'overwrite' => TRUE,
		'max_size' => "2048000",//maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
		'max_height' => "768",
		'max_width' => "1024",
		'file_name'	=> $namafile //nama file yang akan terimpan nanti
		);

		$this->upload->initialize($config);
		if($_FILES['imgName']['name']){
			if($this->upload->do_upload('imgName')){
				$gambar =  $this->upload->data();

				//data yang akan di insert ke database
				$data = array(
					'name'	=> $gambar['file_name'],
					'type'	=> $gambar['file_type']
					);
				$result = $this->Madmin->photo($nim, $data);
				if($result != FALSE){
					$result = $this->Madmin->get_information($nim);
					$session_data = array(
						'nim'	=> $nim,
						'nama'	=> $result[0]->nama,
						'gambar'=> $result[0]->name,
						'akses'	=> $result[0]->akses,
						'status' => $result[0]->status,
						'loggedin' => true,
						);
					$this->session->set_userdata('logged_in', $session_data);
					redirect(site_url(), 'refresh');
					}
				}
			}
		}
	}

	//update photo
	public function photo(){
		//berfungsi saat submit ditekan namun file kosong supaya tidak masuk ke database
		$nim = $this->session->flashdata('nim');
		if (empty($_FILES['imgName']['name']))
			{
			    $this->form_validation->set_rules('imgName', 'Document', 'required');
			    redirect(base_url());
			}
		else{
		$this->load->library('upload');
		$namafile = "file_".time();
		//konfigurasi ukuran dan type yang bisa di upload
		$config = array(
		'upload_path' => "./pictures/", //mengatur lokasi penyimpanan gambar
		'allowed_types' => "gif|jpg|png|jpeg|pdf", // mengatur type yang boleh disimpan
		'overwrite' => TRUE,
		'max_size' => "2048000",//maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
		'max_height' => "768",
		'max_width' => "1024",
		'file_name'	=> $namafile //nama file yang akan terimpan nanti
		);

		$this->upload->initialize($config);
		if($_FILES['imgName']['name']){
			if($this->upload->do_upload('imgName')){
				$gambar =  $this->upload->data();

				//data yang akan di insert ke database
				$data = array(
					'name'	=> $gambar['file_name'],
					'type'	=> $gambar['file_type']
					);
				$result = $this->Madmin->photo($nim, $data);
				if($result != FALSE){
					echo '<script type="text/javascript">alert("Berhasil!!!")</script>';
					redirect(site_url('Admin/daftar_user'), 'refresh');
					}
				}
			}
		}
	}

	public function update_info_pemilih(){
		$nim = $this->session->flashdata('nim');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telephone', 'required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
		if($this->form_validation->run() == FALSE){
			redirect(site_url());
		}
		else{
			$data = array(
				'nama'		=> $this->input->post('nama'),
				'no_telp'	=> $this->input->post('no_telp'),
				'jurusan'	=> $this->input->post('jurusan')
				);
			$result = $this->Madmin->update_info($nim, $data);
			if($result == TRUE){
				$hasil['hasil'] = 'true';
				echo json_encode($hasil);
			}
			else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
		}
	}
	//search user
	public function search_user()
	{
		$clue = $this->input->post('search');
		$result['data'] = $this->Madmin->search_user($clue);
		$this->load->view('admin/Vdaftaruser', $result);
	}
	 //akhir dari user

	//start kandidat
	public function vdaftar_kandidat(){
		$this->load->view('admin/Vdaftarkandidat');
	}
	//tambah kandidat
	public function tambah_kandidat(){
		$this->form_validation->set_rules('nim', 'NIM', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('no_kandidat', 'No Kandidat', 'required');
		$this->form_validation->set_rules('image', 'Image', 'required');
		if($this->form_validation->run()==FALSE){
			$this->load->view('admin/Vdaftarkandidat');
		}
		else{
			$data_kandidat= array(
				'nim' => $this->input->post('nim'),
				'nama' => $this->input->post('nama'),
				'jurusan' => $this->input->post('jurusan'),
				'no_kandidat' => $this->input->post('no_kandidat'),
				'jabatan' => $this->input->post('jabatan')
				);
			$ceknim = $this->Madmin->ceknim($data_kandidat['nim']);
			if($ceknim == false){
			$result = $this->Madmin->tambah_kandidat($data_kandidat);
			if($result == TRUE){
				$this->load->library('upload');
				$namafile = "file_".time();
				//konfigurasi ukuran dan type yang bisa di upload
				$config = array(
				'upload_path' => "./pictures/", //mengatur lokasi penyimpanan gambar
				'allowed_types' => "gif|jpg|png|jpeg|pdf", // mengatur type yang boleh disimpan
				'overwrite' => TRUE,
				'max_size' => "2048000",//maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
				'max_height' => "768",
				'max_width' => "1024",
				'file_name'	=> $namafile //nama file yang akan terimpan nanti
				);

				$this->upload->initialize($config);
				if($_FILES['image']['name']){
					if($this->upload->do_upload('image')){
						$gambar =  $this->upload->data();

						//data yang akan di insert ke database
						$data = array(
							'nim'	=> $data_kandidat['nim'],
							'name'	=> $gambar['file_name'],
							'type'	=> $gambar['file_type']
							);
						$result = $this->Madmin->photo_kandidat($data);
						if($result != FALSE){
							echo '<script type="text/javascript">alert("Berhasil!!!")</script>';
							redirect(site_url(), 'refresh');
							}
						}
					}
				}else{
					echo '<script type="text/javascript">alert("Gagal Duplicate Entry!!!")</script>';
					redirect(site_url(), 'refresh');
				}
			}else{
				echo '<script type="text/javascript">alert("Gagal Duplicate Entry!!!")</script>';
					redirect(site_url(), 'refresh');
			}
		}
	}

	//lihat semua kandidat
	public function vkandidat(){
		$data['daftar_kandidat'] = $this->Madmin->vkandidat();
		$this->load->view('admin/Vkandidat', $data);
	}

	//detail kandidat
	public function detail_kandidat(){
		$nim = $this->input->get('id');
		$this->session->set_flashdata('nim_kandidat', $nim);
		$detail['data'] = $this->Madmin->detail_kandidat($nim);
		$this->load->view('admin/Vdetail_kandidat', $detail);
	}

	//update kandidat
	public function update_kandidat(){
		$this->form_validation->set_rules('nim', 'Nim', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('kandidat', 'Kandidat', 'required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		if($this->form_validation->run() == FALSE){
			redirect(site_url());
		}
		else{
			$nim = $this->input->post('nim');
			$data = array(
				'nama'		=> $this->input->post('nama'),
				'jurusan'	=> $this->input->post('jurusan'),
				'no_kandidat'	=> $this->input->post('kandidat'),
				'jabatan'	=> $this->input->post('jabatan')
				);
			$result = $this->Madmin->update_kandidat($nim, $data);
			if($result == TRUE){
				$hasil['hasil'] = 'true';
				echo json_encode($hasil);
			}
			else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
		}
	}
	//visi misi
	public function visi_misi(){
		$this->form_validation->set_rules('visi', 'Visi', 'required');
		$this->form_validation->set_rules('misi', 'Misi', 'required');
		if($this->form_validation->run() == FALSE){
			redirect(site_url('admin/vkandidat'));
		}else{
			$no = $this->input->post('no');
			$data = array(
				'visi' 	=> $this->input->post('visi'),
				'misi'	=> $this->input->post('misi')
				);
			$result = $this->Madmin->visi_misi($no, $data);
			if ($result != FALSE) {
				echo '<script type="text/javascript">alert("Update Berhasil!!!")</script>';
				redirect(site_url('admin/vkandidat'), 'refresh');
			}else{
				echo '<script type="text/javascript">alert("Gagal!!!")</script>';
				redirect(site_url('admin/vkandidat'), 'refresh');
			}
		}
	}
	//update photo kandidat
	public function photo_kandidat_update(){
		//berfungsi saat submit ditekan namun file kosong supaya tidak masuk ke database
		if (empty($_FILES['imgName']['name']))
			{
			    $this->form_validation->set_rules('imgName', 'Document', 'required');
			    redirect(base_url());
			}
		else{
		$nim = $this->session->flashdata('nim_kandidat');
		$this->load->library('upload');
		$namafile = "file_".time();
		//konfigurasi ukuran dan type yang bisa di upload
		$config = array(
		'upload_path' => "./pictures/", //mengatur lokasi penyimpanan gambar
		'allowed_types' => "gif|jpg|png|jpeg|pdf", // mengatur type yang boleh disimpan
		'overwrite' => TRUE,
		'max_size' => "2048000",//maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
		'max_height' => "768",
		'max_width' => "1024",
		'file_name'	=> $namafile //nama file yang akan terimpan nanti
		);

		$this->upload->initialize($config);
		if($_FILES['imgName']['name']){
			if($this->upload->do_upload('imgName')){
				$gambar =  $this->upload->data();

				//data yang akan di insert ke database
				$data = array(
					'name'	=> $gambar['file_name'],
					'type'	=> $gambar['file_type']
					);
				$result = $this->Madmin->photo_kandidat_update($nim, $data);
				if($result != FALSE){
					echo '<script type="text/javascript">alert("Delete Berhasil!!!")</script>';
					redirect(site_url('admin/vkandidat'), 'refresh');

					}
				}
			}
		}
	}

	//delete kandidat
	public  function hapus_kandidat()
	{
		$nim = $this->input->get('id');
		$result = $this->Madmin->hapus_kandidat($nim);
		if ($result == TRUE) {
			$hasil['hasil'] = 'true';
			echo json_encode($hasil);
		}
	}
	public function search_kandidat()
	{
		$clue = $this->input->post('search');
		$data['daftar_kandidat'] = $this->Madmin->search_kandidat($clue);
		$this->load->view('admin/Vkandidat', $data);
	}

	//visi misi
	public function visimisi(){
		$data['daftar_visimisi'] = $this->Madmin->visimisi();
		$this->load->view('admin/Visimisi', $data);
	}

	public function tambah_visimisi(){
		$result['no'] = $this->Madmin->no_visimisi();
		$this->load->view('admin/Tambah_visimisi', $result);
	}
	public function proses_tambah_visimisi(){
		$this->form_validation->set_rules('visi', 'Visi', 'required');
		$this->form_validation->set_rules('misi', 'Misi', 'required');
		if($this->form_validation->run() == FALSE){
			redirect(site_url('admin/visimisi'));
		}else{
			$data = array(
				'no_kandidat'	=> $this->input->post('no'),
				'visi' 	=> $this->input->post('visi'),
				'misi'	=> $this->input->post('misi')
				);
			$result = $this->Madmin->proses_tambah_visimisi($data);
			if($result != FALSE){
				$hasil['hasil'] = 'true';
				echo json_encode($hasil);
			}else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
		}
	}

	//startvoting
	public function startvoting()
	{
		$result['tgl_voting'] = $this->Madmin->cekvoting();
		$this->load->view('admin/Startvoting', $result);
	}

	public function datevoting()
	{
		$this->form_validation->set_rules('start', 'Start', 'required');
		$this->form_validation->set_rules('end', 'End', 'required');
		if($this->form_validation->run()==FALSE){
			$this->load->view('admin/Startvoting');
		}else{
			date_default_timezone_set('Asia/Bangkok');
			$tanggal_start =$this->input->post('start');
			$waktu_start = $this->input->post('waktu_start');
			$tanggal_end = $this->input->post('end');
			$waktu_end = $this->input->post('waktu_end');
			$s = strtotime("$waktu_start $tanggal_start");
			$e = strtotime("$waktu_end $tanggal_end");
			$start = date("Y:m:d H:i:s", $s);
			$end = date("Y:m:d H:i:s", $e);

			$data = array(
				'start' => $start,
				'end'	=> $end
				);
			$result = $this->Madmin->datevoting($data);
			if($result != FALSE){
				$hasil['hasil'] = 'true';
				echo json_encode($hasil);
			}else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
		}

	}

	public function delete_voting(){
		$id = $this->input->get('data');
		$result = $this->Madmin->delete_voting($id);
		if($result != FALSE){
				$hasil['hasil'] = 'true';
				echo json_encode($hasil);
			}else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
	}

	public function update_voting(){
		date_default_timezone_set('Asia/Bangkok');
			$tanggal_start =$this->input->post('start');
			$waktu_start = $this->input->post('waktu_start');
			$tanggal_end = $this->input->post('end');
			$waktu_end = $this->input->post('waktu_end');
			$id = $this->input->post('id');
			$s = strtotime("$waktu_start $tanggal_start");
			$e = strtotime("$waktu_end $tanggal_end");
			$start = date("Y:m:d H:i:s", $s);
			$end = date("Y:m:d H:i:s", $e);
			$data = array(
				'start' => $start,
				'end'	=> $end
				);
			$result = $this->Madmin->update_voting($id,$data);
			if($result != FALSE){
				$hasil['hasil'] = 'true';
				echo json_encode($hasil);
			}else{
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
	}

	public function quickqount(){
		$result ['no_calon'] = $this->Madmin->no_calon();
		$result['suara'] = array();
		$kandidat = $result['no_calon']['no_kandidat'];
		for($i=1; $i<=$kandidat; $i++){
			$result['suara'][$i] = $this->Madmin->quickcount($i);
		}
		$this->load->view('admin/Quickcount', $result);
	}

	public function reset(){
		$this->Madmin->reset_count();
		$this->Madmin->reset_status();
		redirect(site_url());
	}

	public function pesan($offset=0){
		//tentukan jumlah tampil perpage
		$perpage= 4;


		//konfigurasi tampilan paging

		$config = array(
			'base_url'	=> site_url('Admin/pesan'),
			'total_rows'=>$this->Madmin->select_all_pesan(),

			'per_page'	=>$perpage,
			'full_tag_open'	=> "<ul class='pagination'>",
			'full_tag_close'=> "</ul>",
			'num_tag_open'	=> '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open'	=> '<li class="active blue"><a href="#">',
			'cur_tag_close'	=> '</a></li>',
			'next_tag_open' => "<li>",
	  		'next_tagl_close' => "</li>",
	   		'prev_tag_open' => "<li>",
	   		'prev_tagl_close' => "</li>",
	   		'first_tag_open' => "<li>",
	   		'first_tagl_close' => "</li>",
	  		'last_tag_open'=>"<li>",
	   		'last_tagl_close' => "</li>",
			);

		//inisialisasi pagination dan config
		$this->pagination->initialize($config);
		$limit['perpage'] = $perpage;
		$limit['offset'] = $offset;
		$data['no'] = $offset+1;
		$data['data'] = $this->Madmin->pesan($limit)->result();
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('admin/V_pesan', $data);
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
