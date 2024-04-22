<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belajar extends CI_Controller{
    
    public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		
		$this->load->library(['datatables', 'form_validation']);// Load Library Ignited-Datatables
		$this->load->helper('my');
		$this->load->model('Belajar_model', 'belajar');
	}
    
    public function akses_admin()
    {
        if ( !$this->ion_auth->is_admin() ){
			show_error('Halaman ini khusus untuk Admin, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
    }

    public function akses_dosen()
    {
        if ( !$this->ion_auth->in_group('dosen') ){
			show_error('Halaman ini khusus untuk dosen untuk membuat Test Online, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
    }

    public function akses_mahasiswa()
    {
        if ( !$this->ion_auth->in_group('mahasiswa') ){
			show_error('Halaman ini khusus untuk mahasiswa mengikuti ujian, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
    }

    public function akses_admindosen()
    {
        if ( !$this->ion_auth->is_admin() && !$this->ion_auth->in_group('dosen') ){
			show_error('Akses Dilarang, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
    }

	public function index()
    {

      $data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Pembelajaran',
			'subjudul'=> 'Pembelajaran video',
			'l_video' => $this->db->get('tb_video')->result()
		];

    $this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('belajar/video');
		$this->load->view('_templates/dashboard/_footer.php');
    }

		public function detailvideo(){

			// $this->akses_mahasiswa();
			// $id= $_GET['id']; 
			$tes = $this->belajar->getVideo();

			// $id_video = $this->belajar->getVideoById();
			// print_r($tes);
			// exit();

			$data = [
				'user' => $this->ion_auth->user()->row(),
				'judul'	=> 'Pembelajaran',
				'subjudul'=> 'Pembelajaran video',
				'g_video' => $tes
			];

			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('belajar/detailvideo.php');
			$this->load->view('_templates/dashboard/_footer.php');
		}

    public function data()
    {
        $this->akses_admindosen();

      $data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Pembelajaran',
			'subjudul'=> 'Data Pembelajaran', 
			'l_video' => $this->db->get('tb_video')->result()
		];

		// print_r($data);
		// exit();

    $this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('belajar/data');
		$this->load->view('_templates/dashboard/_footer.php');
    }

    public function add(){

        $this->akses_admindosen();
			// $l_video= $this->belajar->getVideobyId();
			// print_r($data);
			// exit();

      $data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Pembelajaran',
			'subjudul'=> 'upload Pembelajaran',
			'listuser'   => $this->db->get('users')->result()
		];
			// print_r($data['listuser']);
			// print_r($data['listuser']);
			// exit();
			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('belajar/add');
			$this->load->view('_templates/dashboard/_footer.php');
		}

		public function upload(){
			
					$file="FILE_" .date('dmY') ."_" .$_FILES['video']['name'];
					
					$this->files_upload($file);
					print_r($file);
					exit();
					if($_FILES['video']['name']!=""){
					echo $_FILES['video']['name'];
							if (!$this->upload->do_upload()){
					/**
					 * Jika Gagal Upload
					 */
									$error=$this->upload->display_errors();
									$this->session->set_flashdata('error', $error);
									header('location:'.base_url() ."belajar/add");
							}
							else{
					/**
					 * Jika Berhasil Upload
					 */			
									$file = $this->upload->data("file_name");
									$data=array(
											'uploader'    => $this->input->post('judul'),
											'creator'     => $this->input->post('creator'),
											'deskripsi'   => $this->input->post('deskripsi'),
											'nama_video'  => $file,
											'nama_tumbnail' => $file
									);
									
									$insertid=$this->belajar_model->insertVideo($data);
									$this->session->set_flashdata('file', $file);
									header('location:'.base_url() ."belajar/data".$insertid);
							}
					}else{
				/**
				 * Jika Tidak ada file
				 */
				//$error=$this->upload->display_errors();
							$this->session->set_flashdata('error', 'No File Selected');
							header('location:'.base_url() ."belajar/add");
			}
		}

		public function upload_(){

			// $user = $this->ion_auth->user()->row();
			// print_r($_POST);
			// exit();
		
			if (isset($_POST['submit'])){
				$this->form_validation->set_rules('judul', 'Judul', 'required');

				$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'mp4|mkv|jpg|jpeg|png';
        $config['max_size']             = 20000;
        $config['max_width']            = 1200;
        $config['max_height']           = 800;
        $config['overwrite']            = true;
        $this->load->library('upload', $config);

				if (!empty($_FILES['thumbnail'])){
					$this->upload->do_upload('thumbnail');
					$data1=$this->upload->data();
					$gambar = $data1['file_name'];
				}
				if (!empty($_FILES['video_up'])){
          $this->upload->do_upload('video');
          $data2=$this->upload->data();
          $video = $data2['file_name'];
				}
				if ($this->form_validation->run()){
					$creator = $this->input->post('creator', true);
					$judul = $this->input->post('judul', true);
					$deskripsi = $this->input->post('deskripsi', true);
					$data = ['creator' => $creator, 'judul' => $judul, 
										'deskripsi' => $deskripsi, 'thumbnail'=> $gambar, 'video'=>$video];

					$insert = $this->db->insert('tb_video', $data);
					if ($insert) {
						$this->session->set_flashdata('success', '<div class="alert alert-success">
					  Data Berhasil Disimpan </div>');
						redirect('belajar/add');
					}
			}
			else {
					$this->data();
			}

		}
		else{
			$this->data();
	}

}



		public function files_upload($filename){
				$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'mp4|mkv|jpg|jpeg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 1200;
        $config['max_height']           = 800;
        $config['overwrite']            = true;
				$config['file_name']            = $filename;
        $this->load->library('upload', $config);
		}



    public function edit()
    {
        $this->akses_admindosen();

        $data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Pembelajaran',
			'subjudul'=> 'Edit Pembelajaran',
		];

      $this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('belajar/edit');
			$this->load->view('_templates/dashboard/_footer.php');
    }

	
}