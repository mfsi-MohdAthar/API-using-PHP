<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Student.php';

    $database = new Database();
    $db = $database->connect();

    //Instantiate Student Object
    $student = new Student($db);

    $student->ID = isset($_GET['ID']) ? $_GET['ID'] : die();

    //Student Query
    $result = $student->getStudent();
    
    $student_arr = array(
        'ID' => $student->ID,
        'FName' => $student->FName,
        'LName' => $student->LName,
        'Gender' => $student->Gender,
        'DOB' => $student->DOB,
        'Department' => $student->Department,
        'Email' => $student->Email,
        'Phone' => $student->Phone
    );

    print_r(json_encode($student_arr));