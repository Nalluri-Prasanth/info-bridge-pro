<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Department Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php
// Database connection parameters
include_once "DbConnect.php";
$db = new DbConnect();
$conn = $db->connect();

// Get department number from the URL
$dno = isset($_GET['dnumber']) ? intval($_GET['dnumber']) : null;

if ($dno) {
    // Query for department details
    $query = "SELECT dname, mgrssn, mgrstartdate, lname, fname 
              FROM DEPARTMENT d 
              JOIN EMPLOYEE e ON d.mgrssn = e.ssn 
              WHERE d.dnumber = :dno";
    $stmt = $conn->prepare($query);
    $stmt->execute([':dno' => $dno]);

    // Fetch department details
    if ($department = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="container mt-5">';
        echo '  <div class="row justify-content-center">';
        echo '    <div class="col-md-6">';
        echo '      <div class="card mb-4 text-center">';
        echo '        <div class="card-body">';
        echo '          <h5 class="card-title">Department: ' . htmlspecialchars($department['dname']) . '</h5>';
        echo '          <h6 class="card-subtitle mb-2 text-muted">Manager: <a href="empView.php?ssn=' . htmlspecialchars($department['mgrssn']) . '">' . htmlspecialchars($department['lname']) . ', ' . htmlspecialchars($department['fname']) . '</a></h6>';
        echo '          <p class="card-text">Manager Start Date: ' . htmlspecialchars($department['mgrstartdate']) . '</p>';
        
        // Query for department locations
        $query = "SELECT dlocation FROM DEPT_LOCATIONS WHERE dnumber = :dno";
        $stmt = $conn->prepare($query);
        $stmt->execute([':dno' => $dno]);

        echo '<h6 class="mt-3">Department Locations:</h6>';
        $locations = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if ($locations) {
            foreach ($locations as $dloc) {
                echo '<span class="badge bg-primary me-1">' . htmlspecialchars($dloc) . '</span>';
            }
        } else {
            echo "<p>No locations found for this department.</p>";
        }
        echo '        </div>';
        echo '      </div>';
        echo '    </div>';
        echo '  </div>';

        // Query for employees in the department
        $query = "SELECT ssn, lname, fname FROM EMPLOYEE WHERE dno = :dno";
        $stmt = $conn->prepare($query);
        $stmt->execute([':dno' => $dno]);

        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<div class="container mt-4">';
        echo '<h4 class="text-center">Employees</h4>';
        if ($employees) {
            echo '<table class="table table-striped table-bordered">';
            echo '  <thead class="table-warning">';
            echo '    <tr><th>Employee SSN</th><th>Last Name</th><th>First Name</th></tr>';
            echo '  </thead>';
            echo '  <tbody>';
            foreach ($employees as $emp) {
                echo '<tr>';
                echo '  <td><a href="empView.php?ssn=' . htmlspecialchars($emp['ssn']) . '">' . htmlspecialchars($emp['ssn']) . '</a></td>';
                echo '  <td>' . htmlspecialchars($emp['lname']) . '</td>';
                echo '  <td>' . htmlspecialchars($emp['fname']) . '</td>';
                echo '</tr>';
            }
            echo '  </tbody>';
            echo '</table>';
        } else {
            echo "<p class='text-center'>No employees found in this department.</p>";
        }
        echo '</div>';

        // Query for projects in the department
        $query = "SELECT pnumber, pname, plocation FROM PROJECT WHERE dnum = :dno";
        $stmt = $conn->prepare($query);
        $stmt->execute([':dno' => $dno]);

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<div class="container mt-4">';
        echo '<h4 class="text-center">Projects</h4>';
        if ($projects) {
            echo '<table class="table table-striped table-bordered">';
            echo '  <thead class="table-warning">';
            echo '    <tr><th>Project Number</th><th>Project Name</th><th>Location</th></tr>';
            echo '  </thead>';
            echo '  <tbody>';
            foreach ($projects as $proj) {
                echo '<tr>';
                echo '  <td><a href="projView.php?pnumber=' . htmlspecialchars($proj['pnumber']) . '">' . htmlspecialchars($proj['pnumber']) . '</a></td>';
                echo '  <td>' . htmlspecialchars($proj['pname']) . '</td>';
                echo '  <td>' . htmlspecialchars($proj['plocation']) . '</td>';
                echo '</tr>';
            }
            echo '  </tbody>';
            echo '</table>';
        } else {
            echo "<p class='text-center'>No projects found for this department.</p>";
        }
        echo '</div>';
        
    } else {
        echo "<p class='text-center'>Department not found.</p>";
    }
} else {
    echo "<p class='text-center'>No department number specified.</p>";
}

// Close the database connection
$conn = null;
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
