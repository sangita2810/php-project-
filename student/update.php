<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Update Student</title>
</head>
<body>
<div class="sample">
    <h1>Update Student Record</h1>

    <?php
    require_once("db.php"); // Include your database connection code here

    $successMessage = "";
    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
        // Fetch the student record based on the provided ID
        $id = $_GET["id"];
        $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
        } else {
            // No record found with the given ID
            echo "No student record found with the provided ID.";
            exit;
        }

        $stmt->close();
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
        // Handle the form submission for updating the record
        $id = $_POST["id"];
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $department = $_POST["department"];
        $address = $_POST["address"];

        // Prepare an UPDATE statement
        $stmt = $conn->prepare("UPDATE students SET name = ?, gender = ?, email = ?, department = ?, address = ? WHERE id = ?");
        $stmt->bind_param("ssssss", $name, $gender, $email, $department, $address, $id);

        if ($stmt->execute()) {
            $successMessage = "Student record updated successfully!";
            echo '<script>alert("Student record updated successfully")</script>';
            echo "<script>window.location.href = 'view.php'</script>";
        } else {
            $errorMessage = "Error updating student record: " . $stmt->error;
        }

        $stmt->close();
    }
    ?>

    <form action="" method="POST">
        <table>
            <tr>
                <td class="input-container"><input type="text" name="id" value="<?php echo isset($row["id"]) ? $row["id"] : ''; ?>" readonly></td>
            </tr>
            <tr>
                <td class="input-container"><input type="text" name="name" placeholder="Full Name" required value="<?php echo isset($row["name"]) ? $row["name"] : ''; ?>"></td>
            </tr>
            <tr>
                <td class="input-container">
                    <select class="form-control" name="gender">
                        <option value="select">Select Gender</option>
                        <option value="F" <?php echo (isset($row["gender"]) && $row["gender"] === 'F') ? 'selected' : ''; ?>>Female</option>
                        <option value="M" <?php echo (isset($row["gender"]) && $row["gender"] === 'M') ? 'selected' : ''; ?>>Male</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="input-container"><input type="text" name="email" placeholder="Email" required value="<?php echo isset($row["email"]) ? $row["email"] : ''; ?>"></td>
            </tr>
            <tr>
                <td class="input-container">
                    <select class="" name="department">
                        <option value="select">Select Department</option>
                        <option value="Bengali" <?php echo (isset($row["department"]) && $row["department"] === 'Bengali') ? 'selected' : ''; ?>>Bengali</option>
                        <option value="English" <?php echo (isset($row["department"]) && $row["department"] === 'English') ? 'selected' : ''; ?>>English</option>
                        <option value="Math" <?php echo (isset($row["department"]) && $row["department"] === 'Math') ? 'selected' : ''; ?>>Math</option>
                        <option value="Hindi" <?php echo (isset($row["department"]) && $row["department"] === 'Hindi') ? 'selected' : ''; ?>>Hindi</option>
                        <option value="Science" <?php echo (isset($row["department"]) && $row["department"] === 'Science') ? 'selected' : ''; ?>>Science</option>
                        <option value="Sanskrit" <?php echo (isset($_POST['department']) && $_POST['department'] === 'Sanskrit') ? 'selected' : ''; ?>>Sanskrit</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="input-container"><textarea id="address" name="address" placeholder="Address" required><?php echo isset($row["address"]) ? $row["address"] : ''; ?></textarea></td>
            </tr>
        </table>
        <div class="btn-container">
            <button class="btn save" name="submit" type="submit">Save Changes</button>
            <a href="clear.php" class="btn clear">Back</a>
        </div>
    </form>
    
    <?php
    if (!empty($successMessage)) {
        echo "<div class='success-message'>$successMessage</div>";
    }
    
    if (!empty($errorMessage)) {
        echo "<div class='error-message'>$errorMessage</div>";
    }
    ?>
</div>
</body>
</html>
