<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Mlogin');
	}

	public function index()
	{
		$this->load->view('login/Vlogin');
	}
	public function check_login()
	{
		$this->form_validation->set_rules('nim', 'NIM', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == FALSE ){
			$this->load->view('login/Vlogin');
		}
		else{
			$akun = array(
			'nim'		=> $this->input->post('nim'),
			'password'	=> md5($this->input->post('password'))
			);

			$result = $this->Mlogin->check_akun($akun);
			if($result != false){
				$result = $this->Mlogin->get_information($akun);
					$session_data = array(
						'nim'	=> $akun['nim'],
						'nama'	=> $result[0]->nama,
						'gambar'=> $result[0]->name,
						'akses'	=> $result[0]->akses,
						'status' => $result[0]->status,
						'loggedin' => true,
						);
					$this->session->set_userdata('logged_in', $session_data);
				if ($result[0]->akses=='a') {
					$hasil['hasil'] = 'a';
					echo json_encode($hasil);
				}
				else{
					$hasil['hasil'] = 'u';
					echo json_encode($hasil);
				}
			}
			else
			{	
				$hasil['hasil'] = 'false';
				echo json_encode($hasil);
			}
	}
}
	public function logout(){
		//menghapus data session
		$sess_array = array(
		'nama' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->load->view('login/Vlogin');
		}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */