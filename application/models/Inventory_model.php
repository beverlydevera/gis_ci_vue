<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function getInventoryList($select,$table,$condition,$pager,$groupby,$type)
	{
		$this->db->select($select);
        $this->db->from($table);
        $this->db->join("tbl_stocks s","i.inventory_id = s.inventory_id","inner");
        if(!empty($condition)){
            $this->db->where($condition);
		}

		$this->db->order_by("item_name","ASC");
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

/* End of file Libraries_model.php */
/* Location: ./application/models/Libraries_model.php */