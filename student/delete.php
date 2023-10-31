<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Delete Student</title>
</head>
<body>
<div class="sample">
    <h1>Delete Student Record</h1>

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
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
        // Handle the form submission for deleting the record
        $id = $_POST["id"];

        // Prepare a DELETE statement
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
           $successMessage = "Student record deleted successfully!";
            echo '<script>alert("Student record deleted successfully")</script>';
            echo "<script>window.location.href = 'view.php'</script>";
        } else {
            $errorMessage = "Error deleting student record: " . $stmt->error;
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
                <td class="input-container"><input type="text" name="name" value="<?php echo isset($row["name"]) ? $row["name"] : ''; ?>" readonly></td>
            </tr>
            <tr>
                <td class="input-container"><input type="text" name="gender" value="<?php echo isset($row["gender"]) ? $row["gender"] : ''; ?>" readonly></td>
            </tr>
            <tr>
                <td class="input-container"><input type="text" name="email" value="<?php echo isset($row["email"]) ? $row["email"] : ''; ?>" readonly></td>
            </tr>
            <tr>
                <td class="input-container"><input type="text" name="department" value="<?php echo isset($row["department"]) ? $row["department"] : ''; ?>" readonly></td>
            </tr>
            <tr>
                <td class="input-container"><textarea id="address" name="address" readonly><?php echo isset($row["address"]) ? $row["address"] : ''; ?></textarea></td>
            </tr>
        </table>
        <div class="btn-container">
            <button class="btn delete" name="delete" type="submit">Delete Record</button>
            <a class="btn clear" href="clear.php">Clear</a>
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
