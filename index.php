<?php
session_start();
include("dbcon.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>PHP PDO CRUD</title>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

                <?php if (isset($_SESSION['message'])) : ?>
                    <h5 class="alert alert-success"><?= $_SESSION['message']; ?></h5>
                <?php
                    unset($_SESSION['message']);
                endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h3>
                            PHP PDO CRUD
                            <a href="student-add.php" class="btn btn-primary float-end">Add Student</a>
                        </h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>FullName</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM students";
                                $getStudents = $con->prepare($query);
                                $getStudents->execute();

                                $students = $getStudents->fetchAll(PDO::FETCH_OBJ);

                                if ($students) {
                                    foreach ($students as $student) {

                                ?>
                                        <tr>
                                            <td><?= $student->id ?></td>
                                            <td><?= $student->fullname ?></td>
                                            <td><?= $student->email ?></td>
                                            <td><?= $student->phone ?></td>
                                            <td><?= $student->course ?></td>
                                            <td>
                                                <a href="student-edit.php?id=<?= $student->id ?>" class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="code.php" method="POST">
                                                    <button type="submit" name="delete_student" value="<?= $student->id ?>" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7">No Students Found</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>