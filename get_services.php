<?php
$servername = "localhost";
$username = "lohnesxd_root";
$password = "vostcorp12Qaq";
$dbname = "lohnesxd_root";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

$doctor = $_POST['doctor'];

$services_query = "SELECT procedures FROM doctors WHERE name = '$doctor'";
$services_result = mysqli_query($conn, $services_query);

if ($services_result) {
    $services = mysqli_fetch_assoc($services_result)['procedures'];
    $services_array = explode(', ', $services);
    echo json_encode($services_array);
} else {
    echo json_encode([]);
}

$conn->close();
?>
