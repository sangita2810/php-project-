<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <link href="style1.css" rel="stylesheet" type="text/css" />
    <title>Search Students</title>
</head>
<body>
<div class="sample">
    <form action="" method="POST">
        <label for="search">Search by Name:</label>
        <input type="text" name="search" id="search" placeholder="Enter name">
        <button class="btn search" type="submit" name="submit">Search</button>
        
        <a class="btn clear" href="index.php">Back</a>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        require_once("db.php"); // Include your database connection code here

      
        $searchTerm = $_POST["search"];

        
        $stmt = $conn->prepare("SELECT * FROM students WHERE name LIKE ?");
        $searchTerm = '%' . $searchTerm . '%'; // Add wildcards for partial matching
        $stmt->bind_param("s", $searchTerm);

        
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Display search results in a table
            echo "<h2>Search Results:</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Gender</th><th>Email</th><th>Department</th><th>Address</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            
            echo "No matching records found.";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</div>
</body>
</html>
