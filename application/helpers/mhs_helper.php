<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        if($menu == "admin")
        {
            $menu = "Housing Officer";
        }
        else
        {
            $menu = "Applicant";
        }

        $queryRole = $ci->db->get_where('user_role', ['role' => $menu])->row_array();
        $role = $queryRole['role'];

        $userAccess = $ci->db->get_where('user_role', [
            'role_id' => $role_id,
            'role' => $role
        ])->row_array();

        if (empty($userAccess)) { 
            redirect('auth/blocked'); 
        } 
    }
}