<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function getClassScheds($select,$table,$condition,$pager,$type){
		$this->db->select($select);
        $this->db->from($table);
        if(!empty($condition)){
            $this->db->where($condition);
        }
        $this->db->order_by("class_title","ASC");

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

	public function getClassSchedInfo($select,$condition,$pager,$type){

		$this->db->select($select);
        $this->db->from("tbl_attendance");
        if(!empty($condition)){
            $this->db->where($condition);
        }
        // $this->db->order_by("sessions","ASC");

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

	public function getClassSchedStudents($select,$condition,$condition_wherein,$pager,$type){

		$this->db->select($select);
        $this->db->from("tbl_students");
        $this->db->join("tbl_studentpackages","tbl_studentpackages.student_id = tbl_students.student_id","inner");
		$this->db->join("tbl_packages","tbl_packages.package_id = tbl_studentpackages.package_id","inner");
		// if(!empty($condition_wherein)){
        //     $this->db->where_in($condition_wherein['col'],$condition_wherein['arr']);
		// }
        if(!empty($condition)){
            $this->db->where($condition);
			$this->db->where($condition_wherein['col']." IN (".$condition_wherein['arr'].")");
		}
        $this->db->order_by("tbl_students.lastname","ASC");
        $this->db->order_by("tbl_students.firstname","ASC");
        $this->db->order_by("tbl_students.middlename","ASC");

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

	public function getClassHistoryInfo($select,$condition,$pager,$type){

		$this->db->select($select);
        $this->db->from("tbl_attendance");
        if(!empty($condition)){
            $this->db->where($condition);
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

}

/* End of file Recruitment_model.php */
/* Location: ./application/models/Recruitment_model.php */