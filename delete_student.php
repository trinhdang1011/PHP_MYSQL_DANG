<?php
require_once('database.php');

// Get IDs
$student_id = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);
$chuyenNganh_id = filter_input(INPUT_POST, 'chuyenNganh_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($student_id != false && $chuyenNganh_id != false) {
    $query = 'DELETE FROM students
              WHERE studentID = :student_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':student_id', $student_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Product List page
include('index.php');