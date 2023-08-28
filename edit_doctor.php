<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Редактирование врача</title>
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
        $doctor_id = $_POST['doctor_id'];
        $qualification = $_POST['qualification'];
        $department = $_POST['department'];
        $procedures = $_POST['procedures'];

        $update_doctor_query = "UPDATE doctors SET qualification='$qualification', department='$department', procedures='$procedures' WHERE id=$doctor_id";

        if (mysqli_query($conn, $update_doctor_query)) {
            echo "Данные врача успешно обновлены.";
        } else {
            echo "Ошибка при обновлении данных врача: " . mysqli_error($conn);
        }
    }

    if (isset($_GET['id'])) {
        $doctor_id = $_GET['id'];
        $select_doctor_query = "SELECT * FROM doctors WHERE id = $doctor_id";
        $doctor_result = mysqli_query($conn, $select_doctor_query);

        if (mysqli_num_rows($doctor_result) == 1) {
            $doctor = mysqli_fetch_assoc($doctor_result);
            ?>

            <h1>Редактирование врача</h1>
            <form method="post" action="">
                <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
                <label>Квалификация:</label>
                <input type="text" name="qualification" value="<?php echo $doctor['qualification']; ?>"><br>
                <label>Отделение:</label>
                <input type="text" name="department" value="<?php echo $doctor['department']; ?>"><br>
                <label>Список операций/услуг/лечений:</label>
                <input type="text" name="procedures" value="<?php echo $doctor['procedures']; ?>"</input><br>
                <input type="submit" value="Сохранить">
            </form>

            <a href="doctor_list.php">Вернуться к списку врачей</a>

            <?php
        } else {
            echo "Врач не найден.";
        }
    } else {
        echo "Идентификатор врача не указан.";
    }

    $conn->close();
    ?>
</body>
</html>
