<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();//manggil parent construct yang ada di CI
        $this->load->library('form_validation'); //agar librari validasi form bsa dgunakan dimana aja
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
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');

        if($this->form_validation->run()==false)
        {
            //fungsiny ketika masuk link localhost/mhs info langsung ke load yang ini
            //ada header ada footer tu urutan yang di load
            $data['title'] = 'Login';//set title sesuai page
            $this->load->view('templates/auth_header',$data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        }
        else
        {
            //validation success
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        if($user)
        {
            //cek password yang dh d hash (pw_verify)
            if(password_verify($password, $user['password']))
            {
                //siapin data username dan role id
                $data = [
                    'username' => $user['username'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                //cek apakah dia user/admin
                if($user['role_id']==1)
                {
                    redirect('admin');
                }
                else
                {
                    redirect('user');
                }
            }
            else
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                redirect('auth/login');
            }
        }

        else
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username is not registered !</div>');
            redirect('auth/login');
        }
    }
    public function registration_applicant()
    {
        $data['user'] = $this->db->get_where('user', ['user_id'=> $this->session->userdata('user_id')])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]',  [
            'is_unique' => 'This username has already registered !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[applicant.email]',  [
            'is_unique' => 'This email has already registered !'
        ]);
        $this->form_validation->set_rules('monthlyIncome','monthlyIncome','required|numeric');

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches'=>'Password does not match!',
            'min_length'=>'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    
        if($this->form_validation->run() == false)
        {
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header',$data);
            $this->load->view('auth/registration_applicant');
            $this->load->view('templates/auth_footer');
        }
        else
        {
          $data = [
                'username' => htmlspecialchars($this->input->post('username',true)),
                'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),//ini password hash di encrypst dulu
                'name' => htmlspecialchars($this->input->post('name',true)), //htmlspecialchars buat ngelindungi dari sqll injection atau scripct/html inject
                'image' =>'default.jpg',
                'role_id' => 2,
                'date_created' => time()
          ];
          $query = $this->db->query("SELECT * FROM user;");
          $total = $query->num_rows();
          $dataApplicant = [
              'email' => htmlspecialchars($this->input->post('email',true)),
              'monthlyIncome' => $this->input->post('monthlyIncome',true),
              'user_id' => $total+1
          ];
            $this->db->insert('user', $data);
            $this->db->insert('applicant', $dataApplicant);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please Login</div>');
            redirect('auth/login');
        }
       
    }
    public function registration_officer()
    {
        $data['user'] = $this->db->get_where('user', ['user_id'=> $this->session->userdata('user_id')])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]',  [
            'is_unique' => 'This username has already registered !'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches'=>'Password does not match!',
            'min_length'=>'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    
        if($this->form_validation->run() == false)
        {
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header',$data);
            $this->load->view('auth/registration_officer');
            $this->load->view('templates/auth_footer');
        }
        else
        {
          $data = [
                'username' => htmlspecialchars($this->input->post('username',true)),
                'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),//ini password hash di encrypst dulu
                'name' => htmlspecialchars($this->input->post('name',true)), //htmlspecialchars buat ngelindungi dari sqll injection atau scripct/html inject
                'image' =>'default.jpg',
                'role_id' => 1,
                'date_created' => time()
          ];
          $query = $this->db->query("SELECT * FROM user;");
          $total = $query->num_rows();
          $dataOfficer = [
              'user_id' => $total+1
          ];
            $this->db->insert('user', $data);
            $this->db->insert('housing_officer', $dataOfficer);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please Login</div>');
            redirect('auth/login');
        }
       
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">You have been logged out! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>');
        redirect('auth');
    }
}
