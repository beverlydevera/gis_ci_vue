<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function getNewStudents_data($select,$table,$condition,$groupby,$pager,$type){

		$this->db->select($select);
        $this->db->from($table);
        $this->db->join("tbl_studentmembership sm","sm.branch_id = b.branch_id","left");
        $this->db->join("tbl_students s","s.student_id = sm.student_id","left");
		
        if(!empty($condition)){
            $this->db->where($condition);
        }

		if (!empty($pager)) {
		$this->db->limit($pager['limit'],$pager['offset']);
		}

		if(!empty($groupby)){
			$this->db->group_by($groupby);
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

}

/* End of file Recruitment_model.php */
/* Location: ./application/models/Recruitment_model.php */