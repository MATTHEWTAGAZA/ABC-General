<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $PatientName = sanitizeInput($_POST['PatientName']);
    $Age = sanitizeInput($_POST['Age']);
    $Sex = sanitizeInput($_POST['Sex']);
    $ExposureDate = sanitizeInput($_POST['ExposureDate']);
    $Barangay = sanitizeInput($_POST['Barangay']);
    $Place = sanitizeInput($_POST['Place']);
    $Animal = sanitizeInput($_POST['Animal']);
    $ExposureType = sanitizeInput($_POST['ExposureType']);
    $BiteSite = sanitizeInput($_POST['BiteSite']);

    $sql = "INSERT INTO PatientRecord (PatientName, Age, Sex, ExposureDate, Barangay, Place, Animal, ExposureType, BiteSite) VALUES ('$PatientName', '$Age', '$Sex', '$ExposureDate', '$Barangay', '$Place', '$Animal', '$ExposureType', '$BiteSite')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: auto;
        }
        .form-container label, .form-container input, .form-container select {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            background-color: #237854; /* Updated button color */
            color: white;
        }
        button:hover {
            background-color: #1e6a48; /* Slightly darker shade for hover */
        }
        .back-button {
            background-color: #237854; /* Updated back button color */
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .sidebar {
            background-color: #237854; /* Updated sidebar color to green */
            padding: 15px;
            color: white;
        }
        .sidebar button {
            background-color: #237854; /* Ensure sidebar buttons match */
            color: white;
            border: none;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            width: 100%;
        }
        .sidebar button:hover {
            background-color: #1e6a48; /* Slightly darker shade for hover */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar content -->
        <h2>Patient Registration</h2>
        <button onclick="location.href='dashboard.php'">Dashboard</button> <!-- Dashboard button at the top -->
        <button onclick="location.href='PatientRecord.php'">Patient Record</button>
        <button onclick="location.href='PatientRegistration.php'">Patient Registration</button>
        <button onclick="location.href='VaccinationRecord.php'">Vaccination Records</button>
        <button onclick="location.href='index.php'">Dynamic Chart</button>
        <button onclick="location.href='report.php'">Generate Report</button>
        <button onclick="location.href='logout.php'">Logout</button>
    </div>
    <div class="form-container">
        <h2>Patient Registration</h2>
        <form id="patientRegisterForm" action="PatientRegistration.php" method="POST" onsubmit="return validateRegisterForm()">
            <label for="PatientName">Name:</label>
            <input type="text" id="PatientName" name="PatientName" required>
            
            <label for="Age">Age:</label>
            <input type="number" id="Age" name="Age" required>
            
            <label for="Sex">Sex:</label>
            <select id="Sex" name="Sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            
            <label for="ExposureDate">Exposure Date:</label>
            <input type="date" id="ExposureDate" name="ExposureDate" required>
            
            <label for="Barangay">Barangay:</label>
            <select id="Barangay" name="Barangay">
                <option value="Atisan">Atisan</option>
                <option value="Bagong Bayan II-A">Bagong Bayan II-A</option>
                <option value="Bagong Pook VI-C">Bagong Pook VI-C</option>
                <option value="Barangay I-A">Barangay I-A</option>
                <option value="Barangay I-B">Barangay I-B</option>
                <option value="Barangay II-A">Barangay II-A</option>
                <option value="Barangay II-B">Barangay II-B</option>
                <option value="Barangay II-C">Barangay II-C</option>
                <option value="Barangay II-D">Barangay II-D</option>
                <option value="Barangay II-E">Barangay II-E</option>
                <option value="Barangay II-F">Barangay II-F</option>
                <option value="Barangay III-A">Barangay III-A</option>
                <option value="Barangay III-B">Barangay III-B</option>
                <option value="Barangay III-C">Barangay III-C</option>
                <option value="Barangay III-D">Barangay III-D</option>
                <option value="Barangay III-E">Barangay III-E</option>
                <option value="Barangay III-F">Barangay III-F</option>
                <option value="Barangay IV-A">Barangay IV-A</option>
                <option value="Barangay IV-B">Barangay IV-B</option>
                <option value="Barangay IV-C">Barangay IV-C</option>
                <option value="Barangay V-A">Barangay V-A</option>
                <option value="Barangay V-B">Barangay V-B</option>
                <option value="Barangay V-C">Barangay V-C</option>
                <option value="Barangay V-D">Barangay V-D</option>
                <option value="Barangay VI-A">Barangay VI-A</option>
                <option value="Barangay VI-B">Barangay VI-B</option>
                <option value="Barangay VI-D">Barangay VI-D</option>
                <option value="Barangay VI-E">Barangay VI-E</option>
                <option value="Barangay VII-A">Barangay VII-A</option>
                <option value="Barangay VII-B">Barangay VII-B</option>
                <option value="Barangay VII-C">Barangay VII-C</option>
                <option value="Barangay VII-D">Barangay VII-D</option>
                <option value="Barangay VII-E">Barangay VII-E</option>
                <option value="Bautista">Bautista</option>
                <option value="Concepcion">Concepcion</option>
                <option value="Del Remedio">Del Remedio</option>
                <option value="Dolores">Dolores</option>
                <option value="San Antonio 1">San Antonio 1</option>
                <option value="San Antonio 2">San Antonio 2</option>
                <option value="San Bartolome">San Bartolome</option>
                <option value="San Buenaventura">San Buenaventura</option>
                <option value="San Crispin">San Crispin</option>
                <option value="San Cristobal">San Cristobal</option>
                <option value="San Diego">San Diego</option>
                <option value="San Francisco">San Francisco</option>
                <option value="San Gabriel">San Gabriel</option>
                <option value="San Gregorio">San Gregorio</option>
                <option value="San Ignacio">San Ignacio</option>
                <option value="San Isidro">San Isidro</option>
                <option value="San Joaquin">San Joaquin</option>
                <option value="San Jose">San Jose</option>
                <option value="San Juan">San Juan</option>
                <option value="San Lorenzo">San Lorenzo</option>
                <option value="San Lucas 1">San Lucas 1</option>
                <option value="San Lucas 2">San Lucas 2</option>
                <option value="San Marcos">San Marcos</option>
                <option value="San Mateo">San Mateo</option>
                <option value="San Miguel">San Miguel</option>
                <option value="San Nicolas">San Nicolas</option>
                <option value="San Pedro">San Pedro</option>
                <option value="San Rafael">San Rafael</option>
                <option value="San Roque">San Roque</option>
                <option value="San Vicente">San Vicente</option>
                <option value="Santa Ana">Santa Ana</option>
                <option value="Santa Catalina">Santa Catalina</option>
                <option value="Santa Cruz">Santa Cruz</option>
                <option value="Santa Felomina">Santa Felomina</option>
                <option value="Santa Isabel">Santa Isabel</option>
                <option value="Santa Maria Magdalena">Santa Maria Magdalena</option>
                <option value="Santa Veronica">Santa Veronica</option>
                <option value="Santiago I">Santiago I</option>
                <option value="Santiago II">Santiago II</option>
                <option value="Santisimo Rosario">Santisimo Rosario</option>
                <option value="Santo Angel">Santo Angel</option>
                <option value="Santo Cristo">Santo Cristo</option>
                <option value="Santo Niño">Santo Niño</option>
                <option value="Soledad">Soledad</option>
                <option value="Santa Elena">Santa Elena</option>
                <option value="Santa Maria">Santa Maria</option>
                <option value="Santa Monica">Santa Monica</option>
            </select>
            
            <label for="Place">Place:</label>
            <select id="Place" name="Place" required>
                <option value="Indoor">Indoor</option>
                <option value="Outdoor">Outdoor</option>
            </select>
            
            <label for="Animal">Animal:</label>
            <select id="Animal" name="Animal" required>
                <option value="Dog">Dog</option>
                <option value="Cat">Cat</option>
                <option value="Hamster">Hamster</option>
                <option value="Rabbit">Rabbit</option>
                <option value="Turtle">Turtle</option>
                <option value="Lizard">Lizard</option>
                <option value="Fish">Fish</option>
                <option value="Bird">Bird</option>
                <option value="Mouse">Mouse</option>
                <option value="Pig">Pig</option>
                <option value="Monkey">Monkey</option>
                <option value="Others">Others</option>
            </select>
            
            <label for="ExposureType">Exposure Type:</label>
            <select id="ExposureType" name="ExposureType" required>
                <option value="Bite">Bite</option>
                <option value="Scratch">Scratch</option>
                <option value="Other">Other</option>
            </select>
            
            <label for="BiteSite">Bite Site:</label>
            <select id="BiteSite" name="BiteSite" required>
                <option value="Hands">Hands</option>
                <option value="Arms">Arms</option>
                <option value="Legs">Legs</option>
                <option value="Thighs">Thighs</option>
                <option value="Feet">Feet</option>
                <option value="Neck">Neck</option>
                <option value="Head">Head</option>
                <option value="Face">Face</option>
                <option value="Scratch">Scratch</option>
                <option value="Saliva">Saliva</option>
                <option value="Others">Others</option>
            </select>
            
            <button type="submit">Add to Record</button>
        </form>
        <button onclick="window.location.href='PatientRecord.php'" class="back-button">Back to Home</button>
    </div>
    <script src="script.js"></script>
</body>
</html>
