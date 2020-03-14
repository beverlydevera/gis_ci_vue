<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        // $this->load->model("Chat_model",'chat');
        $this->load->library('session');
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
        $chatmessages = $this->Main->raw("SELECT * FROM tbl_messages WHERE message_id > (SELECT MAX(message_id)-50 FROM tbl_messages) AND $condition");
        $chatmessagescount = $this->Main->count("tbl_messages",$condition);
        
        if(!empty($chatmessages)){
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

}
