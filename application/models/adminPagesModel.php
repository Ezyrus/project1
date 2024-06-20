<?php

class AdminPagesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function loginValidation($username, $password)
    {
        $row = $this->db->get_where("admin", ['username' => $username])->row_array();
        if ($row) {
            if (password_verify($password, $row["password"])) {
                $this->session->set_userdata("adminLoggedIn", $row);
                return $row;
                // Admin found
            } else {
                return false;
                // Wrong password
            }
        } else {
            return false;
            // Username not found
        }
    }

    //readAdmin 
    public function registerAdmin($fullname, $username, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
            "access_type" => "admin",
            "fullname" => $fullname,
            "username" => $username,
            "password" => $hashed_password
        );
        if ($this->db->insert("admin", $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function populateAdmins(){
        $this->db->order_by('id','DESC');
        return $this->db->get('admin')->result_array();
    }

    public function readAdmin($id){
        return $this->db->get_where("admin", ['id' => $id])->row_array();
    }

    public function updateAdmin($data) {
        $this->db->where("id", $data["id"]);
        return $this->db->update("admin", $data);
    }

    public function deleteAdmin($id){
    }
}

?>