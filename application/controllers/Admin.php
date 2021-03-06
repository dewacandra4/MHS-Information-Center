<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();//manggil parent construct yang ada di CI
        $this->load->model('Menu_model', 'menu');
        is_logged_in();
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
        $application = $this->db->query("SELECT a.`application_id`,a.`residence_id`,b.`numunits`,b.`monthly_rental`,c.`username`,d.`monthlyIncome`,
        a.`requiredMonth`,a.`requiredYear`,a.`status`
         FROM `application` AS a INNER JOIN `residences` AS b on a.`residence_id` = b.`residence_id`
         INNER JOIN `applicant` AS d on a.`applicant_id`= d.`applicant_id`
         INNER JOIN `user` AS c on d.`user_id`=c.`user_id`
         WHERE (a.`status` = 'New' OR a.`status` = 'Waitlist') AND a.`Staff_id`=' $staff_id' ");
        $row = $application->result_array();
        $data['application'] = $row;
        //Set unit to available if endDate already finish
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mhs-center";
        $sql = "SELECT *,allo.`unit_id` as `oid` FROM `allocation` as allo,`unit` as op WHERE allo.`unit_id`=op.`unit_id` AND op.`availability`='Allocated'";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
            while($rows = $results->fetch_assoc()) 
            {
                $today = date('d-m-Y');
                $expDt = date('d-m-Y',strtotime($rows['endDate']));
                $unit_id = $rows['unit_id'];
                $re_id =  $this->db->query("SELECT `residence_id` FROM `unit` WHERE `unit`.`unit_id`= $unit_id")->row()->residence_id;
                $arr_unit = $this->db->query("SELECT `numunits` FROM `residences` WHERE `residence_id` = '$re_id'")->row()->numunits;
                $numUnits = $arr_unit +1;
                if($today>=$expDt){
                    $updCltSql = "UPDATE `unit` SET `availability`='Available' WHERE `unit`.`unit_id`= $unit_id";
                    $this->db->query("UPDATE `residences` SET `numunits` = $numUnits WHERE `residence_id` = $re_id");
                    $this->db->query($updCltSql);      
                }      
            }
        }
        $selectEnd = $this->db->query("SELECT `endDate` FROM `allocation`")->result_array();
        $todays = date('Y-m-d');
        for($i = 0; $i<sizeof($selectEnd); $i++)
        {
            $arr = array_values($selectEnd)[$i]['endDate'];
            if($arr<=$todays)//check if there is a endDate on the allocation that has expired
            {
                $allocation_id =  $this->db->query("SELECT `allocation_id` FROM `allocation` WHERE `endDate` = '$arr'")->row()->allocation_id;
                $deleteAllocation = "DELETE FROM `allocation` WHERE `allocation`.`allocation_id` = $allocation_id";
                $this->db->query($deleteAllocation); 
            }
        }      
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
            
            $this->db->insert('residences', $dataArray);
            $insert_id= $this->db->insert_id();
            for ($x = 0; $x < $numOfUnit; $x++) {
                $query = $this->db->query("SELECT * FROM unit;");
                $total = $query->num_rows();
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

    public function approveApp()
    {
        $application_id = $this->input->post('application_id',true);
        var_dump($application_id);
        $ap_id = $this->db->query("SELECT `applicant_id` FROM `application` WHERE `application_id` = '$application_id'")->row()->applicant_id;
        $re_id = $this->db->query("SELECT `residence_id` FROM `application` WHERE `application_id` = '$application_id'")->row()->residence_id;
        $un_id = $this->db->query("SELECT `unit_id` FROM `unit` WHERE `residence_id` = '$re_id' AND `availability`='Available'")->row()->unit_id;
        $arr_unit = $this->db->query("SELECT `numunits` FROM `residences` WHERE `residence_id` = '$re_id'")->row()->numunits;
        $data2=array('status'=>"Approved");
        $data4=array('availability'=>"Allocated");
        $formDate = $this->input->post('fromDate',true);
        $strFormDate = strtotime($formDate);
        $duration = $this->input->post('duration',true);
        $endDate = strtotime("+".$duration." month", $strFormDate);
        if($un_id==NULL)
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">There is No Available Unit for This Residence <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/view_application');
        }
        else
        {
            if($formDate==NULL)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Please Enter the Form Date! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
                redirect('admin/view_application');
            }
    
            else
            {
                $requredDate = date("m-Y", $strFormDate);
                $today = date("m-Y");
                if($today > $requredDate)//validate user input, user cannot select past dates
                {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Invalid date. Past dates cannot be selected ! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>');
                    redirect('admin/view_application');
                }
        
                else
                {
                    if($duration!=NULL)
                    {   
                        $this->menu->autoReject($ap_id);
                        $this->menu->approveA($data2, $application_id);
                        $this->menu->allocationU($data4,$un_id,$re_id);
                        $numUnit = $arr_unit - 1;
                        $this->db->query("UPDATE `residences` SET `numunits` = $numUnit WHERE `residence_id` = $re_id");
                        $dataArray = [
                            'unit_id'=>$un_id,
                            'application_id' =>$application_id,
                            'fromDate' => $formDate ,
                            'duration' => $duration ,
                            'endDate' => date("Y-m-d",$endDate)
                            
                        ];
                        $this->db->insert('allocation', $dataArray);
            
                        $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Application Approved <?php echo $endDate;?> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
                        //redirect
                        redirect('admin/view_application');
                    }
            
                    else
                    {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Please Select the Duration! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
                        redirect('admin/view_application');
                    }
            
                }
            }
        }
        

       
    }

    public function declineApp($application_id)
    {
            $data1=array('status'=>"Rejected");
            $this->menu->decA($data1, $application_id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert"> Application Rejected <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            //redirect
            redirect('admin/view_application');

        
    }
    
}

