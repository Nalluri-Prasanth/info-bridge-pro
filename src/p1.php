<?php
include_once "DbConnect.php";
$db = new DbConnect();
$conn = $db->connect();

// Retrieve SSNs from employee table
$stmt = $conn->prepare("SELECT ssn FROM EMPLOYEE");
$stmt->execute();
$ssns = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h4 class="text-center">Employee Details for:</h4>
<div class="d-flex justify-content-center">
    <form method="post" action="?page=empdir" class="d-flex align-items-center">
        <div class="dropdown me-2">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Select Employee SSN
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php foreach ($ssns as $row): ?>
                    <li>
                        <a class="dropdown-item" href="#" onclick="selectSSN('<?php echo htmlspecialchars($row['ssn']); ?>');">
                            <?php echo htmlspecialchars($row['ssn']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Hidden input to hold the selected SSN -->
        <input type="hidden" name="ssn" id="selectedSsn">
        
        <button type="submit" class="btn btn-warning">Get Employee Details</button>
    </form>
</div>

<script>
// JavaScript function to update dropdown button text and hidden input
function selectSSN(ssn) {
    document.getElementById('dropdownMenuButton').innerText = ssn;
    document.getElementById('selectedSsn').value = ssn;
}
</script>
