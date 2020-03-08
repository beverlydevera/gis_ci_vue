<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function insert($table, $data, $return = false)
	{
		if ($return) {
			$lastid = "";
			$result =  $this->db->insert($table, $data);
			if ($result) {
				$lastid =  $this->db->insert_id();
			}
			return array('success' => $result, 'lastid' => $lastid);
		}
		return $this->db->insert($table, $data);
	}

	public function insertbatch($table = "", $data = array())
	{
		return $this->db->insert_batch($table, $data);
	}

	public function count($table = "", $condition = array())
	{
		$this->db->select("count(*) as total");
		$this->db->from($table);
		if (!empty($condition)) {
			$this->db->where($condition);
		}
		return $this->db->get()->row()->total;
	}

	public function select($data, $like = array())
	{
		$this->db->select($data['select']);
		$this->db->from($data['table']);
		if (!empty($data['condition'])) {
			$this->db->where($data['condition']);
		}

		if (!empty($data['limit'])) {
			$offset = 0;
			if (!empty($data['offset'])) {
				$offset = $data['offset'];
			}
			$this->db->limit($data['limit'], $offset);
		}

		if (!empty($like)) {
			$this->db->like($like['column'], $like['data']);
		}

		if (!empty($data['group_by'])) {
			$this->db->group_by($data['group_by']);
		}
		if (!empty($data['order'])) {
			$this->db->order_by($data['order']['col'], $data['order']['order_by']);
		}

		$query = $this->db->get();
		if ($query->num_rows()) {

			if ($data['type'] == "row") {
				return $query->row();
			} elseif ($data['type'] == "count_row") {
				return $query->num_rows();
			} else {
				return $query->result();
			}
		}
		return array();
	}

	public function delete($table, $condition)
	{
		return $this->db->delete($table, $condition);
	}

	public function update($table, $condition, $data, $return = "")
	{
		if (is_array($return)) {
			$this->db->where_in($return['col'],$condition);
		
		} else {
			$this->db->where($condition);
		}
		$r = $this->db->update($table, $data);
		if ($r) {
			return  array('success' => true);
		}
	}

	public function updatebatch($table = "", $data, $id = "")
	{
		return $this->db->update_batch($table, $data, $id);
	}

	public function raw($query, $row = false, $type = "")
	{
		$query = $this->db->query($query);
		if ($type != "update") {
			if ($query->num_rows()) {

				if ($row) {
					return $query->row();
				}
				return $query->result();
			}
			return null;
		}
	}

	public function emptyData($data = array())
	{
		if (!empty($data)) {
			foreach ($data as $value) {
				$this->db->from($value);
				$this->db->truncate();
			}
		}
	}

	public function getDataOneJoin($select="*",$table="",$join=array(),$condition=array(),$pager=array(),$orderby=array(),$groupby="",$type="")
	{
		$this->db->select($select);
		$this->db->from($table);
		if(!empty($join)){
			$this->db->join($join['table'],$join['key'],$join['jointype']);
		}
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

/* End of file Main.php */
/* Location: ./application/models/Main.php */
