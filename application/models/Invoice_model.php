<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function getInvoiceList($select,$table,$condition,$pager,$groupby,$type)
	{
		$this->db->select($select);
        $this->db->from($table);
        $this->db->join("tbl_branches b","b.branch_id = si.branch_id","inner");
        $this->db->join("tbl_students s","s.student_id = si.student_id","inner");
        if(!empty($condition)){
            $this->db->where($condition);
		}

		$this->db->order_by("si.date_added","DESC");
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

	public function getStockInfo($select,$table,$condition,$pager,$type)
	{
		$this->db->select($select);
        $this->db->from($table);
        $this->db->join("tbl_branches b","b.branch_id = s.branch_id","inner");
        if(!empty($condition)){
            $this->db->where($condition);
		}

		$this->db->order_by("s.date_added","DESC");
		
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

/* End of file Libraries_model.php */
/* Location: ./application/models/Libraries_model.php */