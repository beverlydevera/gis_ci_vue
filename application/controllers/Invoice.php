<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model("Main");
        $this->load->model("Invoice_model","invoice");
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
        $pager = [
            "limit" => 10,
            "offset" => 0
        ];

        if(!empty($data)){
            if(!empty($data['groupby'])){ $groupby = $data['groupby']; }
            
            $condition = $data['condition'];
            if(!empty($condition['si.invoice_id'])){ $type="row"; }
        }

        // if(sesdata('role')==2){ $condition["si.branch_id"] = sesdata('branch_id'); }
        $select = "invoice_number, si.date_added, reference_id, lastname, firstname, amount, invoice_id, si.status as invstatus,branch_name";
        $invoicelist = $this->invoice->getInvoiceList($select,"tbl_studentinvoice si",$condition,$pager,$groupby,$type);
        
        // if(!empty($invoicelist)){
        //     $invoicetotal = $this->Main->getDataOneJoin("SUM(amount) as totalinvoice_amt","tbl_studentinvoice si","",$condition,"","","","row")->totalinvoice_amt;
        // }else{ $invoicetotal=0; }

        // unset($condition['si.branch_id']);
        // $paymenttotal = $this->Main->getDataOneJoin("SUM(amount) as totalpayment_amt","tbl_paymentshistory si","",$condition,"","","","row");
        // if(!empty($paymenttotal)){ $paymenttotal = $paymenttotal->totalpayment_amt; }else{ $paymenttotal=0; }

        $response = array(
            "success"   => true,
            "data"      => [
                "invoicelist" => $invoicelist,
                'invoiceinfo'       => [
                    // "totalinvoice"  => $invoicetotal,
                    // "totalpayment"  => $paymenttotal
                ]
            ]
        );
        
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
            if(!empty($paymentstotal)){ $paymentstotal = $paymentstotal->paymentstotal; }else{ $paymentstotal=0; }

            $response = array(
                "success"   => true,
                "data"      => [
                    "paymentslist" => $paymentslist,
                    "paymentstotal" => $paymentstotal
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

            userLogs("Invoice","Saved Payment (payment_id #".$insertquery['lastid'].")");
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
            if(!empty($paymentstotal)){ $paymentstotal = $paymentstotal->paymentstotal; }else{ $paymentstotal=0; }

            $response = array(
                "success"   => true,
                "data"      => [
                    "invoicedetails" => $invoicedetails,
                    "paymentstotal" => $paymentstotal
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

        userLogs("Invoice","Printed Invoice (invoice_id #".$invoice_id.")");
        $select = "lastname,firstname,middlename,reference_id,invoice_number,amount,,si.status as invstatus,si.date_added as sidate_added,branch_name,branch_address,branch_zipcode,branch_contactno";
        $data['invoicedetails'] = $this->invoice->getInvoiceList($select,"tbl_studentinvoice si",$condition,"",$groupby,"row");

        $data['studentmembership'] = $this->Main->getDataOneJoin("*","tbl_studentmembership sm","",$condition,"","","","row");
        if(!empty($data['studentmembership'])){
            $data['studentmembership']->insurance = json_decode($data['studentmembership']->insurance);
            $data['studentmembership']->insurance_avail = $data['studentmembership']->insurance->avail;
            $data['studentmembership']->insurance_price = $data['studentmembership']->insurance->price;
        }

        $join = [
            "table" => "tbl_packages p",
            "key"   => "p.package_id=sp.package_id",
            "jointype" => "inner"
        ];
        $data['studentpackages'] = $this->Main->getDataOneJoin("*","tbl_studentpackages sp",$join,$condition,"","","","");
        $data['paymentshistory'] = $this->Main->getDataOneJoin("*","tbl_paymentshistory ph","",$condition,"","","","");
        $data['paymentstotal'] = $this->Main->getDataOneJoin("SUM(ph.amount) as paymentstotal","tbl_paymentshistory ph","",$condition,"","","invoice_id","row");
        if(!empty($data['paymentstotal'])){ $data['paymentstotal'] = $data['paymentstotal']->paymentstotal; }else{ $data['paymentstotal']=0; }
        
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