<?php

class User extends CI_Controller
{
    public function __construct()
    {
           parent::__construct();
           $this->load->model('user_model');
    }
    public function index()
    {
        $this->load->model('user_model');
        $users = $this->user_model->getUser();
        $data = array(
            'users' => $users
        );
        $this->load->view('layout/header');
        $this->load->view('user/user', $data);
        $this->load->view('layout/footer');
    }
  

    public function show($userID = "") // แสดง
    {
       $user = $this->user_model->getUserByID($userID);
       $data = array(
        'user' => $user->row()
    );
       $this->load->view('layout/header');
       $this->load->view('user/show', $data);
       $this->load->view('layout/footer');
        }

        public function profile()
        {
            echo "Surpice";
        }
    
    public function edit($userID = "") //แก้ไข
    {
       $user = $this->user_model->getUserByID($userID);
       $data = array(
        'user' => $user->row()
    );
        $this->load->view('layout/header');
        $this->load->view('user/edit', $data);
        $this->load->view('layout/footer');
    
    }

    public function update($userID = "")
    {
        $data = $this->input->post(); 
        $result = $this->user_model->update($userID, $data);
        if($result){
            redirect('/user');
        }else{
            echo "Has error";
        }   
    }

    public function delete($userID = "")
    {
        $user = $this->input->post();
        $this->load->model('user_model');
        $result = $this->user_model->delete($userID);
        if($result){
            redirect('/user');
        }else{
            echo "Has error";
        }  
    }
    public function addUser() // เพิ่ม
    {
        $this->load->view('layout/header');
        $this->load->view('user/add_user');
        $this->load->view('layout/footer');
    }
    public function create() // สร้าง
    {
        $user = $this->input->post();
        $this->load->model('user_model');
        $result = $this->user_model->insertUser($user);
        if($result){
            redirect('/user');
        }else{
            echo "Has error";
        }
    }
}
