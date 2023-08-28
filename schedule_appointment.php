<!DOCTYPE html>
<html>
<head>
    <title>Запись на прием</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "lohnesxd_root";
    $password = "vostcorp12Qaq";
    $dbname = "lohnesxd_root";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient_id = $_POST['patient_id'];
        $doctor_name = $_POST['doctor_name'];
        $datetime = $_POST['appointment_time'];
        $service = $_POST['service'];
        $insert_appointment_query = "INSERT INTO records (patient_id, doctor_name, datetime, service)
                                    VALUES ('$patient_id', '$doctor_name', '$datetime', '$service')";

        if (mysqli_query($conn, $insert_appointment_query)) {
            echo "Запись на прием успешно добавлена.";
        } else {
            echo "Ошибка при добавлении записи на прием: " . mysqli_error($conn);
        }
    }

    ?>

    <h1>Запись на прием</h1>



    <a href="index.php">На главную</a>

    <?php
    $conn->close();
    ?>
</body>
</html>
