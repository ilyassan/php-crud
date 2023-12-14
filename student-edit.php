<?php
include('dbcon.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Update data into database using PHP PDO</title>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-4">


                <div class="card">
                    <div class="card-header">
                        <h3>
                            Update data into database using PHP PDO
                            <a href="index.php" class="btn btn-danger float-end">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $student_id = $_GET["id"];

                            $query = "SELECT * FROM students WHERE id =:std_id LIMIT 1";
                            $getStudentData = $con->prepare($query);
                            $data = [":std_id" => $student_id];
                            $getStudentData->execute($data);

                            $result = $getStudentData->fetch(PDO::FETCH_OBJ);
                        }
                        ?>

                        <form action="code.php" method="POST">
                            <input type="hidden" name="student_id" value="<?= $student_id ?>">
                            <div class="mb-3">
                                <label>Full Name</label>
                                <input type="text" name="fullname" value="<?= $result->fullname ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="<?= $result->email ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="number" name="phone" value="<?= $result->phone ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Course</label>
                                <input type="text" name="course" value="<?= $result->course ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_student_btn" class="btn btn-primary">Save Student</button>
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>