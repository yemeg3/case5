<!DOCTYPE html>
<html>
<head>
    <title>Управление больницей</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "lohnesxd_root";
    $password = "vostcorp12Qaq";
    $dbname = "lohnesxd_root";

    $conn = new mysqli($servername, $username, $password, $dbname);
    ?>

    <h1>Управление больницей</h1>


    <h2>Добавить врача</h2>
    <button id="showDoctorForm">Добавить врача</button>
    <form id="doctorForm" action="add_doctor.php" method="POST" style="display: none;">
        <label>Имя врача:</label>
        <input type="text" name="doctor_name"><br>
        <label>Квалификация:</label>
        <input type="text" name="qualification"><br>
        <label>Отделение:</label>
        <input type="text" name="department"><br>
        <label>Список операций/услуг/лечений:</label>
        <textarea name="procedures" rows="4"></textarea><br>
        <input type="submit" value="Добавить врача">
    </form>

    <h2>Список врачей</h2>
    <a href="doctor_list.php">Просмотреть список врачей</a>

    <h2>Добавить пациентов</h2>
    <button id="showPatientForm">Добавить пациента</button>
    <form id="patientForm" action="add_patient.php" method="POST" style="display: none;">
        <label>Имя пациента:</label>
        <input type="text" name="patient_name"><br>
        <label>Возврат:</label>
        <input type="text" name="patient_condition"><br>
        <label>Рост:</label>
        <input type="text" name="patient_height"><br>
        <label>Вес:</label>
        <input type="text" name="patient_weight"><br>
        <input type="submit" value="Добавить пациента">
    </form>


    <h2>Список пациентов</h2>
    <a href="patient_list.php">Просмотреть список пациентов</a>


    <h2>Записать на прием</h2>
    <button id="showAppointmentForm">Записать на прием</button>
    <form id="appointmentForm" action="schedule_appointment.php" method="POST" style="display: none;">
        <label>Имя пациента:</label>
        <select name="patient_id">
            <?php
            $patient_query = "SELECT id, name FROM patients";
            $patient_result = mysqli_query($conn, $patient_query);
            while ($patient = mysqli_fetch_assoc($patient_result)) {
                echo "<option value='{$patient['id']}'>{$patient['name']}</option>";
            }
            ?>
        </select><br>

        <label>Дата и время приема:</label>
        <input type="datetime-local" name="appointment_time"><br>

        <label>Имя врача:</label>
        <select name="doctor_name" id="doctorSelect">
            <?php
            $doctor_query = "SELECT name FROM doctors";
            $doctor_result = mysqli_query($conn, $doctor_query);
            while ($doctor = mysqli_fetch_assoc($doctor_result)) {
                echo "<option value='{$doctor['name']}'>{$doctor['name']}</option>";
            }
            ?>
        </select><br>

        <label>Услуга:</label>
        <select name="service" id="serviceSelect">
            <option value="">Выберите услугу</option>
        </select><br>

        <input type="submit" value="Записать на прием">
    </form>
    <script>
        $(document).ready(function() {
            $("#showAppointmentForm").click(function() {
                $("#appointmentFormContainer").toggle();
            });

            $("#doctorSelect").change(function() {
                var selectedDoctor = $(this).val();
                $.ajax({
                    url: "get_services.php",
                    method: "POST",
                    data: { doctor: selectedDoctor },
                    dataType: "json",
                    success: function(data) {
                        var serviceSelect = $("#serviceSelect");
                        serviceSelect.empty();
                        $.each(data, function(index, value) {
                            serviceSelect.append($("<option></option>")
                                .attr("value", value)
                                .text(value));
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#showDoctorForm").click(function() {
                $("#doctorForm").toggle();
            });

            $("#showPatientForm").click(function() {
                $("#patientForm").toggle();
            });

            $("#showAppointmentForm").click(function() {
                $("#appointmentForm").toggle();
            });
        });
    </script>
</body>
</html>
