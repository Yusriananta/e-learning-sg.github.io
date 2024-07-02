<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class kuesioner extends CI_Controller{

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

    public function akses_mahasiswa()
    {
        if ( !$this->ion_auth->in_group('mahasiswa') ){
			show_error('Halaman ini khusus untuk mahasiswa mengikuti ujian, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
    }


	public function index()
	{
		$this->akses_admin();
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Kuesioner',
			'subjudul'=> 'Data Kuesioner ',
		];
		$data['kegiatan'] = $this->db->get('m_ujian')->result_array();
		$data['pertanyaan'] = $this->ujian->getPertanyaan();

		foreach ($data['kegiatan'] as $key) {
			$nilai = $this->ujian->Nkuesioner($key['id_ujian']);
				$data1[] = array(
					'kegiatan'		=> $key['nama_ujian'],
					'tgl_mulai'		=> $key['tgl_mulai'],
					'tgl_akhir'		=> $key['terlambat'],
					'id_ujian'	=> $key['id_ujian'],
					'nilai'			=> $nilai['nilai']
				);
		}

		$data['nilai'] = $data1;

		if ($this->input->post('pertanyaan')==NULL) {
			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('kuesioner/add', $data);
			$this->load->view('_templates/dashboard/_footer.php');
		}else{
			$data = ['id_kegiatan' => $this->input->post('kegiatan', true),
					'pertanyaan' => $this->input->post('pertanyaan', true)];

			$this->db->insert('p_kuesioner', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kuesioner berhasil di input</div>');
			redirect('kuesioner');
		}

		// print_r($data);
		// exit();
		
	}

	public function isi($id_)
	{

		$this->akses_mahasiswa();
		// $h_ujian = $this->db->get_where('h_ujian', ['id' => $id_])->row_array();
		

		$user = $this->ion_auth->user()->row();
		$data = [
			'user' => $user,
			'judul'	=> 'Kuesioner',
			'subjudul'=> 'Isi Kuesioner!',
		];

		$data['pertanyaan'] = $this->db->get_where('p_kuesioner', ['id_kegiatan' => $id_])->result_array();

		if ($this->input->post('saran')==NULL) {
			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('kuesioner/isi', $data);
			$this->load->view('_templates/dashboard/_footer.php');
		}else{

			$cek = $this->input->post('sbaik', true);
			print_r($cek);exit();
			$data = [ 'id_pegawai'=> 1234,
					'email'=> 1,
					'nama'=> 1,
					'sbaik' => $this->input->post('sbaik', true),
					'baik' => $this->input->post('baik', true),
					'biasa' => $this->input->post('biasa', true),
					'buruk' => $this->input->post('buruk', true),
					'sburuk' => $this->input->post('sburuk', true),
					'saran' => $this->input->post('saran', true),
					'tanggal' => date('Y-m-d')
			];
			$this->db->insert('h_kuesioner', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kuesioner berhasil di input</div>');
			redirect('kuesioner');
		}

	}

	public function delete($id)
	{
		$data=$this->db->where('id',$id);
		$this->db->delete('p_kuesioner');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pertanyaan berhasil di hapus</div>');
		redirect('kuesioner');
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
		$this->load->view('kuesioner/kegiatanDetail', $data);
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function listkuesioner(){
		
			$this->akses_mahasiswa();
			$user = $this->ion_auth->user()->row();
			$nopeg = $user->username;
			
			$getmhsid = $this->db->get_where('mahasiswa',array('nim'=>$nopeg))->result_array();
			$id_mahasiswa=$getmhsid['0']['id_mahasiswa'];
			    // Cek apakah mahasiswa sudah mengerjakan kuesioner

			$list_kues = $this->ujian->getListkuesioner($id_mahasiswa);

			// print_r($list_kues);
			// exit();
			
			$data = [
				'user' => $user,
        'judul'  => 'Kuesioner',
        'subjudul'=> 'List Kuesioner',
				'mhs' 		=> $list_kues,
			];

			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('kuesioner/listkuesioner', $data);
			$this->load->view('_templates/dashboard/_footer.php');
	}



// ------------- KUESIONER Level 2 -----------------------



}