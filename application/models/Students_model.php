<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function getStudents($select,$table,$condition,$pager,$type){
		$this->db->select($select);
        $this->db->from($table);
        if(!empty($condition)){
            $this->db->where($condition);
		}

		if($table=="tbl_students"){
			$this->db->order_by("lastname","ASC");
			$this->db->order_by("firstname","ASC");
			$this->db->order_by("middlename","ASC");
		}else if($table=="tbl_studentmembership"){
			$this->db->order_by("studmem_id","DESC");
		}

		if (!empty($pager)) {
		$this->db->limit($pager['limit'],$pager['offset']);
		}

		$query = $this->db->get();
		if ($query->num_rows()) {

			if ($type =="row") {
				return $query->row();
			}elseif($type =="count_row"){
				return $query->num_rows();
			}elseif($type =="is_array") {
				return $query->result_array();
			}else{
				return $query->result();
			}
		}
		return null;
	}

	public function getStudentList($select = "*", $condition = array(), $like = array(), $offset = 0, $order = array(), $limit = 10){
        $this->db->select($select);
        $this->db->from("tbl_students");
        $this->db->limit($limit, $offset);
        if (!empty($like)) {
            if (is_array($like['column'])) {
                foreach ($like['column'] as $lk => $lv) {
                    $this->db->or_like($lv, $like['data']);
                }
            } else {
                $this->db->like($like['column'], $like['data']);
            }
        }
        if (!empty($order)) {
            $this->db->order_by($order['col'], $order['order_by']);
        }
        if (!empty($condition)) {
            $this->db->where($condition);
        }
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return array();
	}

}

/* End of file Recruitment_model.php */
/* Location: ./application/models/Recruitment_model.php */