<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner_model extends CI_Model {

  // Sebagian Belom di Revisi

  public function getPertanyaan()
  {

    $query = "SELECT p_kuesioner2.*, m_ujian.nama_ujian, dosen.nama_dosen
    FROM p_kuesioner2
    JOIN m_ujian ON p_kuesioner2.id_ujian = m_ujian.id_ujian
    JOIN dosen ON p_kuesioner2.id_mhs_atasan = dosen.id_dosen";

return $this->db->query($query)->result_array();
  }

  public function getAtasan(){
    $query = "SELECT ug.*, u.first_name
    FROM users_groups ug
    LEFT JOIN users u ON ug.user_id = u.id
    WHERE ug.group_id = 2;
    ";

    return $this->db->query($query)->result_array();
  }

  public function Nkuesioner2($id)
  {
      $query = "SELECT ROUND((SELECT AVG(id_opsi) FROM h_kuesioner2 WHERE id_ujian = $id),0) as nilai";

      return $this->db->query($query)->row_array();
  }

  public function aksiKegiatan($no_user, $date, $kuesioner, $opsi,$saran)
  {
      $this->db->trans_start();
          //INSERT TO PACKAGE
          $data = [
              "no_user"       => $no_user,
              "tanggal"       => $date,
              "id_ujian"  => $kuesioner,
          ];

          $this->db->insert('log_kuesioner2', $data);
          //GET ID PACKAGE
          $package_id = $this->db->insert_id();
          $result = array();
              foreach($opsi AS $key => $val){
                  $result[] = array(
                    'id_ujian'     => $kuesioner,
                    'id_aksi'          => $package_id,
                    'soal_no'          => $key,
                    'id_opsi'          => $_POST['opsi'][$key]
                  );
          }      
          //MULTIPLE INSERT TO DETAIL TABLE
          $this->db->insert_batch('h_kuesioner2', $result);
          
          if(!empty($saran)){
              $value = [
                  "no_user"       => $no_user,
                  "tanggal"       => $date,
                  "id_ujian"  => $kuesioner,
                  "saran"         => $saran
              ];

              $this->db->insert('saran_kuesioner2', $value);
          }

      $this->db->trans_complete();
  }

  public function getSBaik($id)
  {
      $query = "SELECT
              (SELECT COUNT(id_ujian) FROM k_kegiatan WHERE id_ujian = $id) as jumlah,
              (SELECT COUNT(id_opsi) FROM k_kegiatan WHERE id_opsi = 4 AND id_ujian = $id) as Sbaik, 
              ROUND((SELECT Sbaik/jumlah*100),0) as persen";

      return $this->db->query($query)->row_array();
  }

  public function getBaik($id)
  {
      $query = "SELECT
              (SELECT COUNT(id_ujian) FROM k_kegiatan WHERE id_ujian = $id) as jumlah,
              (SELECT COUNT(id_opsi) FROM k_kegiatan WHERE id_opsi = 3 AND id_ujian = $id) as baik, 
              ROUND((SELECT baik/jumlah*100),0) as persen";

      return $this->db->query($query)->row_array();
  }

  public function getCukup($id)
  {
      $query = "SELECT
              (SELECT COUNT(id_ujian) FROM k_kegiatan WHERE id_ujian = $id) as jumlah,
              (SELECT COUNT(id_opsi) FROM k_kegiatan WHERE id_opsi = 2 AND id_ujian = $id) as cukup, 
              ROUND((SELECT cukup/jumlah*100),0) as persen";

      return $this->db->query($query)->row_array();
  }

  public function getKurang($id)
  {
      $query = "SELECT
              (SELECT COUNT(id_ujian) FROM k_kegiatan WHERE id_ujian = $id) as jumlah,
              (SELECT COUNT(id_opsi) FROM k_kegiatan WHERE id_opsi = 1 AND id_ujian = $id) as kurang, 
              ROUND((SELECT kurang/jumlah*100),0) as persen";

      return $this->db->query($query)->row_array();
  }

    public function getListkuesioner($id_mahasiswa) {
    // ambil id dari session user, select tabel mahasiswa berdasarkan id tersebut, sehingga mendapat kelas_id
    // WHERE b.saran is NULL AND 
    $query = "SELECT * FROM h_ujian a left join m_ujian b on a.ujian_id=b.id_ujian
    left join s_kegiatan c on b.id_ujian=c.id_ujian
    where c.saran is not null and a.mahasiswa_id= $id_mahasiswa";
    return $this->db->query($query)->result_array();
  }

  public function getHilang($id_mahasiswa) {
    
    $query ="SELECT b.id_ujian,b.nama_ujian FROM h_ujian a 
    left join m_ujian b on a.ujian_id=b.id_ujian
    left join saran_kuesioner2 c on b.id_ujian=c.id_ujian
    where c.saran is null and a.mahasiswa_id='$id_mahasiswa';";
    return $this->db->query($query)->result_array();
    
    
}




}


?>