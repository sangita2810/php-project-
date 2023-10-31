
<!DOCTYPE html>
<html>
<head>
   <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Student</title>
</head>
<body>
<div class="sample">
    <?php
    $successMessage = "";
    $errorMessage = "";

    if (isset($_POST['submit'])) {
        require_once("db.php");
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $address = $_POST['address'];

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
          //  $errorMessage = "Email should contain the '@' sign.";
            echo '<script>alert( "Email should contain the (@) sign.")</script>';

        } else {
            // SQL query to insert data into the database
            $sql = "INSERT INTO students (name, gender, email, department, address) VALUES ('$name', '$gender', '$email', '$department', '$address')";
            $result = $conn->query($sql);

            if ($result) {
                $successMessage = "Successfully Saved";
            } else {
                $errorMessage = "Failure!";
            }
        }
    }
    ?>

    

       

    <form action="" method="POST">
        <table>
          <!-- <tr>
                <td class="input-container"><input type="text" name="id" placeholder="ID" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>"></td>
            </tr>-->
            <tr>
                <td class="input-container"><input type="text" name="name" placeholder="Full Name" required value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"></td>
            </tr>
            <tr>
                <td class="input-container">
                    <select class="form-control" name="gender">
                        <option value="select">Select Gender</option>
                        <option value="F" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'F') ? 'selected' : ''; ?>>Female</option>
                        <option value="M" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'M') ? 'selected' : ''; ?>>Male</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="input-container"><input type="text" name="email" placeholder="Email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"></td>
            </tr>
            <tr>
                <td class="input-container">
                    <select class="" name="department">
                        <option value="select">Select Department</option>
                        <option value="Bengali" <?php echo (isset($_POST['department']) && $_POST['department'] === 'Bengali') ? 'selected' : ''; ?>>Bengali</option>
                        <option value="English" <?php echo (isset($_POST['department']) && $_POST['department'] === 'English') ? 'selected' : ''; ?>>English</option>
                        <option value="Math" <?php echo (isset($_POST['department']) && $_POST['department'] === 'Math') ? 'selected' : ''; ?>>Math</option>
                        <option value="Hindi" <?php echo (isset($_POST['department']) && $_POST['department'] === 'Hindi') ? 'selected' : ''; ?>>Hindi</option>
                        <option value="Science" <?php echo (isset($_POST['department']) && $_POST['department'] === 'Science') ? 'selected' : ''; ?>>Science</option>
                        <option value="Sanskrit" <?php echo (isset($_POST['department']) && $_POST['department'] === 'Sanskrit') ? 'selected' : ''; ?>>Sanskrit</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="input-container"><textarea id="address" name="address" placeholder="Address" required><?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?></textarea></td>
            </tr>
        </table>
        <div class="btn-container">
           <!-- <button class="btn search" name="search"><a href="search.php"></a> Search</button>-->
            <a href="search.php" class="btn search">Search</a>

            <button class="btn save" name="submit" type="submit">Save</button>

           <!-- <button class="btn update" name="update"><a href="update.php"></a>Update</button>-->
           <a href="add.php" class="btn update">Add New</a>


            <!--<button class="btn delete" name="delete"><a href="delete.php"></a>Delete</button>-->
           <!-- <a href="delete.php" class="btn delete">delete</a>-->
            
           <!-- <button class="btn clear" name="clear">Clear</button>-->
             <a href="clear.php" class="btn clear">Clear</a>
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
