<?php
// Database connection
include 'db.php';

$search = '';
$filterSex = '';
$filterBarangay = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    $filterSex = $_POST['filterSex'];
    $filterBarangay = $_POST['filterBarangay'];

    $sql = "SELECT Patient_ID, Name, Age, Sex, Birth_Date, Barangay, Contact, Medical_Condition 
            FROM PatientRecord1 
            WHERE (Patient_ID LIKE '%$search%' OR Name LIKE '%$search%')";

    if ($filterSex) {
        $sql .= " AND Sex = '$filterSex'";
    }
    if ($filterBarangay) {
        $sql .= " AND Barangay = '$filterBarangay'";
    }
} else {
    $sql = "SELECT Patient_ID, Name, Age, Sex, Birth_Date, Barangay, Contact, Medical_Condition FROM PatientRecord1";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Record</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            /* Set the display and font for the body */
            display: flex;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }
        .main-content {
            margin-left: 300px;
            padding: 20px;
            width: calc(100% - 300px); /* Adjust width to fit with sidebar */
            margin-top: 20px; /* Adjust main content to account for sidebar */
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
        }
        .table-container {
            /* Style for the table container */
            width: 100%;
            height: 500px;
            overflow-y: auto;
            position: relative;
        }
        table {
            /* Ensure table fits within the container */
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
            margin-top: 0; /* Remove margin for branch header */
        }
        .sidebar button {
            background-color: #237854; /* Updated button color */
            color: white;
        }
        .sidebar button:hover {
            background-color: #1e6a48; /* Slightly darker shade for hover */
        }
        .sidebar button.active {
            background-color: #1e6a48; /* Same as hover to indicate active state */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar content -->
        <h2>ABC-1</h2>
        <button onclick="location.href='dashboard.php'">Dashboard</button>
        <button class="active" onclick="location.href='PatientRecord1.php'">Patient Record</button> <!-- Active button -->
        <button onclick="location.href='PatientRegistration.php'">Patient Registration</button>
        <button onclick="location.href='VaccinationRecord.php'">Vaccination Records</button>
        <button onclick="location.href='index.php'">Dynamic Chart</button>
        <button onclick="location.href='report.php'">Generate Report</button>
        <button onclick="location.href='logout.php'">Logout</button>
    </div>
    <div class="main-content">
        <!-- Main content area -->
        <form method="POST" action="PatientRecord1.php">
            <div class="filter-container">
                <input type="text" name="search" placeholder="Search by Patient ID or Name" value="<?php echo htmlspecialchars($search); ?>">

                <select id="filterSex" name="filterSex">
                    <option value="">Filter by Sex</option>
                    <option value="Male" <?php if ($filterSex == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($filterSex == 'Female') echo 'selected'; ?>>Female</option>
                </select>

                <select id="filterBarangay" name="filterBarangay">
                    <option value="">Filter by Barangay</option>
                    <option value="Atisan" <?php if ($filterBarangay == 'Atisan') echo 'selected'; ?>>Atisan</option>
                    <option value="Bagong Bayan II-A" <?php if ($filterBarangay == 'Bagong Bayan II-A') echo 'selected'; ?>>Bagong Bayan II-A</option>
                    <option value="Bagong Pook VI-C" <?php if ($filterBarangay == 'Bagong Pook VI-C') echo 'selected'; ?>>Bagong Pook VI-C</option>
                    <option value="Barangay I-A" <?php if ($filterBarangay == 'Barangay I-A') echo 'selected'; ?>>Barangay I-A</option>
                    <option value="Barangay I-B" <?php if ($filterBarangay == 'Barangay I-B') echo 'selected'; ?>>Barangay I-B</option>
                    <option value="Barangay II-A" <?php if ($filterBarangay == 'Barangay II-A') echo 'selected'; ?>>Barangay II-A</option>
                    <option value="Barangay II-B" <?php if ($filterBarangay == 'Barangay II-B') echo 'selected'; ?>>Barangay II-B</option>
                    <option value="Barangay II-C" <?php if ($filterBarangay == 'Barangay II-C') echo 'selected'; ?>>Barangay II-C</option>
                    <option value="Barangay II-D" <?php if ($filterBarangay == 'Barangay II-D') echo 'selected'; ?>>Barangay II-D</option>
                    <option value="Barangay II-E" <?php if ($filterBarangay == 'Barangay II-E') echo 'selected'; ?>>Barangay II-E</option>
                    <option value="Barangay II-F" <?php if ($filterBarangay == 'Barangay II-F') echo 'selected'; ?>>Barangay II-F</option>
                    <option value="Barangay III-A" <?php if ($filterBarangay == 'Barangay III-A') echo 'selected'; ?>>Barangay III-A</option>
                    <option value="Barangay III-B" <?php if ($filterBarangay == 'Barangay III-B') echo 'selected'; ?>>Barangay III-B</option>
                    <option value="Barangay III-C" <?php if ($filterBarangay == 'Barangay III-C') echo 'selected'; ?>>Barangay III-C</option>
                    <option value="Barangay III-D" <?php if ($filterBarangay == 'Barangay III-D') echo 'selected'; ?>>Barangay III-D</option>
                    <option value="Barangay III-E" <?php if ($filterBarangay == 'Barangay III-E') echo 'selected'; ?>>Barangay III-E</option>
                    <option value="Barangay III-F" <?php if ($filterBarangay == 'Barangay III-F') echo 'selected'; ?>>Barangay III-F</option>
                    <option value="Barangay IV-A" <?php if ($filterBarangay == 'Barangay IV-A') echo 'selected'; ?>>Barangay IV-A</option>
                    <option value="Barangay IV-B" <?php if ($filterBarangay == 'Barangay IV-B') echo 'selected'; ?>>Barangay IV-B</option>
                    <option value="Barangay IV-C" <?php if ($filterBarangay == 'Barangay IV-C') echo 'selected'; ?>>Barangay IV-C</option>
                    <option value="Barangay V-A" <?php if ($filterBarangay == 'Barangay V-A') echo 'selected'; ?>>Barangay V-A</option>
                    <option value="Barangay V-B" <?php if ($filterBarangay == 'Barangay V-B') echo 'selected'; ?>>Barangay V-B</option>
                    <option value="Barangay V-C" <?php if ($filterBarangay == 'Barangay V-C') echo 'selected'; ?>>Barangay V-C</option>
                    <option value="Barangay V-D" <?php if ($filterBarangay == 'Barangay V-D') echo 'selected'; ?>>Barangay V-D</option>
                    <option value="Barangay VI-A" <?php if ($filterBarangay == 'Barangay VI-A') echo 'selected'; ?>>Barangay VI-A</option>
                    <option value="Barangay VI-B" <?php if ($filterBarangay == 'Barangay VI-B') echo 'selected'; ?>>Barangay VI-B</option>
                    <option value="Barangay VI-D" <?php if ($filterBarangay == 'Barangay VI-D') echo 'selected'; ?>>Barangay VI-D</option>
                    <option value="Barangay VI-E" <?php if ($filterBarangay == 'Barangay VI-E') echo 'selected'; ?>>Barangay VI-E</option>
                    <option value="Barangay VII-A" <?php if ($filterBarangay == 'Barangay VII-A') echo 'selected'; ?>>Barangay VII-A</option>
                    <option value="Barangay VII-B" <?php if ($filterBarangay == 'Barangay VII-B') echo 'selected'; ?>>Barangay VII-B</option>
                    <option value="Barangay VII-C" <?php if ($filterBarangay == 'Barangay VII-C') echo 'selected'; ?>>Barangay VII-C</option>
                    <option value="Barangay VII-D" <?php if ($filterBarangay == 'Barangay VII-D') echo 'selected'; ?>>Barangay VII-D</option>
                    <option value="Barangay VII-E" <?php if ($filterBarangay == 'Barangay VII-E') echo 'selected'; ?>>Barangay VII-E</option>
                    <option value="Bautista" <?php if ($filterBarangay == 'Bautista') echo 'selected'; ?>>Bautista</option>
                    <option value="Concepcion" <?php if ($filterBarangay == 'Concepcion') echo 'selected'; ?>>Concepcion</option>
                    <option value="Del Remedio" <?php if ($filterBarangay == 'Del Remedio') echo 'selected'; ?>>Del Remedio</option>
                    <option value="Dolores" <?php if ($filterBarangay == 'Dolores') echo 'selected'; ?>>Dolores</option>
                    <option value="San Antonio 1" <?php if ($filterBarangay == 'San Antonio 1') echo 'selected'; ?>>San Antonio 1</option>
                    <option value="San Antonio 2" <?php if ($filterBarangay == 'San Antonio 2') echo 'selected'; ?>>San Antonio 2</option>
                    <option value="San Bartolome" <?php if ($filterBarangay == 'San Bartolome') echo 'selected'; ?>>San Bartolome</option>
                    <option value="San Buenaventura" <?php if ($filterBarangay == 'San Buenaventura') echo 'selected'; ?>>San Buenaventura</option>
                    <option value="San Crispin" <?php if ($filterBarangay == 'San Crispin') echo 'selected'; ?>>San Crispin</option>
                    <option value="San Cristobal" <?php if ($filterBarangay == 'San Cristobal') echo 'selected'; ?>>San Cristobal</option>
                    <option value="San Diego" <?php if ($filterBarangay == 'San Diego') echo 'selected'; ?>>San Diego</option>
                    <option value="San Francisco" <?php if ($filterBarangay == 'San Francisco') echo 'selected'; ?>>San Francisco</option>
                    <option value="San Gabriel" <?php if ($filterBarangay == 'San Gabriel') echo 'selected'; ?>>San Gabriel</option>
                    <option value="San Gregorio" <?php if ($filterBarangay == 'San Gregorio') echo 'selected'; ?>>San Gregorio</option>
                    <option value="San Ignacio" <?php if ($filterBarangay == 'San Ignacio') echo 'selected'; ?>>San Ignacio</option>
                    <option value="San Isidro" <?php if ($filterBarangay == 'San Isidro') echo 'selected'; ?>>San Isidro</option>
                    <option value="San Joaquin" <?php if ($filterBarangay == 'San Joaquin') echo 'selected'; ?>>San Joaquin</option>
                    <option value="San Jose" <?php if ($filterBarangay == 'San Jose') echo 'selected'; ?>>San Jose</option>
                    <option value="San Juan" <?php if ($filterBarangay == 'San Juan') echo 'selected'; ?>>San Juan</option>
                    <option value="San Lorenzo" <?php if ($filterBarangay == 'San Lorenzo') echo 'selected'; ?>>San Lorenzo</option>
                    <option value="San Lucas 1" <?php if ($filterBarangay == 'San Lucas 1') echo 'selected'; ?>>San Lucas 1</option>
                    <option value="San Lucas 2" <?php if ($filterBarangay == 'San Lucas 2') echo 'selected'; ?>>San Lucas 2</option>
                    <option value="San Marcos" <?php if ($filterBarangay == 'San Marcos') echo 'selected'; ?>>San Marcos</option>
                    <option value="San Mateo" <?php if ($filterBarangay == 'San Mateo') echo 'selected'; ?>>San Mateo</option>
                    <option value="San Miguel" <?php if ($filterBarangay == 'San Miguel') echo 'selected'; ?>>San Miguel</option>
                    <option value="San Nicolas" <?php if ($filterBarangay == 'San Nicolas') echo 'selected'; ?>>San Nicolas</option>
                    <option value="San Pedro" <?php if ($filterBarangay == 'San Pedro') echo 'selected'; ?>>San Pedro</option>
                    <option value="San Rafael" <?php if ($filterBarangay == 'San Rafael') echo 'selected'; ?>>San Rafael</option>
                    <option value="San Roque" <?php if ($filterBarangay == 'San Roque') echo 'selected'; ?>>San Roque</option>
                    <option value="San Vicente" <?php if ($filterBarangay == 'San Vicente') echo 'selected'; ?>>San Vicente</option>
                    <option value="Santa Ana" <?php if ($filterBarangay == 'Santa Ana') echo 'selected'; ?>>Santa Ana</option>
                    <option value="Santa Catalina" <?php if ($filterBarangay == 'Santa Catalina') echo 'selected'; ?>>Santa Catalina</option>
                    <option value="Santa Cruz" <?php if ($filterBarangay == 'Santa Cruz') echo 'selected'; ?>>Santa Cruz</option>
                    <option value="Santa Felomina" <?php if ($filterBarangay == 'Santa Felomina') echo 'selected'; ?>>Santa Felomina</option>
                    <option value="Santa Isabel" <?php if ($filterBarangay == 'Santa Isabel') echo 'selected'; ?>>Santa Isabel</option>
                    <option value="Santa Maria Magdalena" <?php if ($filterBarangay == 'Santa Maria Magdalena') echo 'selected'; ?>>Santa Maria Magdalena</option>
                    <option value="Santa Veronica" <?php if ($filterBarangay == 'Santa Veronica') echo 'selected'; ?>>Santa Veronica</option>
                    <option value="Santiago I" <?php if ($filterBarangay == 'Santiago I') echo 'selected'; ?>>Santiago I</option>
                    <option value="Santiago II" <?php if ($filterBarangay == 'Santiago II') echo 'selected'; ?>>Santiago II</option>
                    <option value="Santisimo Rosario" <?php if ($filterBarangay == 'Santisimo Rosario') echo 'selected'; ?>>Santisimo Rosario</option>
                    <option value="Santo Angel" <?php if ($filterBarangay == 'Santo Angel') echo 'selected'; ?>>Santo Angel</option>
                    <option value="Santo Cristo" <?php if ($filterBarangay == 'Santo Cristo') echo 'selected'; ?>>Santo Cristo</option>
                    <option value="Santo Niño" <?php if ($filterBarangay == 'Santo Niño') echo 'selected'; ?>>Santo Niño</option>
                    <option value="Soledad" <?php if ($filterBarangay == 'Soledad') echo 'selected'; ?>>Soledad</option>
                    <option value="Santa Elena" <?php if ($filterBarangay == 'Santa Elena') echo 'selected'; ?>>Santa Elena</option>
                    <option value="Santa Maria" <?php if ($filterBarangay == 'Santa Maria') echo 'selected'; ?>>Santa Maria</option>
                    <option value="Santa Monica" <?php if ($filterBarangay == 'Santa Monica') echo 'selected'; ?>>Santa Monica</option>
                </select>

                <button type="submit">Search</button>
                <button type="button" onclick="window.location.href='PatientRecord1.php'">Clear Filters</button>
            </div>
        </form>
        <div class="chart-placeholder">
            <!-- Placeholder for patient record table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Birth Date</th>
                            <th>Barangay</th>
                            <th>Contact</th>
                            <th>Medical Condition</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $medicalCondition = isset($row['Medical_Condition']) ? $row['Medical_Condition'] : 'None';
                                echo "<tr>
                                        <td>{$row['Patient_ID']}</td>
                                        <td>{$row['Name']}</td>
                                        <td>{$row['Age']}</td>
                                        <td>{$row['Sex']}</td>
                                        <td>{$row['Birth_Date']}</td>
                                        <td>{$row['Barangay']}</td>
                                        <td>{$row['Contact']}</td>
                                        <td>{$medicalCondition}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>