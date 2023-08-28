<?php
session_start();

$servername = "localhost";
$username = "lohnesxd_root";
$password = "vostcorp12Qaq";
$dbname = "lohnesxd_root";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_name = $_POST["doctor_name"];
    $qualification = $_POST["qualification"];
    $department = $_POST["department"];
    $procedures = $_POST["procedures"];

    $insert_doctor_query = "INSERT INTO doctors (name, qualification, department)
                            VALUES ('$doctor_name', '$qualification', '$department')";

    if ($conn->query($insert_doctor_query) === TRUE) {
        $doctor_id = $conn->insert_id;
        $procedures_list = explode("\n", $procedures);

        foreach ($procedures_list as $procedure) {
            $procedure = trim($procedure);

            if (!empty($procedure)) {
                $insert_procedure_query = "INSERT INTO procedures (doctor_id, procedure_name)
                                          VALUES ('$doctor_id', '$procedure')";
                $conn->query($insert_procedure_query);
            }
        }

        echo "<p>Информация о враче была успешно добавлена в базу данных.</p>";
        echo "<a href=\"index.php\">На главную</a>";

    } else {
        echo "Ошибка: " . $conn->error;
    }
}

$conn->close();
?>
