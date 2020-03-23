<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function index()
    {
        $data['title'] = 'Dashboard Applicant';
        $data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header',$data);
        $this->load->view('user/index',$data);//ngirim variable user data ke page User nanti 
        $this->load->view('templates/footer');
    }

}
