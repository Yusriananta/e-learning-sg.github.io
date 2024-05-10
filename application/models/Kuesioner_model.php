<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner_model extends CI_Model {

  public function getPertanyaan()
  {
      $query = "SELECT u.id_ujian, u.nama_ujian, k.*
      FROM m_ujian u
      LEFT JOIN tb_kuesioner2 k ON u.id_ujian = k.id_ujian;
      ";

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

}


?>