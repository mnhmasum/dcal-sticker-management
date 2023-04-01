<?php

/**
 * Created by PhpStorm.
 * User: masum
 * Date: 13/07/2022
 * Time: 13:04
 */
//defined('BASEPATH') OR exit('No direct script access allowed');
namespace App\Controllers;

class Records extends BaseController
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

    public function create_record()
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        self::authentication_check();

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
        return view('header') . view('nav') . view('notes/create_record', $data);
    }

    public function save_record()
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        self::authentication_check();
        $file1 = $this->request->getFile('images.0');
        $file2 = $this->request->getFile('images.1');
        $newName = $file1->getRandomName();
        $file1->move('uploads', $newName);
        $all_images_path = $newName;

        if (!empty($file2)) {
            $newName = $file2->getRandomName();
            $file2->move('uploads', $newName);
        }


        $all_images_path = $all_images_path . '||' . $newName;

        $title = $this->request->getPost('vehicleno');
        $office = $this->session->get("office");
        $user_id = $this->session->get("userid");
        $db = db_connect();
        $query = $db->query('INSERT INTO notes (vehicleno, office, images, user_id) VALUES("' . $title . '","' . $office . '","' . $all_images_path . '", "' . $user_id . '")');
        $_SESSION['msg'] = '<div class="alert alert-success text-center">New record has been created successfully!</div>';
        $this->session->markAsFlashdata('msg');
        echo $this->session->get("is_logged_in");
        return redirect()->to('/records');
    }

    public function update_record($id)
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        self::authentication_check();
        $vehicleno = $this->request->getPost('vehicleno');
        $status = $this->request->getPost('status');
        if (empty($status)) {
            $status = 0;
        } else {
            $status = 1;
        }
        $db = db_connect();
        $sql = "UPDATE `notes` SET `vehicleno` = '" . $vehicleno . "',
        `status` = '" . $status . "' WHERE `id` =" . $id;
        $query = $db->query($sql);
        $_SESSION['msg'] = '<div class="alert alert-success text-center">New record has been saved successfully!</div>';
        $this->session->markAsFlashdata('msg');
        return redirect()->to('/records');
    }

    public function search_by_date()
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        self::authentication_check();
        $from_date = $this->request->getPost('fromdate') . " 00:00:00";
        $to_date = $this->request->getPost('todate') . " 23:59:59";

        if (empty($this->request->getPost('fromdate')) || empty($this->request->getPost('todate'))) {
            $sql = 'SELECT notes.id, notes.vehicleno, notes.images, notes.status, notes.created_at, office.office_name, users.fullname FROM notes join office on notes.office = office.id join users on notes.user_id = users.id';
        } else {
            $sql = "SELECT notes.id, notes.vehicleno, notes.images, notes.status, notes.created_at, office.office_name, users.fullname FROM notes join office on notes.office = office.id join users on notes.user_id = users.id where created_at > '" . $from_date . "' and created_at < '" . $to_date . "'";
        }

        $db = db_connect();

        $query = $db->query($sql);
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['result'] = $rows;
        return view('header') . view('nav') . view('notes/view_records', $data);
    }

    public function edit_record($id)
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        self::authentication_check();
        $rows = array();
        $sql = "SELECT notes.id, notes.vehicleno, notes.images, notes.status, notes.office, office.office_name, users.fullname FROM notes join office on notes.office = office.id join users on notes.user_id = users.id where notes.id =" . $id;
        $db = db_connect();
        $query = $db->query($sql);
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['notes'] = $rows;

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

        return view('header') . view('nav') . view('notes/edit_record', $data);
    }

    public function view_records()
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        $this->authentication_check();
        $db = db_connect();
        $query = $db->query('SELECT notes.id, notes.vehicleno, notes.images, notes.status, notes.created_at, office.office_name, users.fullname FROM notes join office on notes.office = office.id join users on notes.user_id = users.id');
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['result'] = $rows;
        return view('header') . view('nav') . view('notes/view_records', $data);
    }

    public function delete_record($id)
    {
        if ($this->session->get("is_logged_in") == false) {
            return redirect()->to('/');
        }
        self::authentication_check();
        $db = db_connect();
        echo $sql = "Delete from notes where id=" . $id;
        $query = $db->query($sql);
        $_SESSION['msg'] = '<div class="alert alert-success text-center"> Record deleted successfully!</div>';
        $this->session->markAsFlashdata('msg');
        return redirect()->to('/records');
    }

    //////////////Start API function/////////////
    public function records()
    {
        $db = db_connect();
        $query = $db->query('SELECT notes.id, notes.vehicleno, notes.images, notes.status, notes.created_at, office.office_name, users.fullname FROM notes join office on notes.office = office.id join users on notes.user_id = users.id');
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['result'] = $rows;
        echo json_encode($data);
    }

    public function records_by_user($user_id)
    {
        $db = db_connect();
        $query = $db->query('SELECT notes.id, notes.vehicleno, notes.images, notes.status, notes.created_at, office.office_name, users.fullname 
        FROM notes join office on notes.office = office.id join users on notes.user_id = users.id where notes.user_id=' . $user_id);
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['result'] = $rows;
        echo json_encode($data);
    }

    public function create_record_by_user($user_id)
    {
        //$file1 = $this->request->getFile('images.0');
        //$file2 = $this->request->getFile('images.1');

        // try {
        //     $newName = $file1->getRandomName();
        // } catch (\Exception $e) {
        //     echo 'Message: ' .$e->getMessage();
        // }

        // $file1->move('uploads', $newName);
        // $all_images_path = $newName;

        // if (!empty($file2)) {
        //     $newName = $file2->getRandomName();
        //     $file2->move('uploads', $newName);
        // }


        //$all_images_path = $all_images_path . '||' . $newName;
        $all_images_path = "tes";
        //$this->request->getVar('vehicleno')
        //$title = $this->request->getPost('vehicleno');
        //$office = $this->session->getPost("office") ;

        // $db = db_connect();
        // $query = $db->query('INSERT INTO notes (vehicleno, office, images, user_id) VALUES("' . $title . '","' . $office . '","' . $all_images_path . '", "' . $user_id . '")');
        // $_SESSION['msg'] = '<div class="alert alert-success text-center">New record has been created successfully!</div>';



        echo $this->request->getPost();

        var_dump($this->request->getPost());

        //$data['result'] = "Record has been created Successfully ";
       //echo json_encode($data);
    }
}
