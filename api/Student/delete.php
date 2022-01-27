<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Student.php';

    $database = new Database();
    $db = $database->connect();

    //Instantiate Student Object
    $student = new Student($db);

    $student->ID = isset($_GET['ID']) ? $_GET['ID'] : die();

    //Student Query
    if($student->deleteStudent()) {
        echo json_encode(
            array('message' => "Student deleted")
        );
    } else {
        echo json_encode(
            array("message" => "Student not deleted")
        );
    }