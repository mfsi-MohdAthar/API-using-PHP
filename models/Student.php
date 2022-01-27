<?php
    class Student {
        private $conn;
        private $table = 'student';

        //Student Properties
        public $ID;
        public $FName;
        public $LName;
        public $Gender;
        public $DOB;
        public $Department;
        public $Email;
        public $Phone;

        //Constructor
        public function __construct($db) {
            $this->conn = $db;
        }

        public function getStudents() {
            $query = 'SELECT * FROM ' . $this->table;
            $result = $this->conn->query($query);

            return $result;
        }

        public function getStudent() {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE ID = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i', $this->ID);

            $stmt->execute();
            $result = $stmt->get_result();

            $row = $result->fetch_array(MYSQLI_ASSOC);

            $this->ID = $row['ID'];
            $this->FName = $row['FName'];
            $this->LName = $row['LName'];
            $this->Gender = $row['Gender'];
            $this->DOB = $row['DOB'];
            $this->Department = $row['Department'];
            $this->Email = $row['Email'];
            $this->Phone = $row['Phone'];
            
        }

        public function addStudent() {
            $query = "INSERT INTO " . $this->table . " (FName, LName, Gender, DOB, Department, Email, Phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);

            //Bind param
            $stmt->bind_param("sssssss", $this->FName, $this->LName, $this->Gender, $this->DOB, $this->Department, $this->Email, $this->Phone);

            if($stmt->execute()) {
                return true;
            } else {
                printf('Error: %s.\n', $stmt->error);
                return false;
            }
        }

        public function updateStudent() {
            $query = "UPDATE " . $this->table . " SET FName = ?, LName = ?, Gender = ?, DOB = ?, Department = ?, Email = ?, Phone = ? WHERE ID = ?";
            $stmt = $this->conn->prepare($query);

            //Bind param
            $stmt->bind_param("sssssssi", $this->FName, $this->LName, $this->Gender, $this->DOB, $this->Department, $this->Email, $this->Phone, $this->ID);

            if($stmt->execute()) {
                return true;
            } else {
                printf('Error: %s.\n', $stmt->error);
                return false;
            }
        }

        public function deleteStudent() {
            $query = "DELETE FROM " . $this->table . " WHERE ID = ?";
            $stmt = $this->conn->prepare($query);

            //Bind param
            $stmt->bind_param("i", $this->ID);

            if($stmt->execute()) {
                return true;
            } else {
                printf('Error: %s.\n', $stmt->error);
                return false;
            }
        }

    }