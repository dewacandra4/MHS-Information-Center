<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();//manggil parent construct yang ada di CI
        $this->load->model('Menu_model', 'menu');
    }
    public function index()
    {
        $data['title'] = 'Dashboard Housing Officer';
        $data['user'] = $this->db->get_where('user', ['username'=> $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar-admin',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('admin/index',$data);//ngirim variable admin data ke page Admin nanti 
        $this->load->view('templates/footer');
    }
    public function profile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username'=> $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar-admin',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('admin/profile',$data);//ngirim variable user data ke page User nanti 
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['username'=> $this->session->userdata('username')])->row_array();
        
        $this->form_validation->set_rules('name','Full Name', 'required|trim');
        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar-admin',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('admin/edit',$data);//ngirim variable user data ke page User nanti 
            $this->load->view('templates/footer');
        }
        else
        {
            //ambil data inputan user di web form
            $name = $this->input->post('name');
            $username = $this->input->post('username');   
            $upload_image = $_FILES['image']['name'];

            if($upload_image)
            {
                $config['upload_path'] = './assets/img';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);//load librari upload
            
                if($this->upload->do_upload('image'))
                {
                    //menghapus image lama biar ga menuh" in kecuali default profile image
                    $old_image = $data['user']['image'];
                    if($old_image != 'default.jpg')
                    {
                        unlink(FCPATH . 'assets/img/'. $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                }
                else
                {
                    echo $this->upload->dispay_errors();
                }

            }
            
            $this->db->set('name', $name);//update isi database 
            $this->db->where('username', $username);//kondisi dimana username/emailnya harus cocok dengan yang di database
            $this->db->update('user');//update di tablenya user
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Your profile has been updated! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/profile');
        }
    }
    public function setup_residence()
    {
        $data['title'] = 'Setup Residence';
        $data['user'] = $this->db->get_where('user', ['username'=> $this->session->userdata('username')])->row_array();
        //ini fungsinya untuk menampilkan seluruh residene yang di handle housing officer
        $lol = $this->session->userdata('username');//mengambil username officer yang login sekarang
        $result= $this->db->query("SELECT `user_id` FROM `user` WHERE `username` = '$lol'")->row()->user_id;//mencari user id si username
        $staff_id = $this->db->query("SELECT `staff_id` FROM `housing_officer` WHERE `user_id` = '$result'")->row()->staff_id;//mencari staff id si username berdasarkan user_idnya
        $residence = $this->db->query("SELECT * FROM `residences` WHERE `staff_id` = $staff_id");//mencari residence yang di handle berdasarkan staff id
        $row = $residence->result_array();//menampilkan seluruh data residence
        $data['residences'] = $row;
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar-admin',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('admin/setup_residence',$data);//ngirim variable user data ke page User nanti 
        $this->load->view('templates/footer');

    }

    public function view_application()
    {
        $data['title'] = 'View Application';
        $data['user'] = $this->db->get_where('user', ['username'=> $this->session->userdata('username')])->row_array();
        $application = $this->db->query("SELECT * FROM `application` WHERE `status` = 'New' OR `status` = 'Waitlist' ");
        $row = $application->result_array();
        $data['application'] = $row;
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar-admin',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('admin/view_application',$data);
        $this->load->view('templates/footer');
    }


    function addResidence()
    {
        //ini fungsinya untuk menampilkan seluruh residene yang di handle housing officer
        $lol = $this->session->userdata('username');//mengambil username officer yang login sekarang
        $result= $this->db->query("SELECT `user_id` FROM `user` WHERE `username` = '$lol'")->row()->user_id;//mencari user id si username
        $staff_id = $this->db->query("SELECT `staff_id` FROM `housing_officer` WHERE `user_id` = '$result'")->row()->staff_id;//mencari staff id si username berdasarkan user_idnya
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('numunits', 'Number Of Unit', 'required');
        $this->form_validation->set_rules('size_per_unit', 'Size Per Unit', 'required');
        $this->form_validation->set_rules('monthly_rental', 'Monthly Rental', 'required');

        $dataArray = [
            'staff_id'=>$staff_id,
            'address' => $this->input->post('address',true),
            'numunits' => $this->input->post('numunits',true),
            'size_per_unit' => $this->input->post('size_per_unit',true), 
            'monthly_rental' => $this->input->post('monthly_rental',true)
        ];
        if($this->form_validation->run() == false)
        {
            $data['title'] = 'Setup Residences';
            $data['user'] = $this->db->get_where('user', ['username'=> $this->session->userdata('username')])->row_array();
            $data['residences'] = $this->db->get('residences')->result_array();
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar-admin',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('admin/setup_residence',$data);//ngirim variable user data ke page User nanti 
            $this->load->view('templates/footer');
        }
        else
        {
            $this->db->insert('residences', $dataArray);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Residence has been added! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/setup_residence');
        }

    }
    function ubahResidence()
    {
       
        
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('numunits', 'Number Of Unit', 'required');
        $this->form_validation->set_rules('size_per_unit', 'Size Per Unit', 'required');
        $this->form_validation->set_rules('monthly_rental', 'Monthly Rental', 'required');
        $residence_id = $this->input->post('residence_id');
        $data = array(
            'address'=> $this->input->post('address'),
            'numunits' => $this->input->post('numunits'),
            'size_per_unit'=> $this->input->post('size_per_unit'),
            'monthly_rental'=> $this->input->post('monthly_rental'),
        );
        if($this->form_validation->run() == false)
        {
            $data['title'] = 'Setup Residences';
            $data['user'] = $this->db->get_where('user', ['username'=> $this->session->userdata('username')])->row_array();
            //ini fungsinya untuk menampilkan seluruh residene yang di handle housing officer
            $lol = $this->session->userdata('username');//mengambil username officer yang login sekarang
            $result= $this->db->query("SELECT `user_id` FROM `user` WHERE `username` = '$lol'")->row()->user_id;//mencari user id si username
            $staff_id = $this->db->query("SELECT `staff_id` FROM `housing_officer` WHERE `user_id` = '$result'")->row()->staff_id;//mencari staff id si username berdasarkan user_idnya
            $residence = $this->db->query("SELECT * FROM `residences` WHERE `staff_id` = $staff_id");//mencari residence yang di handle berdasarkan staff id
            $row = $residence->result_array();//menampilkan seluruh data residence
            $data['residences'] = $row;
            // $data['residences'] = $this->db->get('residences')->result_array();
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar-admin',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('admin/setup_residence',$data);//ngirim variable user data ke page User nanti 
            $this->load->view('templates/footer');
        }
        else{
            $this->menu->ubahSub($data,$residence_id);
            $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/setup_residence');
        }
    }
    public function hapusS($id)
    {
        $this->menu->deleteSub($id);

        //redirect
        redirect('admin/setup_residence');
    }
    
}

