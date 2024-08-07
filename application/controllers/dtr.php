<?php
require FCPATH . '/vendor/autoload.php';

class Dtr extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("dtrModel");
        $this->load->model("adminPagesModel");
    }

    public function timeIn()
    {
        $timeIn_selfiePicture = $this->input->post('timeIn_selfiePicture', FALSE);
        $admin_id = $this->input->post("admin_id");
        $base64_timeInSelfiePicture = Main::formatDecodedBase64($timeIn_selfiePicture);

        if (empty($base64_timeInSelfiePicture)) {
            echo json_encode(['status' => false, 'message' => "Selfie Picture is Required"]);
        } else {
            $modelResponse = $this->dtrModel->insert_time($admin_id, $base64_timeInSelfiePicture);
            if ($modelResponse) {
                echo json_encode(['status' => true, 'message' => "Time In Successful"]);
            } else {
                echo json_encode(['status' => false, 'message' => "Time In Failed "]);
            }
        }
    }

    public function timeOut()
    {
        $timeOut_selfiePicture = $this->input->post('timeOut_selfiePicture', FALSE);
        $admin_id = $this->input->post("admin_id");
        $base64_timeOutSelfiePicture = Main::formatDecodedBase64($timeOut_selfiePicture);

        if (empty($base64_timeOutSelfiePicture)) {
            echo json_encode(['status' => false, 'message' => "Selfie Picture is Required"]);
        } else {
            $modelResponse = $this->dtrModel->update_time($admin_id, $base64_timeOutSelfiePicture);
            if ($modelResponse) {
                echo json_encode(['status' => true, 'message' => "Time Out Successful"]);
            } else {
                echo json_encode(['status' => false, 'message' => "Time Out Failed"]);
            }
        }
    }

    public function dateFilter($admin_id)
    {
        $dateFrom = $this->input->post("dateFrom");
        $dateTo = $this->input->post("dateTo");

        $data = $this->session->userdata("adminLoggedIn");
        $data["dtr"
        ] = $this->dtrModel->populateDtr_dateFilter($admin_id, $dateFrom, $dateTo);
        $data["title"] = "Home";

        $this->load->view("inc/headers", $data);
        $this->load->view("home", $data);
    }

    public function exportPdf($admin_id)
    {
        $data["adminRow"] = $this->adminPagesModel->readAdmin($admin_id);
        $data["adminDtr"] = $this->dtrModel->populateDtr($admin_id);
        $data["title"] = "Your Daily Time Record";
        $this->load->view("templates/export_table-pdf", $data);
    }

    public function exportExcel($admin_id)
    {
        $data["adminRow"] = $this->adminPagesModel->readAdmin($admin_id);
        $data["adminDtr"] = $this->dtrModel->populateDtr($admin_id);
        $data["title"] = "Your Daily Time Record";
        $this->load->view("templates/export_excel", $data);
    }

}

?>