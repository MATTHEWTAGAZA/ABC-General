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
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        .dropdown-content button {
            background-color: #237854; /* Updated button color */
            color: white;
            padding: 10px;
            border: none;
            text-align: left;
            width: 100%;
            cursor: pointer;
        }
        .dropdown-content button:hover {
            background-color: #1e6a48; /* Slightly darker shade for hover */
        }
        .dropdown:hover .dropdown-content {
            display: block;
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
        <p id="dateRangeDisplay" style="font-size: 16px; font-weight: bold; margin-bottom: 20px;">Date Range: </p> <!-- Added date range display -->
        <form id="filterForm">
            <div class="filter-container">
                <input type="text" id="dateRange" placeholder="Select Date Range">
                <select id="chartType">
                    <option value="bar">Bar</option>
                    <option value="line">Line</option>
                    <option value="pie">Pie</option>
                </select>
                <div class="dropdown">
                    <button type="button">Filters</button>
                    <div class="dropdown-content">
                        <button type="button" onclick="updateChart('Barangay')">Barangay</button>
                        <button type="button" onclick="updateChart('Animal')">Animal</button>
                        <button type="button" onclick="updateChart('ExposureType')">Exposure Type</button>
                        <button type="button" onclick="updateChart('BiteSite')">Bite Site</button>
                    </div>
                </div>
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
            const today = new Date();
            const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            const formattedFirstDay = firstDayOfMonth.toISOString().split('T')[0];
            const formattedToday = today.toISOString().split('T')[0];

            const dateRangeInput = flatpickr("#dateRange", {
                mode: "range",
                dateFormat: "Y-m-d",
                defaultDate: [formattedFirstDay, formattedToday], // Set default range
                onChange: function(selectedDates) {
                    updateDateRangeDisplay(selectedDates); // Update the date range display
                }
            });

            // Set default chart type and filter on startup
            const defaultChartType = document.getElementById('chartType');
            defaultChartType.value = 'bar'; // Set default to Bar chart
            updateDateRangeDisplay([firstDayOfMonth, today]); // Initialize date range display
            updateChart('Barangay'); // Default filter by Barangay
        });

        function updateDateRangeDisplay(selectedDates) {
            const dateRangeDisplay = document.getElementById('dateRangeDisplay');
            if (selectedDates.length === 2) {
                const options = { month: 'long', day: 'numeric', year: 'numeric' };
                const startDate = selectedDates[0].toLocaleDateString('en-US', options);
                const endDate = selectedDates[1].toLocaleDateString('en-US', options);

                // Format the date range as "Month Day, Year - Month Day, Year"
                dateRangeDisplay.textContent = `Date Range: ${startDate} - ${endDate}`;
            } else {
                dateRangeDisplay.textContent = 'Date Range: ';
            }
        }

        async function fetchData(filterType) {
            const response = await fetch(`fetchData.php?filterType=${filterType}`);
            const data = await response.json();

            // Remove undefined labels or values
            if (data.labels && data.datasets) {
                data.labels = data.labels.filter(label => label !== undefined && label !== null);
                data.datasets.forEach((dataset, index) => {
                    dataset.data = dataset.data.filter(value => value !== undefined && value !== null);

                    // Assign up to 17 unique colors with shades or variants to each dataset
                    const colorPalette = [
                        '#1B2631', '#2874A6', '#1ABC9C', '#F39C12', '#8E44AD',
                        '#C0392B', '#2ECC71', '#D35400', '#34495E', '#7D3C98',
                        '#5D6D7E', '#117A65', '#9A7D0A', '#6C3483', '#922B21',
                        '#196F3D', '#7E5109'
                    ];
                    const shadeVariants = [
                        'rgba(27, 38, 49, 0.8)', 'rgba(40, 116, 166, 0.8)', 'rgba(26, 188, 156, 0.8)',
                        'rgba(243, 156, 18, 0.8)', 'rgba(142, 68, 173, 0.8)', 'rgba(192, 57, 43, 0.8)',
                        'rgba(46, 204, 113, 0.8)', 'rgba(211, 84, 0, 0.8)', 'rgba(52, 73, 94, 0.8)',
                        'rgba(42, 203, 215, 0.95)', 'rgba(93, 109, 126, 0.8)', 'rgba(17, 122, 101, 0.8)',
                        'rgba(184, 242, 206, 0.8)', 'rgb(245, 245, 32)', 'rgba(146, 43, 33, 0.8)',
                        'rgba(25, 111, 61, 0.8)', 'rgba(126, 81, 9, 0.8)'
                    ];

                    // If the dataset has multiple data points, assign a unique color or shade for each data point
                    if (Array.isArray(dataset.data)) {
                        dataset.backgroundColor = dataset.data.map((_, i) => shadeVariants[i % shadeVariants.length]);
                        dataset.borderColor = dataset.data.map((_, i) => colorPalette[i % colorPalette.length]);
                    } else {
                        // For single data points, assign a single color
                        dataset.backgroundColor = shadeVariants[index % shadeVariants.length];
                        dataset.borderColor = colorPalette[index % colorPalette.length];
                    }

                    dataset.borderWidth = 1;
                });
            }

            return data;
        }

        async function updateChart(filterType) {
            const chartContainer = document.getElementById('chartContainer');
            const data = await fetchData(filterType);
            const chartType = document.getElementById('chartType').value; // Use selected chart type

            // Clear previous chart
            chartContainer.innerHTML = '<canvas id="chartCanvas"></canvas>';
            const ctx = document.getElementById('chartCanvas').getContext('2d');

            new Chart(ctx, {
                type: chartType, // Use selected chart type
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true, // Show legend
                            labels: {
                                filter: function(legendItem, chartData) {
                                    // Remove undefined labels from the legend
                                    return legendItem.text !== undefined && legendItem.text !== null;
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    // Format tooltip labels to be more realistic
                                    const value = context.raw || 0;
                                    return `${context.label}: ${value}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Categories' // Add a title for the x-axis
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Values' // Add a title for the y-axis
                            },
                            beginAtZero: true // Ensure the y-axis starts at zero
                        }
                    }
                }
            });
        }

        function resetFilters() {
            document.getElementById('filterForm').reset();
            document.getElementById('chartContainer').innerHTML = '<div class="chart-placeholder" id="chartContainer"></div>';
            document.getElementById('dateRangeDisplay').textContent = 'Date Range: '; // Reset date range display
        }
    </script>
</body>
</html>
