<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function getReports_StudentsData($select,$table,$condition,$groupby,$pager,$type){
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

	public function getReports_AwardsData($select,$table,$condition,$groupby,$pager,$type){
		$this->db->select($select);
        $this->db->from($table);
        $this->db->join("tbl_studentmembership sm","sm.branch_id = b.branch_id","left");
        $this->db->join("tbl_studentcompetitions sc","sc.student_id = sm.student_id","left");
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
	
	public function getReports_ClassesData($select,$table,$condition,$groupby,$pager,$type){
		$this->db->select($select);
        $this->db->from($table);
        $this->db->join("tbl_schedules sch","sch.branch_id=b.branch_id","inner");
        $this->db->join("tbl_classes c","c.class_id = sch.class_id","inner");
		
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

	public function getStudents_ChartData($select,$table,$condition,$groupby,$pager,$type){
		$this->db->select($select);
        $this->db->from($table);
        $this->db->join("tbl_studentmembership sm","sm.`student_id`=s.`student_id`","inner");
        $this->db->join("tbl_branches b","b.`branch_id`=sm.`branch_id`","inner");
		
        if(!empty($condition)){
            $this->db->where($condition);
        }

		if (!empty($pager)) {
		$this->db->limit($pager['limit'],$pager['offset']);
		}

		$this->db->group_by("MONTH(registration_date)");
		$this->db->group_by("branch_name");

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