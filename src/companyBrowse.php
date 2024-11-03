<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Departments</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Department List</h2>
<?php
// Database connection parameters
include_once "DbConnect.php";
$db = new DbConnect();
$conn = $db->connect();

// Query for all departments, ordered by department number in ascending order
$query = "SELECT dnumber, dname FROM DEPARTMENT ORDER BY dnumber ASC";
$stmt = $conn->prepare($query);
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($departments) {
    echo '<table class="table table-striped table-bordered">';
    echo '<thead class="table-warning">';
    echo '<tr><th>Department Number</th><th>Department Name</th></tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($departments as $dept) {
        echo '<tr>';
        echo '<td><a href="departmentDetails.php?dnumber=' . htmlspecialchars($dept['dnumber']) . '">' . htmlspecialchars($dept['dnumber']) . '</a></td>';
        echo '<td>' . htmlspecialchars($dept['dname']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No departments found.</p>';
}

// Close the database connection
$conn = null;
?>

</body>
</html>
