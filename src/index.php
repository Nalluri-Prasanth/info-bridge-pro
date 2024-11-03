<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Bridge Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">

    <style>
        /* Background Gradient */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #e0efda, #cde9dd); /* Soft gradient background */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Navbar and Footer */
        header, footer {
            background: linear-gradient(to right, #bbe1e2, #a2dae7); /* Soft blue gradient */
            color: black;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: black;
            margin: 0 15px;
            text-decoration: none;
            font-weight: 500;
        }
        nav a:hover {
            text-decoration: underline;
        }
        /* Content Styling */
        .content {
            flex: 1;
            margin: 20px;
        }
        footer {
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>INFO BRIDGE PRO</h1>
    <nav>
        <a href="?page=empdir"><i class="bi bi-person-rolodex"></i> Employee Directory</a>
        <a href="?page=deptoverview"><i class="bi bi-person-video2"></i> Department Overview</a>
        <a href="?page=empsalary"><i class="bi bi-person-vcard"></i> Employee Salaries by Department</a>
        <a href="?page=deptbrowse"><i class="bi bi-search"></i> Browse Departments</a>
    </nav>
</header>

<div class="content">
    <?php
    include_once "DbConnect.php";
    $db = new DbConnect();
    $conn = $db->connect();

    $page = isset($_GET['page']) ? $_GET['page'] : 'empdir';
    switch ($page) {
        case 'empdir':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include "p1post.php";
            } else {
                include "p1.php";
            }
            break;

        case 'deptoverview':
            if (isset($_GET['dnumber'])) {
                include "deptView.php";
            } else {
                echo '<div class="text-center mb-4">';
                echo '    <h2>Department Overview</h2>';
                echo '    <form method="GET" action="" class="d-flex justify-content-center align-items-center">';
                echo '        <input type="hidden" name="page" value="deptoverview">';
                echo '        <label for="dnumber" class="me-2">Enter Department Number:</label>';
                echo '        <input type="number" name="dnumber" class="form-control form-control-sm me-2" placeholder="Department #" style="width: auto;" required>';
                echo '        <button type="submit" class="btn btn-warning btn-sm">View Department</button>';
                echo '    </form>';
                echo '</div>';
            }
            break;

        case 'empsalary':
            if (isset($_GET['dno'])) {
                include "empdept.php";
            } else {
                echo '<div class="text-center mb-4">';
                echo '    <h2>Employee Salaries by Department</h2>';
                echo '    <form method="GET" action="" class="d-flex justify-content-center align-items-center">';
                echo '        <input type="hidden" name="page" value="empsalary">';
                echo '        <label for="dno" class="me-2">Enter Department Number:</label>';
                echo '        <input type="number" name="dno" class="form-control form-control-sm me-2" placeholder="Department #" style="width: auto;" required>';
                echo '        <button type="submit" class="btn btn-warning btn-sm">View Employees</button>';
                echo '    </form>';
                echo '</div>';
            }
            break;

        case 'deptbrowse':
            include "companyBrowse.php";
            break;

        default:
            echo "<h2>Page Not Found</h2><p>The page you're looking for doesn't exist.</p>";
    }
    ?>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Info Bridge Pro</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
