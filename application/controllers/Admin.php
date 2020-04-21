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
        //ini fungsinya untuk menampilkan seluruh residene yang di handle housing officer
        $lol = $this->session->userdata('username');//mengambil username officer yang login sekarang
        $result= $this->db->query("SELECT `user_id` FROM `user` WHERE `username` = '$lol'")->row()->user_id;//mencari user id si username
        $staff_id = $this->db->query("SELECT `staff_id` FROM `housing_officer` WHERE `user_id` = '$result'")->row()->staff_id;//mencari staff id si username berdasarkan user_idnya
        $residence = $this->db->query("SELECT * FROM `residences` WHERE `staff_id` = $staff_id");//mencari residence yang di handle berdasarkan staff id
        $application = $this->db->query("SELECT * FROM `application` WHERE (`status` = 'New' OR `status` = 'Waitlist') AND `Staff_id`=' $staff_id' ");
        $users = $this->db->query("SELECT * FROM `user`");
        $data['total_user'] = $users->num_rows();
        $data['total_applications'] = $application->num_rows();
        $data['total_residences'] = $residence->num_rows();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar-admin',$data);
        $this->load->view('templates/topbar-admin',$data);
        $this->load->view('admin/index',$data);//ngirim variable admin data ke page Admin nanti 
        $this->load->view('templates/footer');
    }
    public function profile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username'=> $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar-admin',$data);
        $this->load->view('templates/topbar-admin',$data);
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
            $this->load->view('templates/topbar-admin',$data);
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
        $this->load->view('templates/topbar-admin',$data);
        $this->load->view('admin/setup_residence',$data);//ngirim variable user data ke page User nanti 
        $this->load->view('templates/footer');

    }

    public function view_application()
    {
        $data['title'] = 'View Application';
        $data['user'] = $this->db->get_where('user', ['username'=> $this->session->userdata('username')])->row_array();
        $lol = $this->session->userdata('username');//mengambil username officer yang login sekarang
        $result= $this->db->query("SELECT `user_id` FROM `user` WHERE `username` = '$lol'")->row()->user_id;
        $staff_id = $this->db->query("SELECT `staff_id` FROM `housing_officer` WHERE `user_id` = '$result'")->row()->staff_id;
        $application = $this->db->query("SELECT * FROM `application` WHERE (`status` = 'New' OR `status` = 'Waitlist') AND `Staff_id`=' $staff_id' ");
        $row = $application->result_array();
        $data['application'] = $row;
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar-admin',$data);
        $this->load->view('templates/topbar-admin',$data);
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
        $this->form_validation->set_rules('numunits', 'Number Of Unit', 'required|numeric');
        $this->form_validation->set_rules('size_per_unit', 'Size Per Unit', 'required|numeric');
        $this->form_validation->set_rules('monthly_rental', 'Monthly Rental', 'required|numeric');
        $numOfUnit = $this->input->post('numunits',true);
        $dataArray = [
            'staff_id'=>$staff_id,
            'address' => $this->input->post('address',true),
            'numunits' =>$numOfUnit,
            'size_per_unit' => $this->input->post('size_per_unit',true), 
            'monthly_rental' => $this->input->post('monthly_rental',true)
        ];
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
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar-admin',$data);
            $this->load->view('templates/topbar-admin',$data);
            $this->load->view('admin/setup_residence',$data);//ngirim variable user data ke page User nanti 
            $this->load->view('templates/footer');
            // redirect('admin/setup_residence');
        }
        else
        {
            $query = $this->db->query("SELECT * FROM unit;");
            $this->db->insert('residences', $dataArray);
            $insert_id= $this->db->insert_id();
            $total = $query->num_rows();
            for ($x = 0; $x < $numOfUnit; $x++) {
                $dataUnit = [
                    'unit_no'=> $total+1,
                    'availability'=>"Available",
                    'residence_id'=>$insert_id,

                    
                ];
                $this->db->insert('unit',$dataUnit);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Residence has been added! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/setup_residence');
        }

    }
    function editResidence()
    {
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('numunits', 'Number Of Unit', 'required|numeric');
        $this->form_validation->set_rules('size_per_unit', 'Size Per Unit', 'required|numeric');
        $this->form_validation->set_rules('monthly_rental', 'Monthly Rental', 'required|numeric');
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
            $this->load->view('templates/topbar-admin',$data);
            $this->load->view('admin/setup_residence',$data);//ngirim variable user data ke page User nanti 
            $this->load->view('templates/footer');
        }
        else{
            $this->menu->editRes($data,$residence_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Successfully Edited! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/setup_residence');
        }
    }
    public function deleteResidence($id)
    {
        $this->menu->deleteSub($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Residence successfully deleted! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        //redirect
        redirect('admin/setup_residence');
    }

    public function waitlistApp($application_id)
    {
            $data1=array('status'=>"Waitlist");
            $this->menu->waitlistA($data1, $application_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Application status has been set to Waitlist <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            //redirect
            redirect('admin/view_application');

        
    }

    public function approveApp($application_id)
    {
        

            $ap_id = $this->db->query("SELECT `applicant_id` FROM `application` WHERE `application_id` = '$application_id'")->row()->applicant_id;
            $re_id = $this->db->query("SELECT `residence_id` FROM `application` WHERE `application_id` = '$application_id'")->row()->residence_id;
            $un_id = $this->db->query("SELECT `unit_id` FROM `unit` WHERE `residence_id` = '$re_id' AND `availability`='Available'")->row()->unit_id;
            $data2=array('status'=>"Approved");
            $data4=array('availability'=>"Allocated");
            $this->menu->autoReject($ap_id);
            $this->menu->approveA($data2, $application_id);
            
            $dataArray = [
                'unit_id'=>$un_id,
                'application_id' =>$application_id,
                'fromDate' => $this->input->post('fromDate',true),
                'duration' => $this->input->post('duration',true),
                'endDate' => $this->input->post('endDate',true)   
            ];

            $this->db->insert('allocation', $dataArray);
            $this->menu->allocationU($data4,$un_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Application Approved <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            //redirect
            redirect('admin/view_application');

        
    }

    public function declineApp($application_id)
    {
            $data1=array('status'=>"Rejected");
            $this->menu->decA($data1, $application_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Application status has been set to Waitlist <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            //redirect
            redirect('admin/view_application');

        
    }
    
}

