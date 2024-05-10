<?php 

class kuesioner2 extends CI_Controller {

  public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		
		$this->load->library(['datatables', 'form_validation']);// Load Library Ignited-Datatables
		$this->load->helper('my');
		$this->load->model('Kuesioner_model', 'kuesioner');
	}

	 public function akses_admin()
    {
        if ( !$this->ion_auth->is_admin() ){
			show_error('Halaman ini khusus untuk Admin, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
    }

    public function akses_mahasiswa()
    {
        if ( !$this->ion_auth->in_group('mahasiswa') ){
			show_error('Halaman ini khusus untuk mahasiswa mengikuti ujian, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
    }

    public function index() {
      $this->akses_admin();

      $data = [
        'user' => $this->ion_auth->user()->row(),
        'judul'  => 'Kuesioner',
        'subjudul'=> 'Data Kuesioner Level 2',
      ];

      $data['atasan'] = $this->kuesioner->getAtasan();
      $data['kegiatan'] = $this->db->get('m_ujian')->result_array();
      // $data['pertanyaan'] = $this->kuesioner->getPertanyaan();
      // $tes = $this->kuesioner->getPertanyaan();
		  // print_r($tes);
		  // exit();
      $data['pertanyaan'] = $this->kuesioner->getPertanyaan();

  
      if ($this->input->post('pertanyaan')==NULL) {
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('kuesioner2/add', $data);
        $this->load->view('_templates/dashboard/_footer.php');
      }else{
        $data = [
            'atasan' => $this->input->post('atasan', true),
            'id_kegiatan' => $this->input->post('kegiatan', true),
            'pertanyaan' => $this->input->post('pertanyaan', true)
          ];
  
        $this->db->insert('p_kuesioner', $data);
  
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kuesioner berhasil di input</div>');
        redirect('kuesioner');
      }
      
    }


}





?>