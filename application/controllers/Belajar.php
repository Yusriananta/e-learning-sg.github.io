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

		public function detailvideo($id){

			if ( !$this->ion_auth->is_admin() && !$this->ion_auth->in_group('dosen') ){
				$this->belajar->getViews($id);
			} 
			// $this->belajar->getViews();
			$tes = $this->belajar->getVideoById($id);		

			
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
			$config['max_size']             	= 1024000; //max 100mb

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


    public function edit($id)
    {

      $this->akses_admindosen();
			// echo $id;
			// exit();

			$g_video = $this->belajar->getVideobyId($id);
			$creator['first_name']=$this->belajar->getCreator();
	

      $data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Edit Pembelajaran',
			'subjudul'=> 'Edit Pembelajaran',
			'g_video' => $g_video,
			'creator' => $creator
		];

      $this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('belajar/edit', $data);
			$this->load->view('_templates/dashboard/_footer.php');
    }

		public function update_a(){
			
			$data = [
      
				'creator'  => $this->input->post('creator', TRUE),
				'judul'    => $this->input->post('judul', TRUE),
				'deskripsi'  => $this->input->post('deskripsi', TRUE)
			];
	
			$id = $this->input->post('id');
	
			$this->db->where('id', $id);
			$this->db->update('tb_video', $data);
      $this->session->set_flashdata('message', '
      <script>
      Swal.fire({
        title: "Video Berhasil di Update",
        text: "You clicked the button!",
        type: "success",
        });
      </script>
      ');
      redirect('belajar/edit/'.$id);
    }

		public function delete($id) {

			$this->belajar->getDelete($id);
			// Array of file paths to be deleted
			$this->session->set_flashdata('message', '
      <script>
      Swal.fire({
        title: "Video Berhasil di Hapus",
        text: "You clicked the button!",
        type: "success",
        });
      </script>
      ');
      redirect('belajar/data');
		}

		public function seacrh(){

			$search = $_POST['search'];
			$query = $this->db->query("SELECT * FROM tb_video WHERE judul LIKE '%$search%' "); 
			$get_data= $query->result_array();
			// $g_seacrh = $this->belajar->getSeacrh();
			
			print_r(json_encode($get_data));
		}

		public function views($id){
        // Simpan jumlah views ke dalam database
      $t_view = $this->belajar->getViews($id);
			// print_r($t_view);
			// exit();

		}
			








			
		

	
}