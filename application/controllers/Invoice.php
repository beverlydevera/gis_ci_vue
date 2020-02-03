<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Invoice Statements";
        $data['vueid'] = "invoice_page";
        $data['vfile'] = "page/invoice/index";
        $data['js'] = array('pages/invoice.js');
        $this->load->view('layout/main', $data);
    }

    public function getInvoiceList()
    {
        $type = $groupby=""; $condition = $pager = $orderby = [];
        $data = jsondata();

        if(!empty($data)){
            if(!empty($data['groupby'])){ $groupby = $data['groupby']; }
            
            $condition = $data['condition'];
            if(!empty($condition['si.invoice_id'])){ $type="row"; }
        }
        $join = [
            "table"    => "tbl_students s",
            "key"      => "s.student_id=si.student_id",
            "jointype" => "inner"
        ];
        $invoicelist = $this->Main->getDataOneJoin("*, si.status as invstatus","tbl_studentinvoice si",$join,$condition,$pager,$orderby,$groupby,$type);
        
        if(!empty($invoicelist)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "invoicelist" => $invoicelist
                ]
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => ""
            );
        }
        response_json($response);
    }
    
}