<?php
// Database connection
include 'db.php';

$search = '';
$filterAnimal = '';
$filterSex = '';
$filterBarangay = '';
$filterPlace = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    $filterAnimal = $_POST['filterAnimal'];
    $filterSex = $_POST['filterSex'];
    $filterBarangay = $_POST['filterBarangay'];
    $filterPlace = $_POST['filterPlace'];

    $sql = "SELECT * FROM PatientRecord WHERE (PatientID LIKE '%$search%' OR PatientName LIKE '%$search%')";

    if ($filterAnimal) {
        $sql .= " AND Animal = '$filterAnimal'";
    }
    if ($filterSex) {
        $sql .= " AND Sex = '$filterSex'";
    }
    if ($filterBarangay) {
        $sql .= " AND Barangay = '$filterBarangay'";
    }
    if ($filterPlace) {
        $sql .= " AND Place = '$filterPlace'";
    }
} else {
    $sql = "SELECT * FROM PatientRecord";
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
        <h2>Patient Records</h2>
        <button onclick="location.href='logout.php'">Logout</button>
        <button onclick="location.href='PatientRegistration.php'">Patient Registration</button>
        <button onclick="location.href='PatientRecord.php'">Patient Record</button>
        <button onclick="location.href='index.php'">Dynamic Chart</button>
        <button onclick="location.href='VaccinationRecord.php'">Vaccination Records</button>
    </div>
    <div class="main-content">
        <!-- Main content area -->
        <form method="POST" action="PatientRecord.php">
            <div class="filter-container">
                <input type="text" name="search" placeholder="Search by Patient ID or Name" value="<?php echo htmlspecialchars($search); ?>">
                
                <select id="filterAnimal" name="filterAnimal">
                    <option value="">Filter by Animal</option>
                    <option value="Dog" <?php if ($filterAnimal == 'Dog') echo 'selected'; ?>>Dog</option>
                    <option value="Cat" <?php if ($filterAnimal == 'Cat') echo 'selected'; ?>>Cat</option>
                    <option value="Hamster" <?php if ($filterAnimal == 'Hamster') echo 'selected'; ?>>Hamster</option>
                    <option value="Rabbit" <?php if ($filterAnimal == 'Rabbit') echo 'selected'; ?>>Rabbit</option>
                    <option value="Turtle" <?php if ($filterAnimal == 'Turtle') echo 'selected'; ?>>Turtle</option>
                    <option value="Lizard" <?php if ($filterAnimal == 'Lizard') echo 'selected'; ?>>Lizard</option>
                    <option value="Fish" <?php if ($filterAnimal == 'Fish') echo 'selected'; ?>>Fish</option>
                    <option value="Bird" <?php if ($filterAnimal == 'Bird') echo 'selected'; ?>>Bird</option>
                    <option value="Mouse" <?php if ($filterAnimal == 'Mouse') echo 'selected'; ?>>Mouse</option>
                    <option value="Pig" <?php if ($filterAnimal == 'Pig') echo 'selected'; ?>>Pig</option>
                    <option value="Monkey" <?php if ($filterAnimal == 'Monkey') echo 'selected'; ?>>Monkey</option>
                    <option value="Others" <?php if ($filterAnimal == 'Others') echo 'selected'; ?>>Others</option>
                </select>

                <select id="filterSex" name="filterSex">
                    <option value="">Filter by Sex</option>
                    <option value="Male" <?php if ($filterSex == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($filterSex == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($filterSex == 'Other') echo 'selected'; ?>>Other</option>
                </select>

<select id="filterBarangay" name="filterBarangay">
    <option value="">Filter by Barangay</option>
    <option value="Anos" <?php if ($filterBarangay == 'Anos') echo 'selected'; ?>>Anos</option>
    <option value="Bagong Silang" <?php if ($filterBarangay == 'Bagong Silang') echo 'selected'; ?>>Bagong Silang</option>
    <option value="Bambang" <?php if ($filterBarangay == 'Bambang') echo 'selected'; ?>>Bambang</option>
    <option value="Batong Malake" <?php if ($filterBarangay == 'Batong Malake') echo 'selected'; ?>>Batong Malake</option>
    <option value="Baybayin" <?php if ($filterBarangay == 'Baybayin') echo 'selected'; ?>>Baybayin</option>
    <option value="Bayog" <?php if ($filterBarangay == 'Bayog') echo 'selected'; ?>>Bayog</option>
    <option value="Lalakay" <?php if ($filterBarangay == 'Lalakay') echo 'selected'; ?>>Lalakay</option>
    <option value="Maahas" <?php if ($filterBarangay == 'Maahas') echo 'selected'; ?>>Maahas</option>
    <option value="Malinta" <?php if ($filterBarangay == 'Malinta') echo 'selected'; ?>>Malinta</option>
    <option value="Mayondon" <?php if ($filterBarangay == 'Mayondon') echo 'selected'; ?>>Mayondon</option>
    <option value="San Antonio" <?php if ($filterBarangay == 'San Antonio') echo 'selected'; ?>>San Antonio</option>
    <option value="Tadlac" <?php if ($filterBarangay == 'Tadlac') echo 'selected'; ?>>Tadlac</option>
    <option value="Timugan" <?php if ($filterBarangay == 'Timugan') echo 'selected'; ?>>Timugan</option>
    <option value="Putho-Tuntungin" <?php if ($filterBarangay == 'Putho-Tuntungin') echo 'selected'; ?>>Putho-Tuntungin</option>
</select>


                <select id="filterPlace" name="filterPlace">
                    <option value="">Filter by Place</option>
                    <option value="Indoor" <?php if ($filterPlace == 'Indoor') echo 'selected'; ?>>Indoor</option>
                    <option value="Outdoor" <?php if ($filterPlace == 'Outdoor') echo 'selected'; ?>>Outdoor</option>
                </select>

                <button type="submit">Search</button>
                <button type="button" onclick="window.location.href='PatientRecord.php'">Clear Filters</button>
            </div>
        </form>
        <div class="chart-placeholder">
            <!-- Placeholder for patient record table -->
            <div class="table-container">
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
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['PatientID']}</td>
                                        <td>{$row['PatientName']}</td>
                                        <td>{$row['Age']}</td>
                                        <td>{$row['Sex']}</td>
                                        <td>{$row['ExposureDate']}</td>
                                        <td>{$row['Barangay']}</td>
                                        <td>{$row['Place']}</td>
                                        <td>{$row['Animal']}</td>
                                        <td>{$row['ExposureType']}</td>
                                        <td>{$row['BiteSite']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
