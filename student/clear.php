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

    if (isset($_POST['clear'])) {
        require_once("db.php");
       // $id = $_POST['id'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $address = $_POST['address'];

        // SQL query to insert data into the database
        $sql = "INSERT INTO students ( name, gender, email, department, address) VALUES ('$id', '$name', '$gender', '$email', '$department', '$address')";
        $result = $conn->query($sql);

        if ($result) {
            $successMessage = "Successfully Saved";
        } else {
            $errorMessage = "Failure!";
        }
    }

    // Check if the "Clear" button is clicked
    if (isset($_POST['clear'])) {
        // Clear all form fields by setting their values to an empty string
        $id = $name = $gender = $email = $department = $address = "";
    }
    ?>

    <form action="" method="POST">
        <table>
          <!--  <tr>
                <td class="input-container"><input type="text" name="id" placeholder="ID" value="<?php echo isset($id) ? $id : ''; ?>"></td>
            </tr> -->
            <tr>
                <td class="input-container"><input type="text" name="name" placeholder="Full Name" required value="<?php echo isset($name) ? $name : ''; ?>"></td>
            </tr>
            <tr>
                <td class="input-container">
                    <select class="form-control" name="gender">
                        <option value="select">Select Gender</option>
                        <option value="Female" <?php echo (isset($gender) && $gender === 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Male" <?php echo (isset($gender) && $gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="input-container"><input type="text" name="email" placeholder="Email" required value="<?php echo isset($email) ? $email : ''; ?>"></td>
            </tr>
            <tr>
                <td class="input-container">
                    <select class="" name="department">
                        <option value="select">Select Department</option>
                        <option value="Bengali" <?php echo (isset($department) && $department === 'Bengali') ? 'selected' : ''; ?>>Bengali</option>
                        <option value="English" <?php echo (isset($department) && $department === 'English') ? 'selected' : ''; ?>>English</option>
                        <option value="Math" <?php echo (isset($department) && $department === 'Math') ? 'selected' : ''; ?>>Math</option>
                        <option value="Hindi" <?php echo (isset($department) && $department === 'Hindi') ? 'selected' : ''; ?>>Hindi</option>
                        <option value="Science" <?php echo (isset($department) && $department === 'Science') ? 'selected' : ''; ?>>Science</option>
                        <option value="Sanskrit" <?php echo (isset($_POST['department']) && $_POST['department'] === 'Sanskrit') ? 'selected' : ''; ?>>Sanskrit</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="input-container"><textarea id="address" name="address" placeholder="Address" required><?php echo isset($address) ? $address : ''; ?></textarea></td>
            </tr>
        </table>
        <div class="btn-container">
           <!-- <button class="btn search" name="search"><a href="search.php"></a> Search</button>-->
            <a href="search.php" class="btn search">Search</a>

            <button class="btn save" name="submit" type="submit">Save</button>

           <!-- <button class="btn update" name="update"><a href="update.php"></a>Update</button>-->
           <a href="add.php" class="btn update">Add New</a>


            <!--<button class="btn delete" name="delete"><a href="delete.php"></a>Delete</button>-->
            <!--<a href="delete.php" class="btn delete">delete</a>-->
            
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
