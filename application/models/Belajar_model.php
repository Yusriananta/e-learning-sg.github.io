<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Belajar_model extends CI_Model {

  public function getVideo(){
    $query = $this->db->get('tb_video');
    return $query->result();
  }

  public function getVideobyId($id){
    $query = "SELECT tb_video.*, users.* 
    FROM tb_video 
    INNER JOIN users ON tb_video.creator = users.id 
    WHERE tb_video.id = ?";
    return $this->db->query($query, array($id))->row_array();
  }

  public function insert($data){
    $this->db->insert('tb_video',$data);
    return $this->db->insert_id();
  }

  public function getUploaders(){

  }

  public function getCreator(){
    $query = "SELECT * FROM tb_video
    INNER JOIN users ON tb_video.creator = users.id;";
    $result = $this->db->query($query)->result_array();
    return $result;
  }






};


?>