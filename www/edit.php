<?php
    include "db_conn.php";

    // ดึงข้อมูลเดิมมาแสดงในฟอร์ม
    $id = $_GET['id'];
    $sql = "SELECT * FROM `crud_681310303` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // เมื่อกด Save ให้ UPDATE ข้อมูล (ไม่ใช่ INSERT)
    if(isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

        $sql = "UPDATE `crud_681310303` SET `first_name`='$first_name', `last_name`='$last_name', `email`='$email', `gender`='$gender' WHERE id=$id";

        $result = mysqli_query($conn, $sql);
        if($result) {
            header("Location: index.php?msg=Data updated successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Application</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-4" style="background-color: #1e90ff; color: white;">
        PHP CRUD Application
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>
        
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="mb-3">
                    <label class="form-label">First name</label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Last name</label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Gender:</label> &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo $row['gender'] == 'male' ? "checked" : ""; ?>>
                    <label for="male" class="form-input-label">Male</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo $row['gender'] == 'female' ? "checked" : ""; ?>>
                    <label for="female" class="form-input-label">Female</label>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>