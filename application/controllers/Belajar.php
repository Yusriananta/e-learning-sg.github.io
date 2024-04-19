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
		$this->load->model('Ujian_model', 'ujian');
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
		];

    $this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('belajar/video');
		$this->load->view('_templates/dashboard/_footer.php');
    }

		public function detailvideo(){

			// $this->akses_mahasiswa();

			$data = [
				'user' => $this->ion_auth->user()->row(),
				'judul'	=> 'Pembelajaran',
				'subjudul'=> 'Pembelajaran video',
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
		];

    $this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('belajar/data');
		$this->load->view('_templates/dashboard/_footer.php');
    }

    public function add()
    {
        $this->akses_admindosen();
				$kreator    = $this->input->post('kreator');
				$judul      = $this->input->post('judul');
				$deskripsi 	= $this->input->post('deskripsi');

				$data_upload = [
					'listuser'   => $this->db->get('users')->result_array(),
					'judul'      => $judul,
          'deskripsi'  => $deskripsi,
          'kreator'    => $kreator,
          'tanggal_upload' => date('Y-m-d H:i:s'),
				];
				
				// $gambar = $this->input->post('gambar');
				// $video = $_FILES['video'];
				// if ($video=''){}else{
				// 	$config['upload_path']          = './assets/video/';
        //   $config['allowed_types']        = 'mp4|mkv';
        //   $config['max_size']             = 10000;
        //   $config['max_width']            = 10240;
        //   $config['max_height']           = 7680;

				// 	$this->load->library('upload', $config);
				// 	if (!$this->upload->do_upload('video')) {
				// 		echo "upload gagal"; die();
				// 	} else {
				// 		$video = $this->upload->data('nama_video'); 
				// 	};
				// };


      $data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Pembelajaran',
			'subjudul'=> 'upload Pembelajaran',
		];

		
		// print_r($data['listuser']);


		// print_r($data['listuser']);
		// exit();

    $this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('belajar/add', $data_upload);
		$this->load->view('_templates/dashboard/_footer.php');
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