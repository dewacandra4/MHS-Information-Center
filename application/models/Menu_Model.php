<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Menu_model extends CI_Model
{

    
    function editRes($data, $residence_id)
    {
        $this->db->where('residence_id',$residence_id);
        $this->db->update('residences', $data);
        return TRUE;
    }
    public function deleteSub($id)
    {    
        $this->db->where('residence_id', $id);    
        $this->db->delete('residences'); 
        // Untuk mengeksekusi perintah delete data
    }
}
