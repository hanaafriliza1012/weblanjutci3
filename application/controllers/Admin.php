<?php
class Admin extends CI_controller
{
    public function index()
    {
        echo 'Selamat Datang,' . $this->session->userdata('name');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
