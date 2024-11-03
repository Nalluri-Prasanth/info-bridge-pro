<?php
include_once "DbConnect.php";
$db = new DbConnect();
$conn = $db->connect();

// Check if dnumber is set in the URL
if (!isset($_GET['dnumber'])) {
    echo "Department number not provided.";
    exit; // Stop further execution
}

// Get department number from URL
$dno = $_GET['dnumber'];

// Query for department and manager details
$stmt = $conn->prepare("SELECT dname, mgrssn, mgrstartdate, lname, fname FROM DEPARTMENT, EMPLOYEE WHERE dnumber = ? AND mgrssn = ssn");
$stmt->execute([$dno]);
$deptInfo = $stmt->fetch(PDO::FETCH_ASSOC);

// Display department and manager details
if ($deptInfo) {
    echo '<div class="d-flex justify-content-center mt-5">'; // Center horizontally and add top margin
    echo '  <div class="card" style="width: 18rem;">'; // Adjust the width for a square-like shape
    echo '    <div class="card-body text-center">'; // Center text in the card
    echo '      <h5 class="card-title">Department: ' . htmlspecialchars($deptInfo['dname']) . '</h5>';
    echo '      <h6 class="card-subtitle mb-2 text-body-secondary">Manager: ' . htmlspecialchars($deptInfo['fname']) . ' ' . htmlspecialchars($deptInfo['lname']) . '</h6>';
    echo '      <p class="card-text">Manager Start Date: ' . htmlspecialchars($deptInfo['mgrstartdate']) . '</p>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
} else {
    echo "<p>Department not found.</p>";
}
?>
