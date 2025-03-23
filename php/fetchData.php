<?php
include 'db.php';

$filterType = $_GET['filterType'];
$data = [];

if ($filterType == 'Barangay') {
    $sql = "SELECT Barangay, COUNT(*) as total FROM PatientRecord GROUP BY Barangay";
} elseif ($filterType == 'Animal') {
    $sql = "SELECT Animal, COUNT(*) as total FROM PatientRecord GROUP BY Animal";
} elseif ($filterType == 'ExposureType') {
    $sql = "SELECT ExposureType, COUNT(*) as total FROM PatientRecord GROUP BY ExposureType";
} elseif ($filterType == 'BiteSite') {
    $sql = "SELECT BiteSite, COUNT(*) as total FROM PatientRecord GROUP BY BiteSite";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data['labels'][] = $row[$filterType];
        $data['datasets'][0]['data'][] = $row['total'];
    }
}

$data['datasets'][0]['backgroundColor'] = [
    'rgba(255, 99, 132, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(255, 206, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(255, 159, 64, 0.2)'
];
$data['datasets'][0]['borderColor'] = [
    'rgba(255, 99, 132, 1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64, 1)'
];
$data['datasets'][0]['borderWidth'] = 1;

echo json_encode($data);
?>
