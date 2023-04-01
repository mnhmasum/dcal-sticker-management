<?php

/**
 * Created by VScode.
 * User: masum
 * Date: 13/07/2022
 * Time: 13:50
 */
//defined('BASEPATH') OR exit('No direct script access allowed');
namespace App\Controllers;

class Users extends BaseController
{

    // public function __construct()
    // {
    // parent::__construct();
    // $this->load->helper(array('form', 'url'));
    // $this->load->library(array('session', 'form_validation', 'email'));
    // }

    //This function for checking is user is logged in or not
    public function authentication_check()
    {
        if ($this->session->get("is_logged_in") == false or empty($this->session->get("is_logged_in"))) {
            return redirect()->to('/');
        }
    }

    public function create_user()
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        $db = db_connect();
        $sql = "SELECT * FROM department";
        $query = $db->query($sql);
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['departments'] = $rows;

        $sql = "SELECT * FROM designation";
        $query = $db->query($sql);
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['designations'] = $rows;

        $sql = "SELECT * FROM office";
        $query = $db->query($sql);
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['offices'] = $rows;

        return view('header') . view('nav') . view('users/create_user', $data);
    }

    public function save_user()
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        $db = db_connect();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $designation = $this->request->getPost('designation');
        $department = $this->request->getPost('department');
        $office = $this->request->getPost('office');
        $contactnumber = $this->request->getPost('contactnumber');
        $email = $this->request->getPost('email');
        $active = $this->request->getPost('active');
        $fullname = $this->request->getPost('fullname');
        $role = 2;

        if (empty($active)) {
            $active = "0";
        } else {
            $active = "1";
        }

        $user_id = $this->session->get("userid");
        $db = db_connect();
        $sql = 'INSERT INTO users (fullname,designation, department, office, contactnumber, email, active, username, password, role, userid) 
        VALUES("' . $fullname . '","' . $designation . '","' . $department . '","' . $office . '","' . $contactnumber . '","' . $email . '","' . $active . '","' . $username . '","' . md5($password) . '","' . $role . '", "' . $user_id . '")';
        $db->query($sql);
        $_SESSION['msg'] = '<div class="alert alert-success text-center">New user has been created successfully!</div>';
        $this->session->markAsFlashdata('msg');
        return redirect()->to('/users');
    }

    public function edit_user($id)
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        self::authentication_check();
        $rows = array();
        $sql = "SELECT * FROM users where id =" . $id;
        $db = db_connect();
        $query = $db->query($sql);
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['users'] = $rows;

        $sql = "SELECT * FROM department";
        $query = $db->query($sql);
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['departments'] = $rows;

        $sql = "SELECT * FROM designation";
        $query = $db->query($sql);
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['designations'] = $rows;

        $sql = "SELECT * FROM office";
        $query = $db->query($sql);
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['offices'] = $rows;

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        return view('header') . view('nav') . view('users/edit_user', $data);
    }

    public function edit_user_save($id)
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        $fullname = $this->request->getPost('fullname');
        $designation = $this->request->getPost('designation');
        $department = $this->request->getPost('department');
        $office = $this->request->getPost('office');
        $contactnumber = $this->request->getPost('contactnumber');
        $email = $this->request->getPost('email');
        $active = $this->request->getPost('active');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        if (empty($active)) {
            $active = "0";
        } else {
            $active = "1";
        }
        $db = db_connect();
        $sql = "UPDATE `users` SET `fullname` = '" . $fullname . "',
        `designation` = '" . $designation . "',
        `department` = '" . $department . "',
        `office` = '" . $office . "',
        `contactnumber` = '" . $contactnumber . "',
        `email` = '" . $email . "',
        `active` = '" . $active . "',
        `username` = '" . $username . "',
        `password` = '" . $password . "' WHERE `id` =" . $id;
        $query = $db->query($sql);
        $_SESSION['msg'] = '<div class="alert alert-success text-center">User has been updated successfully!</div>';
        $this->session->markAsFlashdata('msg');
        return redirect()->to('/users');
    }

    public function view_users()
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        $this->authentication_check();
        $db = db_connect();
        $query = $db->query('SELECT users.id,users.fullname, users.email, users.contactnumber, users.active, users.role, users.username, b.designation_name, c.dept_name, d.office_name FROM `users` JOIN designation b ON users.designation = b.id JOIN department c ON users.department = c.id JOIN office d ON users.office = d.id');
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['result'] = $rows;
        return view('header') . view('nav') . view('users/view_users', $data);
    }

    public function delete_user($id)
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        self::authentication_check();
        $db = db_connect();
        echo $sql = "Delete from users where id=" . $id;
        $query = $db->query($sql);
        $_SESSION['msg'] = '<div class="alert alert-success text-center"> User deleted successfully!</div>';
        $this->session->markAsFlashdata('msg');
        return redirect()->to('/users');
    }
}
