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

    public function insert_time($data)
    {
        return $this->db->insert('dtr', $data);

        // $lastTimeIn = $this->getLast_timeIn($data['admin_id']);
        // $lastTimeInDateString = $lastTimeIn["time_in"];
        // $lastTimeInDate = DateTime::createFromFormat('Y-m-d H:i:s', $lastTimeInDateString)->format('Y-m-d');
        // $currentDate = (new DateTime())->format('Y-m-d');

        // if ($this->isDuplicate_timeIn($lastTimeIn["id"])) {
        //     return false;
        // } else {
        //     if ($currentDate == $lastTimeInDate) {
        //         return false;
        //     } else {
        //         return $this->db->insert('dtr', $data);
        //     }
        // }
    }

    public function update_time($admin_id)
    {
        //The data that is going to be updated is based on:
        //User previous time in row selecting their `id` limited to 1
        //Based on that row we check if the `time_in` is based on the current date
        //return false if same, update data if not.

        $lastTimeIn = $this->getLast_timeIn($admin_id);
        $lastTimeInDateString = $lastTimeIn["time_in"];
        $lastTimeInDate = DateTime::createFromFormat('Y-m-d H:i:s', $lastTimeInDateString)->format('Y-m-d');
        $currentDate = (new DateTime())->format('Y-m-d');
        $data = array(
            "admin_id" => $admin_id,
            "time_out" => Main::getCurrentDateTime()
        );

        if (!$this->isDuplicate_timeOut($lastTimeIn["id"])) {
            return false;
        } else {
            if ($currentDate == $lastTimeInDate) {
                $this->db->where("id", $lastTimeIn["id"]);
                return $this->db->update("dtr", $data);
            } else {
                return false;
            }
        }
    }

    public function getLast_timeIn($admin_id)
    {
        $this->db->order_by("id", "DESC"); // get the latest data
        $this->db->limit(1); // limit to one
        // output shall be a user's data the last time they logged in
        $row = $this->db->get_where("dtr", ["admin_id" => $admin_id])->row_array();
        return $row;
    }

    public function isDuplicate_timeIn($id)
    {
        $this->db->order_by("id", "DESC");
        $this->db->limit(1);
        $row = $this->db->get_where("dtr", ["id" => $id])->row_array();
        if ($row["time_in"] === '0000-00-00 00:00:00') {
            return true;
        }
    }

    public function isDuplicate_timeOut($id)
    {
        $this->db->order_by("id", "DESC");
        $this->db->limit(1);
        $row = $this->db->get_where("dtr", ["id" => $id])->row_array();
        if ($row["time_out"] === '0000-00-00 00:00:00') {
            return true;
        }
    }
}

?>