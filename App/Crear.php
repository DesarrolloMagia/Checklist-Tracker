<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../Connect.php';

    $nombre = $_POST['tarea-nombre'];
    $descripcion = $_POST['tarea-descripcion'];
    $fecha_compromiso = $_POST['fecha-de-compromiso'];
    $prioridad = $_POST['tarea-prioridad'];
    $responsable = $_POST['tarea-responsable'];

    // Realiza validación, por ejemplo, si el nombre es obligatorio
    if (empty($nombre)) {
        header("Location: ../Dashboard.php?mess=error");
    } else {
        $stmt = $conn->prepare("INSERT INTO tareas (nombre, descripcion, fecha_compromiso, prioridad, responsable) VALUES (?, ?, ?, ?, ?)");
        $res = $stmt->execute([$nombre, $descripcion, $fecha_compromiso, $prioridad, $responsable]);

        if ($res) {
            header("Location: ../Dashboard.php?mess=success");
        } else {
            header("Location: ../Dashboard.php?mess=error");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../Dashboard.php?mess=error");
}
?>
