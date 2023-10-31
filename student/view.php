<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <style type="text/css">
        body {
    font-family: Arial, sans-serif;
    background-color: green;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    
    color: #fff;
    padding: 20px;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}
.btn-container {
    text-align: center;
    margin-top: 20px;
}

.btn {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px;
    text-align: center;
    text-decoration: none;
    font-size: 15px;
    margin: 2px;
    cursor: pointer;
    border-radius: 4px;
    text-align: center;
}

.save {
    background-color: #4CAF50;
}

.clear {
    background-color: #2196F3;
}

.update {
    background-color: #ff9800;
}

.delete {
    background-color: #f44336;
}

.search {
    background-color: gray;
    color: white;
}
.view {
    background-color: orangered;
}
.action-links a {
            margin-right: 10px; 
            text-decoration: none;
            color: #333;
            font-size: 18px;
        }

        /* Icon styles */
        .action-links a i {
            margin-right: 5px;
        }
    </style>

<body>
<div class="sample">
    <h1>Student Records</h1>

    <?php
    require_once("db.php"); // Include your database connection code here

    // Prepare a SELECT statement to fetch all student records
    $stmt = $conn->prepare("SELECT * FROM students");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Display student records in a table
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Gender</th><th>Email</th><th>Department</th><th>Address</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td class='action-links'>";
            
            echo "<a href='update.php?id=" . $row["id"] . "'><i class='fas fa-edit'></i>Update</a>";
            echo "<a href='delete.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt'></i>Delete</a>";
             echo "<a href='index.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt'></i>Back</a>";
            
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        // No records found
        echo "No student records found.";
    }

    $stmt->close();
    $conn->close();
    ?>
</div>
</body>
</html>
