<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcements extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
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

    public function getAnnouncements()
    {
        $type = $groupby=""; $condition = $pager = $orderby = $join = [];
        $select = "*";
        $data = jsondata();

        if(!empty($data)){
            if(!empty($data['select'])){ $select = $data['select']; }
            if(!empty($data['type'])){ $type = $data['type']; }
            if(!empty($data['groupby'])){ $groupby = $data['groupby']; }
            if(!empty($data['condition'])){ $condition = $data['condition']; }
            if(!empty($data['pager'])){ $pager = $data['pager']; }
            if(!empty($data['orderby'])){ $orderby = $data['orderby']; }
            if(!empty($data['join'])){ $join = $data['join']; }
        }
        $announcementslist = $this->Main->getDataOneJoin($select,"tbl_announcements a",$join,$condition,$pager,$orderby,$groupby,$type);
        if(!empty($announcementslist->photos)){ $announcementslist->photos = base64_encode($announcementslist->photos); }

        if(!empty($announcementslist)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "announcementslist" => $announcementslist
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
    }

    public function postAnnouncement()
    {
        $data = jsondata();
        
        if(!empty($data)){
            $announcement_id = $data["announcement_id"];

            $dataupdate = [
                "status"        => 1,
                "date_posted"   => date("Y-m-d H:i:s")
            ];
            $updatequery = $this->Main->update("tbl_announcements",["announcement_id"=>$announcement_id],$dataupdate,"");

            $success = true;
            $message = "Announcement was posted successfully.";
            $type = "success";
        }else{
            $success = false;
            $message = "Announcement was not posted.";
            $type = "warning";
        }

        $response = array(
            "success"   => $success,
            "message"   => $message,
            "type"      => $type,
        );
        response_json($response);
    }
    
}
