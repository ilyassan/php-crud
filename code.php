<?php
session_start();
include('dbcon.php');

function executeCrudOperation($con, $query, $data, $operation)
{
    $query_run = $con->prepare($query);
    $query_execute = $query_run->execute($data);

    if ($query_execute) {
        $_SESSION['message'] = "$operation Successfully";
    } else {
        $_SESSION['message'] = "Not $operation";
    }

    header('Location: index.php');
    exit(0);
}

if (isset($_POST['save_student_btn'])) {

    $query = "INSERT INTO students (fullname, email, phone, course) VALUES (:fullname, :email, :phone, :course)";
    $data = [
        ':fullname' => $_POST['fullname'],
        ':email' => $_POST['email'],
        ':phone' => $_POST['phone'],
        ':course' => $_POST['course'],
    ];
    executeCrudOperation($con, $query, $data, "Inserted");
} elseif (isset($_POST['update_student_btn'])) {

    $query = "UPDATE students SET fullname=:fullname, email=:email, phone=:phone, course=:course WHERE id=:id LIMIT 1";
    $data = [
        ':fullname' => $_POST['fullname'],
        ':email' => $_POST['email'],
        ':phone' => $_POST['phone'],
        ':course' => $_POST['course'],
        ':id' => $_POST['student_id'],
    ];
    executeCrudOperation($con, $query, $data, "Edited");
} elseif (isset($_POST['delete_student'])) {

    $query = "DELETE FROM students WHERE id=:id LIMIT 1";
    $data = [
        ':id' => $_POST['delete_student']
    ];
    executeCrudOperation($con, $query, $data, "Deleted");
}
