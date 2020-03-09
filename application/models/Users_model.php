<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function getUserLogs($select = "*", $condition = array(), $like = array(), $offset = 0, $order = array(), $limit = 10){
        $this->db->select($select);
		$this->db->from("tbl_users u");
        $this->db->join("tbl_userlogs ul","u.user_id = ul.user_id","inner");
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