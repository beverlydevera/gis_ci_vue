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
        $this->db->order_by("lastname","ASC");
        $this->db->order_by("firstname","ASC");
        $this->db->order_by("middlename","ASC");

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

	public function getClassPackages($select,$table,$condition,$pager,$type){
		$this->db->select($select);
        $this->db->from($table);
        if(!empty($condition)){
            $this->db->where($condition);
        }
        $this->db->order_by("sessions","ASC");

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