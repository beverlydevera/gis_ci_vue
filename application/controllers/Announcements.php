<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcements extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        
        // $config['upload_path'] = './uploads/';
        // $config['allowed_types'] = 'gif|jpg|png';
        // $config['max_size']  = '100';
        // $config['max_width'] = '1024';
        // $config['max_height'] = '768';

        // $this->load->library('upload', $config);

        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Announcements";
        $data['vueid'] = "announcements_page";
        $data['vfile'] = "page/announcements/index";
        $data['js'] = array('pages/announcements.js');
        $this->load->view('layout/main', $data);
    }

    public function saveNewAnnouncement()
    {
        $data = $this->input->post();
        $file = file_get_contents($_FILES['file']['tmp_name']);

        $data = [
            "title"     => $data['title'],
            "text"      => $data['text'],
            "photos"    => $file,
            "status"    => 0,
            "date_added"=> date("Y-m-d H:i:s")
        ];
        $insertquery = $this->Main->insert("tbl_announcements", $data,true);

        if(!empty($insertquery)){
            $success = true;
            $message = "Announcement was saved successfully.";
            $type = "success";
            $announcement_id = $insertquery['lastid'];
        }else{
            $success = false;
            $message = "Announcement was not saved.";
            $type = "warning";
            $announcement_id = "";
        }

        $response = array(
            "success"   => $success,
            "message"   => $message,
            "type"      => $type,
            "data"      => [
                "announcement_id"   => $announcement_id
            ]
        );
        response_json($response);

        // insert($table, $data, $return = false)
        // $file = addslashes(file_get_contents($_FILES['file']['tmp_name']));
        // $query = $this->Main->raw("INSERT INTO tbl_announcements (photos) VALUES ('$file')");
        // File name

        // $filename = $_FILES['file']['name'];

        // // Valid file extensions
        // $valid_extensions = array("jpg","jpeg","png","pdf");

        // // File extension
        // $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // // Check extension
        // if(in_array(strtolower($extension),$valid_extensions) ) {

        // // Upload file
        // if(move_uploaded_file($_FILES['file']['tmp_name'], "uploads/".$filename)){
        //     echo 1;
        // }else{
        //     echo 0;
        // }
        // }else{
        // echo 0;
        // }

        // exit;
    }
    
}
