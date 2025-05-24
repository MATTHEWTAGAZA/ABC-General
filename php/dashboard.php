<?php
include 'db.php'; // Ensure db.php contains a valid $conn connection

// Fetch patient counts for each table
$patientCounts = [
    'ABC-1' => 0,
    'ABC-2' => 0,
    'ABC-3' => 0,
];

if ($conn) {
    $queries = [
        'ABC-1' => "SELECT COUNT(*) AS count FROM PatientRecord1",
        'ABC-2' => "SELECT COUNT(*) AS count FROM PatientRecord2",
        'ABC-3' => "SELECT COUNT(*) AS count FROM PatientRecord3",
    ];

    foreach ($queries as $label => $query) {
        $result = mysqli_query($conn, $query);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $patientCounts[$label] = (int)$row['count'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            /* Set the display and font for the body */
            display: flex;
            font-family: Arial, sans-serif;
            background-color: #d4efdb; /* Updated background color */
        }
        .main-content {
            /* Style for the main content area */
            margin-left: 300px;
            padding: 20px;
            width: calc(100% - 250px);
            margin-top: 20px; /* Add margin to the top */
        }
       
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        .filter-container input, .filter-container select {
            flex: 1;
            min-width: 150px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .filter-container button {
            flex: 1;
            min-width: 100px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #237854; /* Updated filter button color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .filter-container button:hover {
            background-color: #1e6a48; /* Slightly darker shade for hover */
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
        
        .main-content {
            /* Style for the main content area */
            margin-left: 300px;
            padding: 20px;
            width: calc(100% - 250px);
            margin-top: 20px; /* Add margin to the top */
        }
        .dashboard-section {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ecf0f1;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .dashboard-section h2 {
            margin-bottom: 10px;
            color: #237854;
        }
        .dashboard-section p {
            font-size: 14px;
            color: #555;
        }
        .stats-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .stat-box {
            flex: 1;
            min-width: 200px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .stat-box h3 {
            margin: 0;
            font-size: 24px;
            color: #237854;
        }
        .stat-box p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }
        .chart-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar content -->
        <h2>Dashboard</h2>
        <button onclick="location.href='dashboard.php'">Dashboard</button> <!-- Dashboard button at the top -->
        <button onclick="location.href='PatientRecord.php'">Patient Record</button>
        <button onclick="location.href='PatientRegistration.php'">Patient Registration</button>
        <button onclick="location.href='VaccinationRecord.php'">Vaccination Records</button>
        <button onclick="location.href='index.php'">Dynamic Chart</button>
        <button onclick="location.href='report.php'">Generate Report</button>
        <button onclick="location.href='logout.php'">Logout</button>
    </div>
    <div class="main-content">
        <!-- Main content area -->
        <h1>Anti-Rabies Vaccination Dashboard</h1>
        <div class="stats-container">
            <div class="stat-box">
                <h3>1,234</h3>
                <p>Total Vaccinations</p>
            </div>
            <div class="stat-box">
                <h3>567</h3>
                <p>Active Patients</p>
            </div>
            <div class="stat-box">
                <h3>89%</h3>
                <p>Vaccination Coverage</p>
            </div>
        </div>
        <div class="dashboard-section">
            <h2>Recent Vaccinations</h2>
            <p>Displays the most recent vaccination records.</p>
            <table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Vaccine Type</th>
                        <th>Barangay</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ensure the database connection is valid
                    if ($conn) {
                        // Suppress errors and handle them gracefully
                        $query = "
                            SELECT 
                                pr.patient_name AS PatientName,
                                pr.barangay AS Barangay,
                                vr.ExposureDate AS VaccinationDate,
                                vr.Exposure_category AS VaccineType
                            FROM 
                                Vaccination_records vr
                            INNER JOIN 
                                patientrecord pr
                            ON 
                                vr.Patient_id = pr.patientid
                            ORDER BY 
                                vr.ExposureDate DESC
                            LIMIT 5";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($row['PatientName']) . "</td>
                                        <td>" . htmlspecialchars($row['VaccinationDate']) . "</td>
                                        <td>" . htmlspecialchars($row['VaccineType']) . "</td>
                                        <td>" . htmlspecialchars($row['Barangay']) . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No recent records found.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Unable to connect to the database. Please try again later.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="dashboard-section">
            <h2>Patient Records Overview</h2>
            <div class="chart-container">
                <canvas id="patientChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('patientChart').getContext('2d');
        const patientChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['ABC-1', 'ABC-2', 'ABC-3'], // Labels for the datasets
                datasets: [{
                    label: 'Patient Counts',
                    data: [<?php echo $patientCounts['ABC-1']; ?>, <?php echo $patientCounts['ABC-2']; ?>, <?php echo $patientCounts['ABC-3']; ?>],
                    borderColor: '#237854',
                    backgroundColor: 'rgba(35, 120, 84, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Branches'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Patients'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>