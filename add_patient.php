<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Добавление пациента</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient_name = $_POST["patient_name"];
        $condition = $_POST["patient_condition"];
        $height = $_POST["patient_height"];
        $weight = $_POST["patient_weight"];

        $servername = "localhost";
        $username = "lohnesxd_root";
        $password = "vostcorp12Qaq";
        $dbname = "lohnesxd_root";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Ошибка подключения: " . mysqli_connect_error());
        }

        $insert_patient_query = "INSERT INTO patients (name, patient_condition, height, weight)
                                VALUES ('$patient_name', '$condition', '$height', '$weight')";

        if (mysqli_query($conn, $insert_patient_query)) {
            echo "<h1>Пациент успешно добавлен</h1>";
            echo "<p>Информация о пациенте была успешно добавлена в базу данных.</p>";
            echo "<a href=\"index.php\">На главную</a>";
        } else {
            echo "Ошибка: " . mysqli_error($conn);
        }

        $conn->close();
    }
    ?>
</body>
</html>
