<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Добавление/Редактирование медицинского отчета</title>
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
        $record_id = $_POST['record_id'];
        $complaints = $_POST['complaints'];
        $diagnosis = $_POST['diagnosis'];
        $recommendations = $_POST['recommendations'];

        if (isset($_POST['report_id'])) {
            // Редактирование существующего медицинского отчета
            $report_id = $_POST['report_id'];
            $update_report_query = "UPDATE reports SET complaints='$complaints', diagnosis='$diagnosis', recommendations='$recommendations' WHERE id=$report_id";

            if (mysqli_query($conn, $update_report_query)) {
                echo "Медицинский отчет успешно обновлен.";
            } else {
                echo "Ошибка при обновлении медицинского отчета: " . mysqli_error($conn);
            }
        } else {
            // Добавление нового медицинского отчета
            $insert_report_query = "INSERT INTO reports (record_id, complaints, diagnosis, recommendations) VALUES ('$record_id', '$complaints', '$diagnosis', '$recommendations')";

            if (mysqli_query($conn, $insert_report_query)) {
                echo "Медицинский отчет успешно добавлен.";
            } else {
                echo "Ошибка при добавлении медицинского отчета: " . mysqli_error($conn);
            }
        }
    }

    $conn->close();
    ?>

    <a href="patient_list.php">Список пациентов</a>
</body>
</html>
