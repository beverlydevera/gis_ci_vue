<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function getSchedulesList($select,$table,$condition,$pager,$type){

		$this->db->select($select);
        $this->db->from($table);
        $this->db->join("tbl_branches b","b.branch_id = s.branch_id","inner");
		
        if(!empty($condition)){
            $this->db->where($condition);
        }
        $this->db->order_by("s.sched_day","ASC");
        $this->db->order_by("s.sched_time","ASC");

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

	public function getClassSchedList($select="*",$condition=array(),$pager=array(),$orderby=array(),$groupby,$type="")
	{
		$this->db->select($select);
		$this->db->from("tbl_schedules s");
		$this->db->join("tbl_classes c","c.class_id=s.class_id","inner");
		$this->db->join("tbl_branches b","b.branch_id=s.branch_id","inner");

        if(!empty($condition)){
            $this->db->where($condition);
		}

		if(!empty($orderby)){
			$this->db->order_by($orderby['column'],$orderby['order']);
		}
		if(!empty($groupby)){
			$this->db->group_by($groupby);
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

	public function getStudentsEnrolled($select="*",$condition=array(),$pager=array(),$orderby=array(),$groupby,$type="")
	{
		$this->db->select($select);
		$this->db->from("tbl_studentpackages sp");
		$this->db->join("tbl_students s","sp.student_id=s.student_id","inner");
		$this->db->join("tbl_packages p","p.package_id=sp.package_id","inner");

        if(!empty($condition)){
            $this->db->where($condition);
		}

		if(!empty($orderby)){
			$this->db->order_by($orderby['column'],$orderby['order']);
		}
		if(!empty($groupby)){
			$this->db->group_by($groupby);
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

	public function getClassStudentsInfo($select="*",$condition=array(),$pager=array(),$orderby=array(),$groupby,$type="")
	{
		$this->db->select($select);
		$this->db->from("tbl_studentattendance sa");
		$this->db->join("tbl_classscheds ca","ca.`classsched_id` = sa.`classsched_id`","inner");
		$this->db->join("tbl_schedules sc","sc.`schedule_id` = ca.`schedule_id`","inner");
		$this->db->join("tbl_studentpackages sp","sp.`student_id`=sa.`student_id`","inner");
		$this->db->join("tbl_students st","st.`student_id` = sa.`student_id`","inner");

        if(!empty($condition)){
            $this->db->where($condition);
		}

		if(!empty($orderby)){
			$this->db->order_by($orderby['column'],$orderby['order']);
		}
		if(!empty($groupby)){
			$this->db->group_by($groupby);
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