<?php
include_once "DbConnect.php"; // Include the database connection file
$db = new DbConnect();
$conn = $db->connect();

// Check if 'dno' is set in the URL
if (isset($_GET['dno'])) {
    // Get department number from URL and sanitize it
    $dno = intval($_GET['dno']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT lname, salary FROM EMPLOYEE WHERE dno = ?");
    $stmt->execute([$dno]);

    // Fetch all employees in the given department
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if any employees were found
    if ($employees) {
        echo '<h4 class="mt-4">Employees in Department ' . htmlspecialchars($dno) . '</h4>';
        
        // Display table with Bootstrap classes
        echo '<table class="table table-striped table-bordered mt-3">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">Last Name</th>
                        <th scope="col">Salary</th>
                    </tr>
                </thead>
                <tbody>';

        // Loop through employees and display their last name and salary
        foreach ($employees as $emp) {
            echo '<tr>
                    <td>' . htmlspecialchars($emp['lname']) . '</td>
                    <td>$' . number_format(htmlspecialchars($emp['salary']), 2) . '</td>
                  </tr>';
        }

        echo '  </tbody>
              </table>';
    } else {
        echo '<h4 class="text-warning">No employees found in Department ' . htmlspecialchars($dno) . '.</h4>';
    }
} else {
    echo '<h4 class="text-danger">No department number provided. Please specify a department number.</h4>';
}
?>
