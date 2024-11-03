<?php
include_once "DbConnect.php";
$db = new DbConnect();
$conn = $db->connect();

// Retrieve SSN from form
$ssn = $_POST['ssn'];

// Retrieve all employee details, including createdAt and updatedAt, for the selected SSN
$stmt = $conn->prepare("SELECT fname, minit, lname, sex, address, salary, bdate, dno, createdAt, updatedAt FROM EMPLOYEE WHERE ssn = ?");
$stmt->execute([$ssn]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

// Display employee information if available
if ($employee) {
    echo '<div class="d-flex justify-content-center mt-4">';
    echo '  <div class="card" style="width: 18rem;">';
    echo '    <div class="card-body">';
    echo '      <h5 class="card-title">' . htmlspecialchars($employee['fname']) . ' ' . htmlspecialchars($employee['minit']) . ' ' . htmlspecialchars($employee['lname']) . '</h5>';
    echo '      <h6 class="card-subtitle mb-2 text-body-secondary">Sex: ' . htmlspecialchars($employee['sex']) . '</h6>';
    echo '      <p class="card-text">Address: ' . htmlspecialchars($employee['address']) . '</p>';
    echo '      <p class="card-text">Birth Date: ' . htmlspecialchars($employee['bdate']) . '</p>';
    echo '      <p class="card-text">Department Number: ' . htmlspecialchars($employee['dno']) . '</p>';
    echo '      <p class="card-text"><b>Joined On:</b> ' . htmlspecialchars($employee['createdAt']) . '</p>';
    echo '      <p class="card-text"><b>Last Promoted:</b> ' . htmlspecialchars($employee['updatedAt']) . '</p>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';

} else {
    echo "<p class='text-center'>Employee not found.</p>";
}
?>
