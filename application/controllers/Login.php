<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        //$auth = $this->session->userdata('auth');
        //$role = $this->session->userdata('role');
        //if ($auth) {
        //  redirect(base_url($role));
        //}
    }
    public function index()
    {
        $this->load->view('login');
    }

    public function do_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $valid = $this->main_model->login('user', $username, $password);

            if (!$valid) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Username/Password tidak valid!</div>');

                $this->index();
            } else {
                $role = $this->main_model->get_data_one('user', 'username', $username, 'role');
                $id_user = $this->main_model->get_data_one('user', 'username', $username, 'id');
                $name = $this->main_model->get_data_one('user', 'username', $username, 'name');
                $session = array('auth' => 1, 'username' => $username, 'role' => $role, 'id_user' => $id_user, 'name' => $name);
                $this->session->set_userdata($session);

                redirect(base_url($role));
            }
        }
    }
}
