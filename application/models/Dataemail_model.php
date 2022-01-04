<?php

Class Dataemail_model extends  CI_Model{


    public function getAllemail()
    {

      $this->db->from('tbl_email');
      $this->db->order_by('id_email','DESC');
     $query= $this->db->get();
     return $query->result_array();

    }

    public function deleteEmail($id){
      $this->db->where_in('id_email', $id);
      $this->db->delete('tbl_email');


    }

    public function editEmail($idEmail)
    {
      
          $this->db->from('tbl_email');
          $this->db->WHERE ('id_email',$idEmail);
          $query= $this->db->get();
          return $query->result_array();

    }

}