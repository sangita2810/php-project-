<!DOCTYPE html>
<html>
<head>
   <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Add Student</title>
</head>
<body>
<div class="sample">
    <h1>Add Student Record</h1>

    <?php
    require_once("db.php"); // Include your database connection code here

    $successMessage = "";
    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
        // Handle the form submission for adding a new record
       // $id = $_POST["id"];
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $department = $_POST["department"];
        $address = $_POST["address"];

       // Function to check if the name contains only alphabetic characters
        function isValidName($name) {
            return ctype_alpha(str_replace(' ', '', $name));
        }

        // Function to check if the email contains the "@" sign
        function isValidEmail($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        // Check if the name is valid
        if (!isValidName($name)) {
           // $errorMessage = "Name should contain only alphabetic characters.";
            echo '<script>alert("Name should contain only alphabetic characters.")</script>';
        }
        // Check if the email is valid
        elseif (!isValidEmail($email)) {
           // $errorMessage = "Email should contain the '@' sign.";
            echo '<script>alert( "Email should contain the (@) sign.")</script>';
        } else {
            // SQL query to insert data into the database
            $sql = "INSERT INTO students (name, gender, email, department, address) VALUES ('$name', '$gender', '$email', '$department', '$address')";
            $result = $conn->query($sql);

            if ($result) {
                $successMessage = "Successfully Saved";
                 echo '<script>alert("Student record added successfully!")</script>';
                 echo "<script>window.location.href = 'view.php'</script>";
            } else {
                $errorMessage = "Error adding student record: " . $stmt->error;
            }
        }
    }
    ?>
    

    <form action="" method="POST">
        <table>
          <!--  <tr>
                <td class="input-container"><input type="text" name="id" placeholder="ID"></td>
            </tr> -->
            <tr>
                <td class="input-container"><input type="text" name="name" placeholder="Full Name" required></td>
            </tr>
            <tr>
                <td class="input-container">
                    <select class="form-control" name="gender">
                        <option value="select">Select Gender</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="input-container"><input type="text" name="email" placeholder="Email" required></td>
            </tr>
            <tr>
                <td class="input-container">
                    <select class="" name="department">
                        <option value="select">Select Department</option>
                        <option value="Bengali">Bengali</option>
                        <option value="English">English</option>
                        <option value="Math">Math</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Science">Science</option>
                         <option value="Sanskrit">Sanskrit</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="input-container"><textarea id="address" name="address" placeholder="Address" required></textarea></td>
            </tr>
        </table>
        <div class="btn-container">
             <a href="search.php" class="btn search">Search</a>
            <button class="btn save" name="submit" type="submit">Save</button>
            <a class="btn clear" href="index.php">Back</a>
            <a href="view.php" class="btn view">View</a>


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
