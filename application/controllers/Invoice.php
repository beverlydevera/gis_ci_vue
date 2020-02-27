<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model("Main");
		$this->load->library('pdf');
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
        $invoicelist = $this->Main->getDataOneJoin("invoice_number, date_added, reference_id, lastname, firstname, amount, invoice_id, si.status as invstatus","tbl_studentinvoice si",$join,$condition,$pager,$orderby,$groupby,$type);
        
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

    public function viewPayments()
    {
        $type = $groupby=""; $condition = $orderby = $join = [];
        $data = jsondata();
        $invoice_id = $data['invoice_id'];

        if(!empty($data)){
            $condition = ["invoice_id"=>$invoice_id];
            $orderby = [
                "column" => "payment_id",
                "order"  => "DESC"
            ];
            $paymentslist = $this->Main->getDataOneJoin("*","tbl_paymentshistory ph",$join,$condition,"",$orderby,$groupby,$type);
            $paymentstotal = $this->Main->getDataOneJoin("SUM(ph.amount) as paymentstotal","tbl_paymentshistory ph",$join,$condition,"",$orderby,"invoice_id","row");

            $response = array(
                "success"   => true,
                "data"      => [
                    "paymentslist" => $paymentslist,
                    "paymentstotal" => $paymentstotal->paymentstotal
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

    public function savePayment()
    {
        $data = jsondata();
        
        if(!empty($data)){
            $paymentdetails = $data['paymentdetails'];
            $invoice_id = $paymentdetails['invoice_id'];
            $invoicestatus = $data['invoicestatus'];

            unset($paymentdetails['amountmax']);
            unset($paymentdetails['paymentdate']);
            $insertquery = $this->Main->insert("tbl_paymentshistory",$paymentdetails,true);

            $success = true;
            $type = "success";
            $message = "Payment was saved successfully.";
            
            $dataupdate = ["status"=>$invoicestatus];
            $updatequery = $this->Main->update("tbl_studentinvoice",["invoice_id"=>$invoice_id],$dataupdate,"");
        }else{
            $success = false;
            $type = "warning";
            $message = "Payment was not saved";
        }

        $response = array(
            'success'   => $success,
            'type'      => $type,
            'message'   => $message
        );
        response_json($response);
    }

    public function getInvoiceDetails()
    {
        $type = $groupby = ""; $condition = $orderby = $join = [];
        $data = jsondata();
        $invoice_id = $data['invoice_id'];

        if(!empty($data)){
            $condition = ["invoice_id"=>$invoice_id];
            $join = [
                "table"    => "tbl_students s",
                "key"      => "s.student_id=si.student_id",
                "jointype" => "inner"
            ];
            $invoicedetails = $this->Main->getDataOneJoin("s.student_id,invoice_id,invoice_number,lastname,firstname,amount,si.status as invstatus","tbl_studentinvoice si",$join,$condition,"",$orderby,$groupby,"row");
            $paymentstotal = $this->Main->getDataOneJoin("SUM(ph.amount) as paymentstotal","tbl_paymentshistory ph","",$condition,"",$orderby,"invoice_id","row");

            $response = array(
                "success"   => true,
                "data"      => [
                    "invoicedetails" => $invoicedetails,
                    "paymentstotal" => $paymentstotal->paymentstotal
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

    public function printInvoice($invoice_id)
    {
        $type = $groupby = ""; $condition = $orderby = $join = [];
        $condition = ["invoice_id"=>$invoice_id];
        $join = [
            "table"    => "tbl_students s",
            "key"      => "s.student_id=si.student_id",
            "jointype" => "inner"
        ];
        $data['invoicedetails'] = $this->Main->getDataOneJoin("*, si.status as invstatus","tbl_studentinvoice si",$join,$condition,"",$orderby,$groupby,"row");
        
        $this->load->view('page/invoice/invoicepdf',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $pdf = $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $filename = "INVOICE.pdf";
        $file = $this->dompdf->stream($filename, array("Attachment"=>0));
    }
    
}