<?php
include 'db.php';

// Fetch data for the report
$sql = "SELECT * FROM PatientRecord";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching report data: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .report-container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #237854;
            color: white;
        }
        .print-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            background-color: #237854;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-button:hover {
            background-color: #1e6a48;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <h1>Patient Records Report</h1>
        <table>
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Exposure Date</th>
                    <th>Barangay</th>
                    <th>Place</th>
                    <th>Animal</th>
                    <th>Exposure Type</th>
                    <th>Bite Site</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['PatientID']) . "</td>
                                <td>" . htmlspecialchars($row['PatientName']) . "</td>
                                <td>" . htmlspecialchars($row['Age']) . "</td>
                                <td>" . htmlspecialchars($row['Sex']) . "</td>
                                <td>" . htmlspecialchars($row['ExposureDate']) . "</td>
                                <td>" . htmlspecialchars($row['Barangay']) . "</td>
                                <td>" . htmlspecialchars($row['Place']) . "</td>
                                <td>" . htmlspecialchars($row['Animal']) . "</td>
                                <td>" . htmlspecialchars($row['ExposureType']) . "</td>
                                <td>" . htmlspecialchars($row['BiteSite']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button class="print-button" onclick="window.print()">Print Report</button>
        <button class="print-button" onclick="location.href='index.php'">Back to Dashboard</button> <!-- Added back button -->
    </div>
</body>
</html>
