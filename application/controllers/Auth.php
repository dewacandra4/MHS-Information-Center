<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();//manggil parent construct yang ada di CI
        $this->load->library('form_validation'); //agar librari validasi fom bsa dgunakan dimana aja
    }
    public function index()
    {
        //fungsiny ketika masuk link localhost/mhs info langsung ke load yang ini
        //ada header ada footer tu urutan yang di load
        // $this->load->view('templates/auth_header');
        $this->load->view('auth/index');
        // $this->load->view('templates/auth_footer');
    }
    public function login()
    {
        //fungsiny ketika masuk link localhost/mhs info langsung ke load yang ini
        //ada header ada footer tu urutan yang di load
        $data['title'] = 'Login';
        $this->load->view('templates/auth_header',$data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }
    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',  [
            'is_unique' => 'This email has already registered !'
        ]);
        $this->form_validation->set_rules('monthlyIncome','monthlyIncome','required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches'=>'Password does not match!',
            'min_length'=>'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    
        if($this->form_validation->run() == false)
        {
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header',$data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        }
        else
        {
          $data = [
            'name' => htmlspecialchars($this->input->post('name',true)),
            'email' => htmlspecialchars($this->input->post('email',true)),
            'image' =>'default.jpg',
            'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),//ini passwordhas di encrypst dulu
            'role_id' => 2,
            'date_created' => time()
          ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please Login</div>');
            redirect('auth/login');
        }
       
    }
}
