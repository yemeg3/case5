<!DOCTYPE html>
<html>
<head>
    <title>Карточка пациента</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "lohnesxd_root";
    $password = "vostcorp12Qaq";
    $dbname = "lohnesxd_root";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $statuses = array(
    "Открыт больничный лист",
    "Назначены профилактические процедуры",
    "Подготовка к операции",
    "Больничный лист закрыт"
);

    if (!$conn) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
        $patient_id = $_GET['id'];
        $select_patient_query = "SELECT * FROM patients WHERE id = $patient_id";
        $patient_result = mysqli_query($conn, $select_patient_query);

        if (mysqli_num_rows($patient_result) == 1) {
            $patient = mysqli_fetch_assoc($patient_result);
            echo "<h1>Карточка пациента</h1>";
            echo "<p><strong>Статус:</strong> " . $patient['status'] . "</p>";


            echo "<form method=\"post\" action=\"update_patient_status.php\">";
            echo "<input type=\"hidden\" name=\"patient_id\" value=\"" . $patient_id . "\">";
            echo "Изменить статус: ";
            echo "<select name=\"new_status\">";
            foreach ($statuses as $status) {
                echo "<option value=\"$status\">$status</option>";
            }
            echo "</select>";
            echo "<input type=\"submit\" value=\"Сохранить\">";
            echo "</form>";

            echo "<p><strong>Имя:</strong> " . $patient['name'] . "</p>";
            echo "<p><strong>Возраст:</strong> " . $patient['patient_condition'] . "</p>";
            echo "<p><strong>Рост:</strong> " . $patient['height'] . "</p>";
            echo "<p><strong>Вес:</strong> " . $patient['weight'] . "</p>";


            $select_records_query = "
                SELECT r.*, d.qualification AS doctor_qualification
                FROM records r
                JOIN doctors d ON r.doctor_name = d.name
                WHERE patient_id = $patient_id";
            $records_result = mysqli_query($conn, $select_records_query);


            if (mysqli_num_rows($records_result) > 0) {
                echo "<h2>Записи пациента</h2>";
                echo "<ul>";
                while ($record = mysqli_fetch_assoc($records_result)) {
                    echo "<li>";
                    echo "Дата и время: " . $record['datetime'] . " - Врач: " . $record['doctor_name'] . "  - Квалификация: " . $record['doctor_qualification'] . " - Услуга: " . $record['service'];
                    $report_query = "SELECT * FROM reports WHERE record_id = {$record['id']}";
                    $report_result = mysqli_query($conn, $report_query);

                    if (mysqli_num_rows($report_result) > 0) {
                        $report = mysqli_fetch_assoc($report_result);
                        echo "<h2>Медицинский отчет</h2>";
                        echo "<p>Жалобы: {$report['complaints']}</p>";
                        echo "<p>Диагноз: {$report['diagnosis']}</p>";
                        echo "<p>Рекомендации: {$report['recommendations']}</p>";


                        echo "<button onclick=\"toggleReportForm('report_form_" . $record['id'] . "')\">Изменить медицинский отчет о приеме</button>";
                        echo "<div id=\"report_form_" . $record['id'] . "\" style=\"display: none;\">";
                        echo "<form method=\"post\" action=\"add_report.php\">";
                        echo "<input type=\"hidden\" name=\"report_id\" value=\"" . $report['id'] . "\">";
                        echo "Жалобы пациента: <input type=\"text\" name=\"complaints\" value=\"" . $report['complaints'] . "\"><br>";
                        echo "Диагноз: <input type=\"text\" name=\"diagnosis\" value=\"" . $report['diagnosis'] . "\"><br>";
                        echo "Рекомендации врача: <input type=\"text\" name=\"recommendations\" value=\"" . $report['recommendations'] . "\"><br>";
                        echo "<input type=\"submit\" value=\"Сохранить\">";
                        echo "</form>";
                        echo "</div>";
                    } else {
                        echo "<p>Медицинский отчет отсутствует.</p>";


                        echo "<button onclick=\"toggleReportForm('report_form_" . $record['id'] . "')\">Добавить медицинский отчет о приеме</button>";
                        echo "<div id=\"report_form_" . $record['id'] . "\" style=\"display: none;\">";
                        echo "<form method=\"post\" action=\"add_report.php\">";
                        echo "<input type=\"hidden\" name=\"record_id\" value=\"" . $record['id'] . "\">";
                        echo "Жалобы пациента: <input type=\"text\" name=\"complaints\"><br>";
                        echo "Диагноз: <input type=\"text\" name=\"diagnosis\"><br>";
                        echo "Рекомендации врача: <input type=\"text\" name=\"recommendations\"><br>";
                        echo "<input type=\"submit\" value=\"Сохранить\">";
                        echo "</form>";
                        echo "</div>";
                    }
                    echo "<br>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Нет записей для этого пациента.</p>";
            }
        } else {
            echo "Пациент не найден.";
        }
    } else {
        echo "Идентификатор пациента не указан.";
    }
    ?>

    <a href="patient_list.php">Назад к списку пациентов</a>

    <?php
    $conn->close();
    ?>

    <script>
        function toggleReportForm(id) {
            var form = document.getElementById(id);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>
</html>
