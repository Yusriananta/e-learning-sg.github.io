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
	

	public function upload_1()
	{
		$this->load->library('upload');
		$user = $this->ion_auth->user()->row();
		$id_user = $user->user_id;
		
			$config['upload_path']			= './assets/dist/video/';
			$config['allowed_types']     		= '*';
			$config['max_size']             	= 102400; //max 100mb

			// $this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('video')){
				$data2 		= $this->upload->data();
				$video	= $data2['file_name'];
			}else{
				$error2 = $this->upload->display_errors();
			}

		
			$config['upload_path']		= './assets/dist/thumbnail/';
			$config['allowed_types']      = '*';
			$config['max_size']           = 2048; //max 2mb
			
			// $this->load->library('upload', $config);
			$this->upload->initialize($config);

				if ($this->upload->do_upload('thumbnail')){
					$data1 		= $this->upload->data();
					$thumbnail	= $data1['file_name'];
				}else{
					$error1 = $this->upload->display_errors();
				}

	
		$data = [
			'uploader'	=> $id_user,
			'creator'	=> $this->input->post('creator', TRUE),
			'judul'		=> $this->input->post('judul', TRUE),
			'deskripsi'	=> $this->input->post('deskripsi', TRUE),
			'thumbnail'	=> $thumbnail,
			'video'		=> $video,
			'tanggal'	=> date('Y-m-d')
		];

		$this->db->insert('tb_video', $data);
		$this->session->set_flashdata('message', '
		<script>
		Swal.fire({
			title: "Video Berhasil di Upload",
			text: "You clicked the button!",
			type: "success",
		  });
		</script>
		');
		redirect('belajar/add');
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