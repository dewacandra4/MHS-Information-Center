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
    //set application to Waitlist
    public function waitlistA($data1, $application_id)
    {
        $this->db->where('application_id', $application_id); 
        $this->db->update('application', $data1);
        return TRUE;
    }
    //Set application Status to approved
    public function approveA($data2, $application_id)
    {
        $this->db->where('application_id', $application_id); 
        $this->db->update('application', $data2);
        return TRUE;
    }
    //when one application by aplicant aproved this code will make all other application for the same Applicant are set to “Rejected”. 
    public function autoReject($applicant_id)
    {
        $data3=array('status'=>"Rejected");
        $this->db->where('applicant_id', $applicant_id);
        $this->db->update('application', $data3);
        return TRUE;
    }
    
    //when one application for spesific residence approved, application by another applicant to those residence will also set to “Rejected”
    public function autoReject2($residence_id)
    {
        $data3=array('status'=>"Rejected");
        $this->db->where('residence_id', $residence_id);
        $this->db->update('application', $data3);
        return TRUE;
    }
    //set application Status to Decline
    public function decA($data1, $application_id)
    {
        $this->db->where('application_id', $application_id); 
        $this->db->update('application', $data1);
        return TRUE;
    }



}
