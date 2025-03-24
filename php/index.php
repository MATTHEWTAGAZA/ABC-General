<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Chart</title>
    <link rel="stylesheet" href="../css/style.css">
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
        .chart-placeholder {
            /* Style for the chart placeholder */
            width: 100%;
            height: 500px;
            background-color: #ecf0f1;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #bdc3c7;
            position: relative;
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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css">
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar content -->
        <h2>Dynamic Chart</h2>
        <button onclick="location.href='logout.php'">Logout</button>
        <button onclick="location.href='PatientRegistration.php'">Patient Registration</button>
        <button onclick="location.href='PatientRecord.php'">Patient Record</button>
        <button onclick="location.href='index.php'">Dynamic Chart</button>
        <button onclick="location.href='VaccinationRecord.php'">Vaccination Records</button>
    </div>
    <div class="main-content">
        <!-- Main content area -->
        <h1>Dynamic Chart</h1>
        <form id="filterForm">
            <div class="filter-container">
                <input type="text" id="dateRange" placeholder="Select Date Range">
                <select id="chartType">
                    <option value="bar">Bar</option>
                    <option value="line">Line</option>
                    <option value="pie">Pie</option>
                </select>
                <button type="button" onclick="updateChart('Barangay')">Barangay</button>
                <button type="button" onclick="updateChart('Animal')">Animal</button>
                <button type="button" onclick="updateChart('ExposureType')">Exposure Type</button>
                <button type="button" onclick="updateChart('BiteSite')">Bite Site</button>
                <button type="button" onclick="resetFilters()">Reset Filters</button> <!-- Added reset button -->
            </div>
        </form>
        <div class="chart-placeholder" id="chartContainer">
            <!-- Placeholder for dynamic chart -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#dateRange", {
                mode: "range",
                dateFormat: "Y-m-d"
            });
        });

        async function fetchData(filterType) {
            const response = await fetch(`fetchData.php?filterType=${filterType}`);
            const data = await response.json();
            return data;
        }

        async function updateChart(filterType) {
            const chartContainer = document.getElementById('chartContainer');
            const data = await fetchData(filterType);
            const chartType = document.getElementById('chartType').value;

            // Clear previous chart
            chartContainer.innerHTML = '<canvas id="chartCanvas"></canvas>';
            const ctx = document.getElementById('chartCanvas').getContext('2d');

            new Chart(ctx, {
                type: chartType, // Use selected chart type
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        function resetFilters() {
            document.getElementById('filterForm').reset();
            document.getElementById('chartContainer').innerHTML = '<div class="chart-placeholder" id="chartContainer"></div>';
        }
    </script>
</body>
</html>
