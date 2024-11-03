<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php
            // Database connection parameters
            include_once "DbConnect.php";
            $db = new DbConnect();
            $conn = $db->connect();

            // Get SSN from the URL
            $ssn = isset($_GET['ssn']) ? intval($_GET['ssn']) : null;

            if ($ssn) {
                // Query for employee details, including createdAt and updatedAt fields
                $query = "SELECT ssn, fname, minit, lname, bdate, address, sex, salary, superssn, dno, createdAt, updatedAt 
                          FROM EMPLOYEE WHERE ssn = :ssn";
                $stmt = $conn->prepare($query);
                $stmt->execute([':ssn' => $ssn]);

                // Fetch employee details
                if ($employee = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="card mb-4">';
                    echo '  <div class="card-body">';
                    echo '    <h5 class="card-title">Employee: ' . htmlspecialchars($employee['fname']) . ' ' . htmlspecialchars($employee['minit']) . ' ' . htmlspecialchars($employee['lname']) . '</h5>';
                    echo '    <p class="card-text"><b>SSN:</b> ' . htmlspecialchars($employee['ssn']) . '</p>';
                    echo '    <p class="card-text"><b>Date of Birth:</b> ' . htmlspecialchars($employee['bdate']) . '</p>';
                    echo '    <p class="card-text"><b>Address:</b> ' . htmlspecialchars($employee['address']) . '</p>';
                    echo '    <p class="card-text"><b>Sex:</b> ' . htmlspecialchars($employee['sex']) . '</p>';
                    echo '    <p class="card-text"><b>Salary:</b> $' . htmlspecialchars(number_format($employee['salary'], 2)) . '</p>';
                    echo '    <p class="card-text"><b>Supervisor SSN:</b> ' . htmlspecialchars($employee['superssn']) . '</p>';
                    echo '    <p class="card-text"><b>Department Number:</b> ' . htmlspecialchars($employee['dno']) . '</p>';
                    echo '    <p class="card-text"><b>Joined At:</b> ' . htmlspecialchars($employee['createdAt']) . '</p>';
                    echo '    <p class="card-text"><b>Last Promoted:</b> ' . htmlspecialchars($employee['updatedAt']) . '</p>';
                    echo '  </div>';
                    echo '</div>';
                } else {
                    echo "<p class='text-center'>Employee not found.</p>";
                }
            } else {
                echo "<p class='text-center'>No SSN specified.</p>";
            }

            // Close the database connection
            $conn = null;
            ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
