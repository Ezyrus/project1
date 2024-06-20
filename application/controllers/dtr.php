<?php 

class Dtr extends CI_Controller {
     
    public function __construct()
    {
        parent::__construct();
        $this->load->model("dtrModel");
    }

    public function timeIn() {
        $data = array(
            "time_in" => $this->input->post("time"),
            "admin_id" => $this->input->post("admin_id")
        );
        $modelResponse = $this->dtrModel->insert_time($data);
        if ($modelResponse) {
            echo json_encode(['status' => true, 'message' => "Time In Successful"]);
        } else {
            echo json_encode(['status' => false, 'message' => "Time In Failed"]);
        }
    }

    public function timeOut() {
        $admin_id = $this->input->post("admin_id");

        $modelResponse = $this->dtrModel->update_time($admin_id);
    
        if ($modelResponse) {
            echo json_encode(['status' => true, 'message' => "Time Out Successful"]);
        } else {    
            echo json_encode(['status' => false, 'message' => "Time Out Failed"]);
        }
    }

}

?>