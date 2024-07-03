<?php

class DtrModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function populateDtr($id)
    {
        $this->db->where("admin_id", $id);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('dtr')->result_array();
    }

    public function insert_time($admin_id, $timeIn_selfiePicture)
    {
        $data = array(
            "admin_id" => $admin_id,
            "time_in" => Main::getCurrentDateTime(),
            "time-in_picture" => $timeIn_selfiePicture
        );
        
        $lastTimeIn = $this->getLast_timeIn($admin_id);
        $currentDate = (new DateTime())->format('Y-m-d');

        if (empty($lastTimeIn)) {
            return $this->db->insert('dtr', $data);
        }

        $lastTimeInDateString = $lastTimeIn["time_in"];
        $lastTimeInDate = DateTime::createFromFormat('Y-m-d H:i:s', $lastTimeInDateString)->format('Y-m-d');

        if ($currentDate == $lastTimeInDate) {
            return false;
        } else {
            return $this->db->insert('dtr', $data);
        }

    }

    public function update_time($admin_id, $timeOut_selfiePicture)
    {
        $data = array(
            "admin_id" => $admin_id,
            "time_out" => Main::getCurrentDateTime(),
            "time-out_picture" => $timeOut_selfiePicture
        );

        $lastTimeIn = $this->getLast_timeIn($admin_id);
        $currentDate = (new DateTime())->format('Y-m-d');

        $lastTimeInDateString = $lastTimeIn["time_in"];
        $lastTimeInDate = DateTime::createFromFormat('Y-m-d H:i:s', $lastTimeInDateString)->format('Y-m-d');

        if ($currentDate == $lastTimeInDate) {
            if ($lastTimeIn["time_out"] == '0000-00-00 00:00:00') {
                $this->db->where("id", $lastTimeIn["id"]);
                return $this->db->update("dtr", $data);
            }
        } else {
            return false;
        }
    }

    public function getLast_timeIn($admin_id)
    {
        $this->db->order_by("id", "DESC");
        $this->db->limit(1);
        $row = $this->db->get_where("dtr", ["admin_id" => $admin_id])->row_array();
        return $row;
    }

    public function populateDtr_dateFilter($admin_id, $dateFrom, $dateTo) {    
        // The dateFrom & dateTo is a Y-m-d format without a time
        // While the `time_in` is datetime the input should be formatted as 
        // the `time_in` expects. 
        $dateFrom = date('Y-m-d 00:00:00', strtotime($dateFrom));
        $dateTo = date('Y-m-d 23:59:59', strtotime($dateTo));

        $this->db->where("admin_id", $admin_id);
        $this->db->where("time_in >= '$dateFrom'");
        $this->db->where("time_in <= '$dateTo'");   
        $this->db->order_by('id', 'DESC');
        return $this->db->get('dtr')->result_array();
    }
}

?>