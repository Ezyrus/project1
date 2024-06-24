<?php 
require FCPATH. '/vendor/autoload.php';

class Dtr extends CI_Controller {
     
    public function __construct()
    {
        parent::__construct();
        $this->load->model("dtrModel");
    }

    public function timeIn() {
        $admin_id = $this->input->post("admin_id");

        $modelResponse = $this->dtrModel->insert_time($admin_id);        
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

    public function dateFilter($admin_id) {
        $dateFrom = $this->input->post("dateFrom"); 
        $dateTo = $this->input->post("dateTo");
        
        $data = $this->session->userdata("adminLoggedIn");
        $data["dtr"
        ] = $this->dtrModel->populateDtr_dateFilter($admin_id, $dateFrom, $dateTo);
        $data["title"] = "Home";
        
        $this->load->view("inc/headers", $data);
        $this->load->view("home", $data);
   }

   public function exportPdf() {
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML('<h1>Hello world!</h1>');
    $mpdf->Output();
   }

}

?>