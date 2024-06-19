<?php

class adminPages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("adminPagesModel");
    }

    public function goToLogIn()
    {
        $this->load->view("login");
    }

    public function goToRegister()
    {
        $this->load->view("register");
    }

    public function goToHome()
    {
        $data = $this->session->userdata("adminLoggedIn");
        if (empty($data)) {
            return $this->goToLogIn();   
        }
        $data["admins"
        ] = $this->adminPagesModel->populateAdmins();
        $this->load->view("home", $data);
    }

    public function goToAdministrators()
    {
        $data = $this->session->userdata("adminLoggedIn");
        if (empty($data)) {
            return $this->goToLogIn();   
        }

        $data["admins"
        ] = $this->adminPagesModel->populateAdmins();
        $this->load->view("administrators", $data);
    }

    public function login()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $modelResponse = $this->adminPagesModel->loginValidation($username, $password);

        if ($modelResponse) {
            echo json_encode(['status' => true, 'message' => "Admin Found!", "accessType" => $modelResponse["access_type"]]);
        } else {
            echo json_encode(['status' => false, 'message' => "Invalid Credentials"]);
        }
    }

    public function register()
    {
        $username = $this->input->post('username', true);
        $fullname = $this->input->post('fullname', true);
        $password = $this->input->post('password', true);

        $modelResponse = $this->adminPagesModel->registerAdmin($fullname, $username, $password);

        if ($modelResponse) {
            echo json_encode(['status' => true, 'message' => "Register Successful"]);
        } else {
            echo json_encode(['status' => false, 'message' => "Register Failed"]);
        }
    }

    public function logout() {
        // unset sessions
        // redirect to login page 
        $this->session->sess_destroy();
        $this->load->view("login");
    }

    // populate read admin form
    public function getAdmin($id) {
        $admin = $this->adminPagesModel->readAdmin($id);
        $this->load->view("update", $admin);
    }

    //submit btn
    public function submitUpdate() {
        $data = $this->input->post();
        $modelResponse = $this->adminPagesModel->updateAdmin($data);
       
        if ($modelResponse) {
            echo json_encode(['status' => true, 'message' => "Update Successful"]);
        } else {
            echo json_encode(['status' => false, 'message' => "Update Failed"]);
        }
    }
}

?>