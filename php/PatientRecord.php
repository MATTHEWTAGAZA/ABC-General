<?php
// Database connection
include 'db.php';

$search = '';
$filterAnimal = '';
$filterSex = '';
$filterBaranggay = '';
$filterPlace = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    $filterAnimal = $_POST['filterAnimal'];
    $filterSex = $_POST['filterSex'];
    $filterBaranggay = $_POST['filterBaranggay'];
    $filterPlace = $_POST['filterPlace'];

    $sql = "SELECT * FROM PatientRecord WHERE (PatientID LIKE '%$search%' OR PatientName LIKE '%$search%')";

    if ($filterAnimal) {
        $sql .= " AND Animal = '$filterAnimal'";
    }
    if ($filterSex) {
        $sql .= " AND Sex = '$filterSex'";
    }
    if ($filterBaranggay) {
        $sql .= " AND Baranggay = '$filterBaranggay'";
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
            background-color: #f0f2f5;
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
            background-color: rgb(88, 2, 94);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .filter-container button:hover {
            background-color: rgba(88, 2, 94, 0.9);
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

                <select id="filterBaranggay" name="filterBaranggay">
                    <option value="">Filter by Baranggay</option>
                    <option value="Balayhangin" <?php if ($filterBaranggay == 'Balayhangin') echo 'selected'; ?>>Balayhangin</option>
                    <option value="Bangyas" <?php if ($filterBaranggay == 'Bangyas') echo 'selected'; ?>>Bangyas</option>
                    <option value="Dayap" <?php if ($filterBaranggay == 'Dayap') echo 'selected'; ?>>Dayap</option>
                    <option value="Hanggan" <?php if ($filterBaranggay == 'Hanggan') echo 'selected'; ?>>Hanggan</option>
                    <option value="Imok" <?php if ($filterBaranggay == 'Imok') echo 'selected'; ?>>Imok</option>
                    <option value="Lamot I" <?php if ($filterBaranggay == 'Lamot I') echo 'selected'; ?>>Lamot I</option>
                    <option value="Lamot II" <?php if ($filterBaranggay == 'Lamot II') echo 'selected'; ?>>Lamot II</option>
                    <option value="Limao" <?php if ($filterBaranggay == 'Limao') echo 'selected'; ?>>Limao</option>
                    <option value="Mabacan" <?php if ($filterBaranggay == 'Mabacan') echo 'selected'; ?>>Mabacan</option>
                    <option value="Masiit" <?php if ($filterBaranggay == 'Masiit') echo 'selected'; ?>>Masiit</option>
                    <option value="Paliparan" <?php if ($filterBaranggay == 'Paliparan') echo 'selected'; ?>>Paliparan</option>
                    <option value="Perez" <?php if ($filterBaranggay == 'Perez') echo 'selected'; ?>>Perez</option>
                    <option value="Prinza" <?php if ($filterBaranggay == 'Prinza') echo 'selected'; ?>>Prinza</option>
                    <option value="Pob. Kanluran" <?php if ($filterBaranggay == 'Pob. Kanluran') echo 'selected'; ?>>Pob. Kanluran</option>
                    <option value="Pob. Silangan" <?php if ($filterBaranggay == 'Pob. Silangan') echo 'selected'; ?>>Pob. Silangan</option>
                    <option value="San Isidro" <?php if ($filterBaranggay == 'San Isidro') echo 'selected'; ?>>San Isidro</option>
                    <option value="Santo Tomas" <?php if ($filterBaranggay == 'Santo Tomas') echo 'selected'; ?>>Santo Tomas</option>
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
                            <th>Baranggay</th>
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
                                        <td>{$row['Baranggay']}</td>
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
