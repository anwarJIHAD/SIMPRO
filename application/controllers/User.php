<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
	{
		// //$this->check_session();
		$data['user'] = $this->User_model->get();
		$data['planning'] = $this->User_model->uplanning();
		$data['development'] = $this->User_model->udevelopment();
		$data['pinbag'] = $this->User_model->upinbag();
		$data['support'] = $this->User_model->usupport();
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$this->load->view('layout/header', $data);
		$this->load->view('user/vw_user', $data);
		$this->load->view('layout/footer', $data);

	}

	public function indexuserplanning()
	{
		// //$this->check_session();
		$data['planning'] = $this->User_model->planning();
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$this->load->view('layout/header', $data);
		$this->load->view('user/plan/vw_user_planning', $data);
		$this->load->view('layout/footer', $data);
	}

	public function indexuserdevelopment()
	{
		// //$this->check_session();
		$data['development'] = $this->User_model->development();
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$this->load->view('layout/header', $data);
		$this->load->view('user/dev/vw_user_development', $data);
		$this->load->view('layout/footer', $data);
	}

	public function indexuserpinbag()
	{
		// //$this->check_session();
		$data['pinbag'] = $this->User_model->pinbag();
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$this->load->view('layout/header', $data);
		$this->load->view('user/pin/vw_user_pinbag', $data);
		$this->load->view('layout/footer', $data);
	}

	public function indexusersupport()
	{
		// //$this->check_session();
		$data['support'] = $this->User_model->support();
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$this->load->view('layout/header', $data);
		$this->load->view('user/sup/vw_user_support', $data);
		$this->load->view('layout/footer', $data);
	}

	public function sendEmail($email, $password)
	{
		$this->load->library('PHPMailer_load'); // Load Library PHPMailer
		$mail = $this->phpmailer_load->load(); // Mendefinisikan Variabel Mail
		$mail->isSMTP();  // Mengirim menggunakan protokol SMTP
		$mail->Host = 'smtp.gmail.com'; // Host dari server SMTP
		$mail->SMTPAuth = true; // Autentikasi SMTP
		$mail->Username = 'wanda20ti@mahasiswa.pcr.ac.id';
		$mail->Password = '912hayutrisna__';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;

		$mail->setFrom('noreply@testing.com', 'IT Planning - TSI BRKS'); // Sumber email
		$mail->addAddress($email); // Masukkan alamat email dari variabel $email
		$mail->Subject = "PASSWORD"; // Subjek Email
		$mail->msgHtml("Your password is: $password"); // Isi email dengan format HTML

		if (!$mail->send()) {
			return false; // Return false jika pengiriman email gagal
		} else {
			return true; // Return true jika pengiriman email berhasil
		}
	}

	public function tambah()
	{
		////$this->check_session();
		$this->load->helper('my_helper');
		$data['user'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();

		$this->load->library('email');
		$password = generateRandomPassword(8);

		$this->form_validation->set_rules('NIK', 'NIK', 'required|is_unique[user.NIK]', [
			'required' => 'Required!',
			'is_unique' => 'This data is already registered!',
		]);

		$this->form_validation->set_rules('nama', 'nama', 'required', [
			'required' => 'Required'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view("layout/header", $data);
			$this->load->view("user/vw_tambah_user", $data);
			$this->load->view("layout/footer");
		} else {
			$email = $this->input->post('email');

			$data = [
				'NIK' => $this->input->post('NIK'),
				'nama' => $this->input->post('nama'),
				'email' => $email,
				'role' => $this->input->post('role'),
				'password' => $password,
				'gambar' => 'default.png',

			];
			if ($this->User_model->insert($data)) {
				$this->_sendEmail($password);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data User Berhasil Bertambah silahkan cek di email yang didaftarkan</div>');
				redirect('User');
			} else {
				// Jika pengiriman email gagal, tambahkan pesan kesalahan ke dalam flashdata
				//$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to send email. Please check your email configuration.</div>');
				// Jika ingin menampilkan pesan kesalahan spesifik, Anda bisa menggabungkan ErrorInfo ke dalam pesan
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to send email. Please check your email configuration. Error: </div>');
				redirect('User');

			}
		}
	}
	private function _sendEmail($password)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_port' => 587,
			'smtp_user' => 'bpmiriau@gmail.com',
			'smtp_pass' => 'uawe xdyi geuv ucjh',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'wordwrap' => TRUE,
			'smtp_crypto' => 'tls',
			'newline' => "\r\n"

		];
		$data['email'] = $this->input->post('email', true);
		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->SMTPDebug = 2; // Aktifkan output debug
		$this->email->SMTPAuth = true;
		$this->email->from('bpmiriau@gmail.com', 'bp3mi riau');
		$this->email->to($this->input->post('email'));
		// var_dump($password);
		// die;
		$this->email->subject('Akun SIMPRO');
		$this->email->message('Selamat Akun SIMPRO anda Berhasil dibuat dengan  password  : ' . $password);

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}


	}
	public function editpin($id)
	{
		// //$this->check_session();
		$data['user'] = $this->User_model->getById($id);
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$data['role'] = $this->User_model->role();

		$this->form_validation->set_rules('NIK', 'NIK', 'required', [
			'required' => 'Required!',
		]);
		$this->form_validation->set_rules('nama', 'nama', 'required', [
			'required' => 'Required!'
		]);
		$this->form_validation->set_rules('role', 'role', 'required', [
			'required' => 'Required!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view("layout/header", $data);
			$this->load->view("user/pin/vw_ubah_pin", $data);
			$this->load->view("layout/footer");
		} else {
			$data = [
				'NIK' => $this->input->post('NIK'),
				'nama' => $this->input->post('nama'),
				'role' => $this->input->post('role')
			];

			$id_user = $this->input->post('id_user');
			$this->User_model->update(['id_user' => $id_user], $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully updated!</div>');
			redirect('User/indexuserpinbag');
		}
	}

	public function editplan($id)
	{
		//// //$this->check_session();
		$data['user'] = $this->User_model->getById($id);
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$data['role'] = $this->User_model->role();

		$this->form_validation->set_rules('NIK', 'NIK', 'required', [
			'required' => 'Required!',
		]);
		$this->form_validation->set_rules('nama', 'nama', 'required', [
			'required' => 'Required!'
		]);
		$this->form_validation->set_rules('role', 'role', 'required', [
			'required' => 'Required!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view("layout/header", $data);
			$this->load->view("user/plan/vw_ubah_plan", $data);
			$this->load->view("layout/footer");
		} else {
			$data = [
				'NIK' => $this->input->post('NIK'),
				'nama' => $this->input->post('nama'),
				'role' => $this->input->post('role')
			];

			$id_user = $this->input->post('id_user');
			$this->User_model->update(['id_user' => $id_user], $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully updated!</div>');
			redirect('User/indexuserplanning');
		}
	}

	public function editdev($id)
	{
		//// //$this->check_session();
		$data['user'] = $this->User_model->getById($id);
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$data['role'] = $this->User_model->role();

		$this->form_validation->set_rules('NIK', 'NIK', 'required', [
			'required' => 'Required!',
		]);
		$this->form_validation->set_rules('nama', 'nama', 'required', [
			'required' => 'Required!'
		]);
		$this->form_validation->set_rules('role', 'role', 'required', [
			'required' => 'Required!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view("layout/header", $data);
			$this->load->view("user/dev/vw_ubah_dev", $data);
			$this->load->view("layout/footer");
		} else {
			$data = [
				'NIK' => $this->input->post('NIK'),
				'nama' => $this->input->post('nama'),
				'role' => $this->input->post('role')
			];

			$id_user = $this->input->post('id_user');
			$this->User_model->update(['id_user' => $id_user], $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully updated!</div>');
			redirect('User/indexuserdevelopment');
		}
	}

	public function editsup($id)
	{
		//// //$this->check_session();
		$data['user'] = $this->User_model->getById($id);
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
		$data['role'] = $this->User_model->role();

		$this->form_validation->set_rules('NIK', 'NIK', 'required', [
			'required' => 'Required!',
		]);
		$this->form_validation->set_rules('nama', 'nama', 'required', [
			'required' => 'Required!'
		]);
		$this->form_validation->set_rules('role', 'role', 'required', [
			'required' => 'Required!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view("layout/header", $data);
			$this->load->view("user/sup/vw_ubah_sup", $data);
			$this->load->view("layout/footer");
		} else {
			$data = [
				'NIK' => $this->input->post('NIK'),
				'nama' => $this->input->post('nama'),
				'role' => $this->input->post('role')
			];

			$id_user = $this->input->post('id_user');
			$this->User_model->update(['id_user' => $id_user], $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully updated!</div>');
			redirect('User/indexusersupport');
		}
	}


	public function hapusplan($id)
	{
		$this->User_model->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully deleted!</div>');
		redirect('User/indexuserplanning');
	}

	public function hapusdev($id)
	{
		$this->User_model->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully deleted!</div>');
		redirect('User/indexuserdevelopment');
	}

	public function hapuspin($id)
	{
		$this->User_model->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully deleted!</div>');
		redirect('User/indexuserpinbag');
	}

	public function hapussup($id)
	{
		$this->User_model->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully deleted!</div>');
		redirect('User/indexusersupport');
	}
}
?>
