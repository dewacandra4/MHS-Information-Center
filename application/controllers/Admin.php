<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function index()
    {
        $data['title'] = 'Dashboard Housing Officer';
        $data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar-admin',$data);
        $this->load->view('admin/index',$data);//ngirim variable admin data ke page Admin nanti 
        $this->load->view('templates/footer');
    }

}
