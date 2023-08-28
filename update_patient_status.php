<?php
$servername = "localhost";
$username = "lohnesxd_root";
$password = "vostcorp12Qaq";
$dbname = "lohnesxd_root";

$conn = mysql_connect($servername, $username, $password);

if (!$conn) {
    die("Ошибка подключения: " . mysql_error());
}

mysql_select_db($dbname, $conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $new_status = $_POST['new_status'];

    $update_status_query = "UPDATE patients SET status='$new_status' WHERE id=$patient_id";

    if (mysql_query($update_status_query)) {
        header("Location: patient_card.php?id=" . $patient_id);
        exit;
    } else {
        echo "Ошибка при обновлении статуса пациента: " . mysql_error();
    }
}

mysql_close($conn);
?>
