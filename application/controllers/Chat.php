<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->library('session');
        date_default_timezone_set("Asia/Manila");
        checkLogin();
	}
    
	public function index()
	{
        $data['title'] = "Bravehearts | Chat";
        $data['vueid'] = "chat_page";
        $data['js'] = array('pages/chat.js');
        $this->load->view('page/chat/index', $data);
    }

    public function getChatMessages()
    {
        $data = jsondata();
        $to = $data['to_user_id'];
        $from = $data['from_user_id'];

        $to_userdata = $this->Main->getDataOneJoin("*","tbl_users",$join=array(),['user_id'=>$to],$pager=array(),$orderby=array(),$groupby="","row");
        if(!empty($to_userdata->photo)){ $to_userdata->photo = base64_encode($to_userdata->photo); }

        $condition = "(to_user_id=$to OR to_user_id=$from) AND (from_user_id=$to OR from_user_id=$from)";
        $chatmessages = $this->Main->raw("SELECT * FROM tbl_messages WHERE message_id > (SELECT MAX(message_id)-20 FROM tbl_messages) AND $condition");
        $chatmessagescount = $this->Main->count("tbl_messages",$condition);
        
        if(!empty($to_userdata)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "to_userdata"       => $to_userdata,
                    "chatmessages"      => $chatmessages,
                    "chatmessagescount" => $chatmessagescount,
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

    public function sendNewMessage()
    {
        $data = jsondata();
        if(!empty($data)){

            $data['date_added'] = date("Y-m-d H:i:s");
            unset($data['proper_datetime']);

            $insertquery = $this->Main->insert("tbl_messages",$data,true);

            if(!empty($insertquery)){
                $response = array(
                    "success"   => true,
                    "message"   => "",
                    "data"      => [
                        "message_id" => $insertquery['lastid'],
                        "date_added" => date("Y-m-d H:i:s")
                    ]
                );
            }else{
                $response = array(
                    "success"   => false,
                    "message"   => "Error sending message",
                    "data"      => ""
                );
            }
        }else{
            $response = array(
                "success"   => false,
                "message"   => "Error sending message",
                "data"      => ""
            );
        }
        response_json($response);
    }

}
