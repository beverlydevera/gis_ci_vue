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


}
