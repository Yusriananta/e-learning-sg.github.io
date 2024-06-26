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

  public function getCreator(){
    $query = "SELECT * FROM tb_video
    INNER JOIN users ON tb_video.creator = users.id;";
    $result = $this->db->query($query)->result_array();
    return $result;
  }

  public function getupdate(){

    $data = [
      
      'creator'  => $this->input->post('creator', TRUE),
      'judul'    => $this->input->post('judul', TRUE),
      'deskripsi'  => $this->input->post('deskripsi', TRUE)
    ];

    $id = $this->input->post('id');

    $this->db->where('id', $id);
    $this->db->update('tb_video', $data);
  }

  public function getDelete($id){
    $get_where = $this->db->get_where('tb_video', array('id' => $id))->row_array();
    // print_r($get_where);
    // exit();
    $video = $get_where['video'];
    $thumbnail = $get_where['thumbnail'];
    // print_r($video);
    // exit();
 
      unlink(FCPATH . './assets/dist/thumbnail/'.$thumbnail);
      unlink(FCPATH . './assets/dist/video/'.$video);
    

    $this->db->where('id', $id);
    $this->db->delete('tb_video');
    
  }
  public function get($id){
    $this->db->where('id', $id);
    return $this->db->get('tb_video')->row_array();
  }

  public function getSearch(){
    $this->db->get('tb_video');
    $this->db->like('judul', 'deskripsi');
  }







};


?>