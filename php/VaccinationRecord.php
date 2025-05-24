<?php
// Database connection
include 'db.php';

// Fetch vaccination records from the vaccination_records table
$sql = "SELECT patient_id, exposure_category, rig_received, doses_received, vaccination_status, last_dose_date FROM vaccination_records";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching vaccination records: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Records</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            background-color: #d4efdb; /* Updated background color */
        }
        .main-content {
            margin-left: 300px;
            padding: 20px;
            width: calc(100% - 250px);
            margin-top: 20px;
        }
        .table-container {
            width: 100%;
            height: 500px;
            overflow-y: auto;
            position: relative;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            position: sticky;
            top: 0;
            background-color: #f0f2f5;
            z-index: 1;
        }
        table, th, td {
            border: 1px solid #bdc3c7;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .sidebar {
            background-color: #237854; /* Updated sidebar color */
            color: white;
        }
        .sidebar button {
            background-color: #237854; /* Updated button color */
            color: white;
        }
        .sidebar button:hover {
            background-color: #1e6a48; /* Slightly darker shade for hover */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar content -->
        <h2>Vaccination Records</h2>
        <button onclick="location.href='dashboard.php'">Dashboard</button> <!-- Dashboard button at the top -->
        <button onclick="location.href='PatientRecord.php'">Patient Record</button>
        <button onclick="location.href='PatientRegistration.php'">Patient Registration</button>
        <button onclick="location.href='VaccinationRecord.php'">Vaccination Records</button>
        <button onclick="location.href='index.php'">Dynamic Chart</button>
        <button onclick="location.href='report.php'">Generate Report</button>
        <button onclick="location.href='logout.php'">Logout</button>
    </div>
    <div class="main-content">
        <h2>Vaccination Records</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Exposure Category</th>
                        <th>RIG Received</th>
                        <th>Doses Received</th>
                        <th>Vaccination Status</th>
                        <th>Last Dose Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['patient_id']) . "</td>
                                    <td>" . htmlspecialchars($row['exposure_category']) . "</td>
                                    <td>" . htmlspecialchars($row['rig_received']) . "</td>
                                    <td>" . htmlspecialchars($row['doses_received']) . "</td>
                                    <td>" . htmlspecialchars($row['vaccination_status']) . "</td>
                                    <td>" . htmlspecialchars($row['last_dose_date']) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No vaccination records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
