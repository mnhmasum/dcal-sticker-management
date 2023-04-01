<?php

/**
 * Created by PhpStorm.
 * User: masum
 * Date: 02/11/2015
 * Time: 13:10
 */
//defined('BASEPATH') OR exit('No direct script access allowed');
namespace App\Controllers;

class Login extends BaseController
{

    /*public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation', 'email'));
    }*/


    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function login()
    {
        return view('header') . view('login/login_view');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }

    public function login_submit()
    {
        $db = db_connect();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $sql = "SELECT * FROM users where username='" . $username . "' and password='" . md5($password) . "'";
        $query = $db->query($sql);
        $resultCount = count($query->getResult('array'));
        if ($resultCount > 0) {
            foreach ($query->getResult('array') as $row) {
                $session_data = array(
                    'userid' => $row['id'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'office' => $row['office'],
                    'is_logged_in' => true,
                );
                $this->session->set($session_data); // setting session data
                print_r($session_data);
                return redirect()->to('/records');
            }
        }
    }

    // Api
    public function login_app_user()
    {
        $db = db_connect();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $sql = "SELECT * FROM users where username='" . $username . "' and password='" . md5($password) . "'";
        $query = $db->query($sql);
        $resultCount = count($query->getResult('array'));
        if ($resultCount > 0) {
            foreach ($query->getResult('array') as $row) {
                $session_data = array(
                    'userid' => $row['id'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'office' => $row['office'],
                    'is_logged_in' => true,
                );
                $this->session->set($session_data); // setting session data
                print_r($session_data);
            }
        }
    }
}
