<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Student.php';

    $database = new Database();
    $db = $database->connect();

    //Instantiate Student Object
    $student = new Student($db);

    //Student Query
    $result = $student->getStudents();

    //Get row count
    $num = mysqli_num_rows($result);

    if($num > 0) {
        $students_arr = array();
        $students_arr['students'] = array();

        while($row = $result->fetch_assoc()) {
            extract($row);
            
            $student = array(
                'id' => $ID,
                'FName' => $FName,
                'LName' => $LName,
                'Gender' => $Gender,
                'DOB' => $DOB,
                'Email' => $Email,
                'Phone' => $Phone
            );
            array_push($students_arr['students'], $student);
        }

        //Turn to JSON
        echo json_encode($students_arr);
    
    } else {
        echo json_encode(
            array('message' => 'NO STUDENT FOUND')
        );
    }