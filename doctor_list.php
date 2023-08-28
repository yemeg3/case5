<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Список врачей</title>
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

    $doctor_query = "SELECT * FROM doctors";
    $doctor_result = mysqli_query($conn, $doctor_query);
    ?>

    <h1>Список врачей</h1>

    <ul>
        <?php
        while ($doctor = mysqli_fetch_assoc($doctor_result)) {
            echo "<li>";
            echo "<strong>Имя:</strong> {$doctor['name']}<br>";
            echo "<strong>Квалификация:</strong> {$doctor['qualification']}<br>";
            echo "<strong>Отделение:</strong> {$doctor['department']}<br>";
            echo "<strong>Список операций/услуг/лечений:</strong> {$doctor['procedures']}<br>";
            echo "<a href='edit_doctor.php?id={$doctor['id']}'>Изменить</a><br>";
            echo "</li><br>";
        }
        ?>
    </ul>

    <a href="index.php">На главную</a>

    <?php
    $conn->close();
    ?>
</body>
</html>
