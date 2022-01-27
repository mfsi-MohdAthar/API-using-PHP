<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Student.php';

    $database = new Database();
    $db = $database->connect();

    //Instantiate Student Object
    $student = new Student($db);

    //Get POST method Data
    $data = json_decode(file_get_contents("php://input"));
    
    $student->FName = $data->FName;
    $student->LName = $data->LName;
    $student->Department = $data->Department;
    $student->DOB = $data->DOB;
    $student->Gender = $data->Gender;
    $student->Email = $data->Email;
    $student->Phone = $data->Phone;
    
    if($student->addStudent()) {
        echo json_encode(
            array('message' => 'Student added')
        );
    } else {
        echo json_encode(
            array('message' => 'Student was not added')
        );
    }