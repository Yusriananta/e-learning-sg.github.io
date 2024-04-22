<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Belajar_model extends CI_Model {

  public function getVideo(){
    $query = $this->db->get('tb_video');
    return $query->result();
  }

  public function getVideobyId($id){
    $this->db->where('c.id', $id);
    $this->db->join('users a','a.id=c.uploader');
    $this->db->join('users b','b.id=c.creator');
    return $this->db->get('tb_video c')->row();
  }

  public function insert($data){
    $this->db->insert('tb_video',$data);
    return $this->db->insert_id();
  }

  public function getUploaders(){

  }

  public function getCreator(){
    
  }






};


?>