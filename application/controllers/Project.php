<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
        $this->load->model('User_model');
        $this->load->model('Jenisproject_model');
        $this->load->model('Jenisaplikasi_model');
        $this->load->model('Development_model');
        
    }
 
	public function index()
    { 
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->get();
        $data['progrespro'] = $this->Project_model->progresproject();
        $data['donepro'] = $this->Project_model->doneproject();
        $data['allpro'] = $this->Project_model->all();
        $data['stat'] = $this->Project_model->status();
        $data['dev'] = $this->Development_model->get();
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        $this->load->view('layout/header',$data);
        $this->load->view('project/vw_dashboard',$data);
        $this->load->view('layout/footer',$data);
    }
    public function indexlistproject()
    { 
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->get();
        $data['dev'] = $this->Development_model->get();
        // $data['devbyid'] = $this->Development_model->getkeg($id);
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        $this->load->view('layout/header',$data);
        $this->load->view('project/vw_list_project',$data);
        $this->load->view('layout/footer',$data);
    }
    public function indexhistory()
    { 
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->gethistory();
        $data['dev'] = $this->Development_model->get();
        // $data['devbyid'] = $this->Development_model->getkeg($id);
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        $this->load->view('layout/header',$data);
        $this->load->view('project/vw_history_project',$data);
        $this->load->view('layout/footer',$data);
    }

    public function indexsearch()
	{
        
		$keyword = $this->input->get('keyword');
		$data = $this->Project_model->get($keyword);
		$data = array(
			'keyword'	=> $keyword,
			'data'		=> $data
		);
        $data['project'] = $this->Project_model->get($keyword);
        $data['dev'] = $this->Development_model->get();
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        $this->load->view('layout/header',$data);
        $this->load->view('project/vw_list_project',$data);
        $this->load->view('layout/footer',$data);
	}

    public function tambahproject()
    {

        $data['judul'] = "Halaman Tambah Project";
        $data['user'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        $data['project'] = $this->Project_model->get();
        $data['jenisproject'] = $this->Jenisproject_model->get();
        $data['jenisaplikasi'] = $this->Jenisaplikasi_model->get();
		$data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();

            $this->form_validation->set_rules('namaaplikasi', 'namaaplikasi', 'required', [
                'required' => 'Nama aplikasi tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('jenisproject', 'jenisproject', 'required', [
                'required' => 'Jenis Project user tidak boleh kosong'
            ]);
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("Project/vw_tambah_project", $data);
            $this->load->view("layout/footer");
        } else {
				$data = array(
                    'namaaplikasi'  => $this->input->post('namaaplikasi'),
                    'jenisproject' => $this->input->post('jenisproject'),
                    'jenisaplikasi' => $this->input->post('jenisaplikasi'),
                    'plan' => $this->input->post('plan'),
                    'actual' => $this->input->post('actual'),
                    'target' => $this->input->post('target'),
                    'tanggalregister' => $this->input->post('tanggalregister')
                );
			   
               $upload_image = $_FILES['urf']['name'];       
               if ($upload_image) {
               $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
               $config['max_size'] = '2048';
               $config['upload_path'] = './assets/dokumenurf/';
               $this->load->library('upload', $config);
               if ($this->upload->do_upload('urf')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('urf', $new_image);
                } else {
                   echo $this->upload->display_errors();
                   }
               } 
			$this->Project_model->insert($data, $upload_image);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Ditambah!</div>');
            redirect('Project/indexlistproject');
            }  
           
    }
    public function detail($id)
    { 
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->get();
        $data['project1'] = $this->Project_model->getById($id);
        $data['dev'] = $this->Development_model->getkeg($id);
        $data['jenisproject'] = $this->Jenisproject_model->get();
        $data['jenisaplikasi'] = $this->Jenisaplikasi_model->get();
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        $data['hitung'] = $this->Project_model->hitung();
        $this->load->view('layout/header',$data);
        $this->load->view('project/vw_detail_project',$data);
        $this->load->view('layout/footer',$data);
    }

    public function editproject()
    { 
        $this->form_validation->set_rules('bobotbrd', 'bobotbrd', 'required|less_than_equal_to[10]',[
            'required' => 'NIK tidak boleh kosong',   
            ]);
            $this->form_validation->set_rules('progresbrd', 'progresbrd', 'required|less_than_equal_to[10]', [
                'required' => 'Nama User tidak boleh kosong', 'less_than_equal_to[10]'=> 'Progres tidak boleh lebih dari 10'
            ]);

        $id = $this->input->post('id_project');
        $data = array(
            'namaaplikasi'  => $this->input->post('namaaplikasi'),
            'jenisproject' => $this->input->post('jenisproject'),
            'jenisaplikasi' => $this->input->post('jenisaplikasi'),
            'plan' => $this->input->post('plan'),
            'actual' => $this->input->post('actual'),
            'keterangan' => $this->input->post('keterangan'),
            'target' => $this->input->post('target'),
            'tanggalregister' => $this->input->post('tanggalregister')
        );
        $upload_image = $_FILES['urf']['name'];       
               if ($upload_image) {
               $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
               $config['max_size'] = '2048';
               $config['upload_path'] = './assets/dokumenurf/';
               $this->load->library('upload', $config);
               if ($this->upload->do_upload('urf')) {
                $old_image = $data['tb_project']['urf'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/dokumenurf/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
               $this->db->set('urf', $new_image);
               } else {
                   echo $this->upload->display_errors();
                   }
               } 
        $this->Project_model->ubah($data,$id,$upload_image);
        $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('project/detail/'.$id);
    }
    
    public function hapusproject($id)
    {
        $this->Project_model->delete($id);
        redirect('Project/indexlistproject');
    }
    
    public function detailbrd($id)
    {
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->get();
        $data['project1'] = $this->Project_model->getById($id);
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
            $this->load->view("layout/header", $data);
            $this->load->view("Project/kegiatan/vw_brd", $data);
            $this->load->view("layout/footer");
    }   
    public function editbrd()
    { 
        $this->form_validation->set_rules('bobotbrd', 'bobotbrd', 'required|less_than_equal_to[10]',[
            'required' => 'NIK tidak boleh kosong',   
            ]);
            $this->form_validation->set_rules('progresbrd', 'progresbrd', 'required|less_than_equal_to[10]', [
                'required' => 'Nama User tidak boleh kosong', 'less_than_equal_to[10]'=> 'Progres tidak boleh lebih dari 10'
            ]);

        $id = $this->input->post('id_project');
        $data = array(
            'bobotbrd'  => $this->input->post('bobotbrd'),
            'progresbrd' => $this->input->post('progresbrd'),
            'planstdatebrd' => $this->input->post('planstdatebrd'),
            'planendatebrd' => $this->input->post('planendatebrd'),
            'actualstdatebrd' => $this->input->post('actualstdatebrd'),
            'actualendatebrd' => $this->input->post('actualendatebrd')
        );
        $upload_image = $_FILES['filebrd']['name'];       
               if ($upload_image) {
               $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
               $config['max_size'] = '2048';
               $config['upload_path'] = './assets/dokumenbrd/';
               $this->load->library('upload', $config);
               if ($this->upload->do_upload('filebrd')) {
                $old_image = $data['tb_project']['filebrd'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/dokumenbrd/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
               $this->db->set('filebrd', $new_image);
               } else {
                   echo $this->upload->display_errors();
                   }
               } 
        $this->Project_model->ubah($data,$id,$upload_image);
        $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('project/detailbrd/'.$id);
    }
    
    public function detailfsd($id)
    { 
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->get();
        $data['project1'] = $this->Project_model->getById($id);
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        
            $this->load->view("layout/header", $data);
            $this->load->view("Project/kegiatan/vw_fsd", $data);
            $this->load->view("layout/footer"); 
    }
    public function editfsd()
    { 
        
        $id = $this->input->post('id_project');
        $data = array(
            'bobotfsd'  => $this->input->post('bobotfsd'),
            'progresfsd' => $this->input->post('progresfsd'),
            'planstdatefsd' => $this->input->post('planstdatefsd'),
            'planendatefsd' => $this->input->post('planendatefsd'),
            'actualstdatefsd' => $this->input->post('actualstdatefsd'),
            'actualendatefsd' => $this->input->post('actualendatefsd')
        );
        $this->Project_model->ubah($data,$id);
        $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('project/detailfsd/'.$id);
    }

    public function detaildev($id)
    { 
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->get();
        $data['project1'] = $this->Project_model->getById($id);
        $data['dev'] = $this->Development_model->getkeg($id);
        $data['dev1'] = $this->Development_model->getById($id);
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        
            $this->load->view("layout/header", $data);
            $this->load->view("Project/kegiatan/vw_dev", $data);
            $this->load->view("layout/footer"); 
    }
    public function editdev($id)
    {   
        
        $data['judul'] = "";
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->getById($id);
        $data['dev'] = $this->Development_model->get();
        $data['dev1'] = $this->Development_model->getById($id);
        $id = $this->input->post('project_id');
         $data = [
            'project_id'  => $this->input->post('project_id'),
            'namakeg'  => $this->input->post('namakeg'),
            'bobot'  => $this->input->post('bobot'),
            'progres' => $this->input->post('progres'),
            'planstdate' => $this->input->post('planstdate'),
            'planendate' => $this->input->post('planendate'),
            'actualstdate' => $this->input->post('actualstdate'),
            'actualendate' => $this->input->post('actualendate')
			];
         $this->Development_model->insert($data);
         redirect('Project/detaildev/'.$id);
    }

    public function ubahdev($id)
    {   
        $data['judul'] = "";
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->getById($id);
        $data['project1'] = $this->Project_model->getById($id);
        $data['dev'] = $this->Development_model->get();
        $data['dev1'] = $this->Development_model->getById($id);
        $id = $this->input->post('project_id');
         $data = [
            'project_id'  => $this->input->post('project_id'),
            'namakeg'  => $this->input->post('namakeg'),
            'bobot'  => $this->input->post('bobot'),
            'progres' => $this->input->post('progres'),
            'planstdate' => $this->input->post('planstdate'),
            'planendate' => $this->input->post('planendate'),
            'actualstdate' => $this->input->post('actualstdate'),
            'actualendate' => $this->input->post('actualendate')
			];
            $this->Development_model->ubah($data,$id);
         redirect('Project/detaildev/'.$id);
    }


    public function detailsit($id)
    { 
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->get();
        $data['project1'] = $this->Project_model->getById($id);
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        
            $this->load->view("layout/header", $data);
            $this->load->view("Project/kegiatan/vw_sit", $data);
            $this->load->view("layout/footer"); 
    }
    public function editsit()
    { 
        
        $id = $this->input->post('id_project');
        $data = array(
            'bobotsit'  => $this->input->post('bobotsit'),
            'progressit' => $this->input->post('progressit'),
            'planstdatesit' => $this->input->post('planstdatesit'),
            'planendatesit' => $this->input->post('planendatesit'),
            'actualstdatesit' => $this->input->post('actualstdatesit'),
            'actualendatesit' => $this->input->post('actualendatesit')
        );
        $this->Project_model->ubah($data,$id);
        $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('project/detailsit/'.$id);
    }
    public function detailuat($id)
    { 
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->get();
        $data['project1'] = $this->Project_model->getById($id);
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
            $this->load->view("layout/header", $data);
            $this->load->view("Project/kegiatan/vw_uat", $data);
            $this->load->view("layout/footer");  
    }
    public function edituat()
    { 
        
        $id = $this->input->post('id_project');
        $data = array(
            'bobotuat'  => $this->input->post('bobotuat'),
            'progresuat' => $this->input->post('progresuat'),
            'planstdateuat' => $this->input->post('planstdateuat'),
            'planendateuat' => $this->input->post('planendateuat'),
            'actualstdateuat' => $this->input->post('actualstdateuat'),
            'actualendateuat' => $this->input->post('actualendateuat')
        );
        $this->Project_model->ubah($data,$id);
        $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('project/detailuat/'.$id);
    }
    public function detailmigrasi($id)
    { 
        $data['user'] = $this->User_model->get();
        $data['project'] = $this->Project_model->get();
        $data['project1'] = $this->Project_model->getById($id);
        $data['user1'] = $this->db->get_where('user', ['NIK' => $this->session->userdata('NIK')])->row_array();
        
            $this->load->view("layout/header", $data);
            $this->load->view("Project/kegiatan/vw_migrasi", $data);
            $this->load->view("layout/footer");
    }
    public function editmigrasi()
    { 
        
        $id = $this->input->post('id_project');
        $data = array(
            'bobotmigrasi'  => $this->input->post('bobotmigrasi'),
            'progresmigrasi' => $this->input->post('progresmigrasi'),
            'planstdatemigrasi' => $this->input->post('planstdatemigrasi'),
            'planendatemigrasi' => $this->input->post('planendatemigrasi'),
            'actualstdatemigrasi' => $this->input->post('actualstdatemigrasi'),
            'actualendatemigrasi' => $this->input->post('actualendatemigrasi')
        );
        $this->Project_model->ubah($data,$id);
        $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('project/detailmigrasi/'.$id);
    }
}
