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
        $this->db->join("tbl_classes c","s.class_id = c.class_id","inner");
        $this->db->join("tbl_branches b","b.branch_id = s.branch_id","inner");
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
        $this->db->from("tbl_attendance a");
        $this->db->join("tbl_schedules s","s.schedule_id = a.schedule_id","inner");
        if(!empty($condition)){
            $this->db->where($condition);
        }
        $this->db->order_by("a.schedule_date","DESC");

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

	public function getClassStudents($select,$condition,$pager,$type){

		$this->db->select($select);
        $this->db->from("tbl_students s");
        $this->db->join("tbl_studentpackages sp","sp.student_id = s.student_id","inner");
		$this->db->join("tbl_packages p","p.package_id = sp.package_id","inner");
		$this->db->join("tbl_schedules sc","sc.schedule_id = p.schedule_id","inner");
		
        if(!empty($condition)){
            $this->db->where($condition);
        }
        $this->db->order_by("s.lastname","ASC");
        $this->db->order_by("s.firstname","ASC");
        $this->db->order_by("s.middlename","ASC");

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