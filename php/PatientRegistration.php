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
        body {
            background-color: #d4efdb; /* Updated background color */
        }
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
        .back-button:hover {
            background-color: #1e6a48; /* Slightly darker shade for hover */
        }
    </style>
</head>
<body>
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
            <select id= barangay name="barangay">
             <option value="Anos">Anos</option>
             <option value="Bagong Silang">Bagong Silang</option>
             <option value="Bambang">Bambang</option>
             <option value="Batong Malake">Batong Malake</option>
             <option value="Baybayin">Baybayin</option>
             <option value="Bayog">Bayog</option>
             <option value="Lalakay">Lalakay</option>
             <option value="Maahas">Maahas</option>
             <option value="Malinta">Malinta</option>
             <option value="Mayondon">Mayondon</option>
             <option value="San Antonio">San Antonio</option>
             <option value="Tadlac">Tadlac</option>
             <option value="Timugan">Timugan</option>
             <option value="Putho-Tuntungin">Putho-Tuntungin</option>
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
