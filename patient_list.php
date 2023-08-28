<!DOCTYPE html>
<html>
<head>
    <title>Список пациентов</title>
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

    $select_patients_query = "SELECT * FROM patients";
    $patients_result = mysqli_query($conn, $select_patients_query);
    ?>

    <h1>Список пациентов</h1>

    <ul>
        <?php
        while ($row = mysqli_fetch_assoc($patients_result)) {
            echo "<li>";
            echo "<strong>Имя:</strong> " . $row['name'] . "<br>";
            echo "<strong>Возраст:</strong> " . $row['patient_condition'] . "<br>";
            echo "<strong>Рост:</strong> " . $row['height'] . "<br>";
            echo "<strong>Вес:</strong> " . $row['weight'] . "<br>";
            echo "<a href=\"patient_card.php?id={$row['id']}\">Открыть карточку пациента</a>";
            echo "</li>";
        }
        ?>
    </ul>

    <a href="index.php">На главную</a>

    <?php
    $conn->close();
    ?>


    <?php
    function calculateAge($birthdate) {

    }
    ?>
</body>
</html>
