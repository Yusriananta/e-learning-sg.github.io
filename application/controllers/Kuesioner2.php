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
      $data['namaujian'] = $this->db->get('m_ujian')->result_array();
      // $data['pertanyaan'] = $this->kuesioner->getPertanyaan();
      // $tes = $this->kuesioner->getPertanyaan();
		  // print_r($tes);
		  // exit();
      $data['pertanyaan'] = $this->kuesioner->getPertanyaan();

  
      foreach ($data['namaujian'] as $key) {
        $nilai = $this->kuesioner->Nkuesioner2($key['id_ujian']);
          $data1[] = array(
            'namaujian'		=> $key['nama_ujian'],
            'tgl_mulai'		=> $key['tgl_mulai'],
            'tgl_akhir'		=> $key['terlambat'],
            'id_ujian'	=> $key['id_ujian'],
            'nilai'			=> $nilai['nilai']
          );
          
      }
  
      $data['nilai'] = $data1;
      // print_r($data1);
      // exit();
  
      if ($this->input->post('pertanyaan') == NULL) {
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('kuesioner2/add', $data);
        $this->load->view('_templates/dashboard/_footer.php');
      }else{
        $data = ['id_ujian' => $this->input->post('kegiatan', true),
            'id_mhs_atasan' => $this->input->post('atasan',true),
            'pertanyaan' => $this->input->post('pertanyaan', true)];
  
        $uptes = $this->db->insert('p_kuesioner2', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kuesioner berhasil di input</div>');
        redirect('kuesioner2');
      }
      
    }

    public function delete($id)
    {
      $data=$this->db->where('id',$id);
      $this->db->delete('p_kuesioner2');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pertanyaan berhasil di hapus</div>');
      redirect('kuesioner2');
    }

    public function aksiKegiatan()
    {
      $user = $this->ion_auth->user()->row_array();
  
      $pers_no = $user['username'];
          $date = date('Y-m-d H:i:s');
          $kuesioner = $this->input->post('id_kegiatan',TRUE);
          $opsi = $this->input->post('opsi',TRUE);
          $saran = $this->input->post('saran',TRUE);
          $this->ujian->aksiKegiatan($pers_no, $date, $kuesioner,$opsi,$saran);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kuesioner berhasil dikirim</div>');
      redirect('kuesioner2/listkuesioner');
    }

    public function kegiatanDetail($id)
    {
  
      $this->akses_admin();
      $data = [
        'user' => $this->ion_auth->user()->row(),
        'judul'	=> 'Kuesioner',
        'subjudul'=> 'Detail Kuesioner',
      ];
  
      $data['Sbaik'] = $this->ujian->getSBaik($id);
      $data['baik'] = $this->ujian->getBaik($id);
      $data['cukup'] = $this->ujian->getCukup($id);
      $data['kurang'] = $this->ujian->getKurang($id);
      $data['saran'] = $this->db->get_where('s_kegiatan', ['id_ujian'=>$id])->result_array();
      $data['kegiatan'] = $this->db->get_where('m_ujian', ['id_ujian'=>$id])->row_array();
      
      $this->load->view('_templates/dashboard/_header.php', $data);
      $this->load->view('kuesioner2/kegiatanDetail', $data);
      $this->load->view('_templates/dashboard/_footer.php');
    }

    public function listkuesioner()
    {
        $this->akses_mahasiswa();
        $user = $this->ion_auth->user()->row();
        $nopeg = $user->username;
    
        $getmhsid = $this->db->get_where('mahasiswa', array('nim' => $nopeg))->result_array();
        $id_mahasiswa = $getmhsid['0']['id_mahasiswa'];
    
        // Periksa apakah pengguna telah menyelesaikan Kuesioner 1
        $is_completed = $this->db->get_where('user_kuesioner_status', [
            'user_id' => $user->id,
            'kuesioner_completed' => TRUE
        ])->row();
    
        if (!$is_completed) {
            $data = [
                'user' => $user,
                'judul' => 'Kuesioner Level 2',
                'subjudul' => 'List Kuesioner',
                'mhs' => [],
                'message' => 'Silakan selesaikan Kuesioner 1 terlebih dahulu.'
            ];
    
            $this->load->view('_templates/dashboard/_header.php', $data);
            $this->load->view('kuesioner2/listkuesioner', $data);
            $this->load->view('_templates/dashboard/_footer.php');
            return;
        }
    
        $list_kues = $this->kuesioner->getListkuesioner($id_mahasiswa);
    
        $data = [
            'user' => $user,
            'judul' => 'Kuesioner Level 2',
            'subjudul' => 'List Kuesioner',
            'mhs' => $list_kues,
            'message' => ''
        ];
    
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('kuesioner2/listkuesioner', $data);
        $this->load->view('_templates/dashboard/_footer.php');
    }


}


?>