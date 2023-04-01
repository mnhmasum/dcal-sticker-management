<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RecordModel;

class Record extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index()
    {
        //$model = new RecordModel();
        $db = db_connect();
        $query = $db->query('SELECT notes.id, notes.vehicleno, notes.images, notes.status, notes.created_at, office.office_name, users.fullname FROM notes join office on notes.office = office.id join users on notes.user_id = users.id');
        $rows = array();
        foreach ($query->getResult('array') as $row) $rows[] = $row;
        $data['result'] = $rows;
        //$data['records'] = "fdsfsd";
        return $this->respond($data);
    }

    public function login()
    {
        $db = db_connect();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $sql = "SELECT * FROM users where username='" . $username . "' and password='" . md5($password) . "'";
        $query = $db->query($sql);
        $resultCount = count($query->getResult('array'));
        $data = "";
        if ($resultCount > 0) {
            foreach ($query->getResult('array') as $row) {
                // $session_data = array(
                //     'userid' => $row['id'],
                //     'username' => $row['username'],
                //     'password' => $row['password'],
                //     'office' => $row['office'],
                //     'is_logged_in' => true,
                // );
                //$this->session->set($session_data); // setting session data
               
                $response = [
                    'status'   => 201,
                    'error'    => null,
                    'data' => [
                        'user_id' => $row['id'],
                        'username' => $row['username'],
                        'office' => $row['office'],    
                    ],
                    'messages' => [
                        'success' => 'Login Success'
                    ]
                ];
                return $this->respondCreated($response);    

            }
        }

         
        $response = [
            'status'   => 401,
            'error'    => null,
            'messages' => [
                'success' => 'Login Failed'
            ]
        ];
        return $this->respondCreated($response);
    }

    // create
    public function create()
    {

        $file1 = $this->request->getFile('image1');
        $imageNameOne = $file1->getName();

        // Renaming file before upload
        $temp = explode(".", $imageNameOne);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $file1->move('uploads', $newfilename);

        //file_put_contents("uploads/testttttt.jpg",base64_decode($file1));

        $all_images_path = $newfilename;
        
        $file2 = $this->request->getFile('image2');
        if (!empty($file2)) {
           
            $imageNameTwo = $file2->getName();
            $temp = explode(".", $imageNameTwo);
            $newfilenameTwo = round(microtime(true)) . '.' . end($temp);
            $file2->move('uploads', $newfilenameTwo);
            $all_images_path .= '||' . $newfilenameTwo;
        }

        $data = [
            'vehicleno' => $this->request->getVar('vehicleno'),
            'office'  => $this->request->getVar('office'),
            'images'  => $all_images_path,
            'user_id'  => $this->request->getVar('user_id'),

        ];

        $db = db_connect();
        $sql = 'INSERT INTO notes (vehicleno, office, images, user_id) VALUES(' . $data["vehicleno"] . ',"' . $data["office"] . '","' . $all_images_path . '", "' . $data["user_id"] . '")';
        $query = $db->query($sql);
        
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Record created successfully'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single user
    public function show($id = null)
    {
        $model = new RecordModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No employee found');
        }
    }

    public function view($id = null)
    {
        $db = db_connect();
        $query = $db->query('SELECT notes.id, notes.vehicleno, notes.images, notes.status, notes.created_at, office.office_name, users.fullname FROM notes join office on notes.office = office.id join users on notes.user_id = users.id
         and notes.user_id='.$id);

            $response = [
                'status'   => 201,
                'error'    => null,
                'data' => $query->getResult('array'),
                'messages' => [
                    'total_rocords' => count($query->getResult('array'))
                ]
            ];
            return $this->respondCreated($response);    

        
    }

    // update
    public function update($id = null)
    {
        $file1 = $this->request->getFile('image1');
        $imageNameOne = $file1->getName();

        // Renaming file before upload
        $temp = explode(".", $imageNameOne);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $file1->move('uploads', $newfilename);

        $all_images_path = $newfilename;
        
        $file2 = $this->request->getFile('image2');
        if (!empty($file2)) {
            $imageNameTwo = $file2->getName();
            $temp = explode(".", $imageNameTwo);
            $newfilenameTwo = round(microtime(true)) . '.' . end($temp);
            $file2->move('uploads', $newfilenameTwo);
            $all_images_path .= '||' . $newfilenameTwo;
        }

        $data = [
            'vehicleno' => $this->request->getVar('vehicleno'),
            'office'  => $this->request->getVar('office'),
            'images'  => $all_images_path,
            'user_id'  => $this->request->getVar('user_id'),

        ];

        $db = db_connect();
        
        $sql = "UPDATE `notes` SET `vehicleno` = '" . $data['vehicleno'] . "', `status` = '" . $data['vehicleno'] . "',
        `images` = '" . $data['images'] . "' WHERE `id` =" . $id . " and user_id=" . $data['user_id'];
        
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Record created successfully'
            ]
        ];
        return $this->respondCreated($response);
    }
    // delete
    public function delete($id = null)
    {
        $db = db_connect();
        $sql = "Delete from notes where id=" . $id;
        $query = $db->query($sql);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Deleted successfully'
            ]
        ];

        return $this->respond($response);
    }

    // update
    public function change_password()
    {
        $db = db_connect();

        $data = [
            'old_password' => $this->request->getVar('old_password'),
            'new_password'  => $this->request->getVar('new_password'),
            'user_id' => $this->request->getVar('user_id')
        ];
        

        // $db = db_connect();
        $sql = "SELECT * FROM users where id='".$data['user_id']."' and password='".md5($data['old_password'])."'";

        $query = $db->query($sql);

        if (count($query->getResult('array')) > 0) {
            $sql = "UPDATE `users` SET `password` = '" .md5($data['new_password']). "' WHERE id=". $data['user_id'];
            $db->query($sql);
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Password has been updated successfully'
                ]
            ];        
        } else {
            $response = [
                'status'   => 401,
                'error'    => true,
                'messages' => [
                    'success' => 'Your old password does not match'
                ]
            ];
        }
        

        return $this->respond($response); 
    }
}

