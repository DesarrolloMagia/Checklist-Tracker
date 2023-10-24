<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Checklist Tracker</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>
    <div class="container">
        <div class="kanban-head">
            <strong class="kanban-head-title">My Checklist Tracker</strong>
        </div>

        <div class="kanban-table">
            <form action="app/Crear.php" method="POST">
                <div class="kanban-block kanban-form">
                    <strong class="kanban-form-title">Tarea</strong>
                    <div class="container-inputs">
                        <strong class="strong-input">Nombre Tarea: </strong>
                        <input type="text" name="tarea-nombre" class="input-text">
                        <strong class="strong-input">Descripción Tarea: </strong>
                        <textarea name="tarea-descripcion" class="textarea-text" rows="4"></textarea>
                        <strong class="strong-input">Fecha de Compromiso: </strong>
                        <input type="date" name="fecha-de-compromiso">
                        <strong class="strong-input">Prioridad: </strong>
                        <select name="tarea-prioridad">
                            <option value="Baja">Baja</option>
                            <option value="Media">Media</option>
                            <option value="Alta">Alta</option>
                        </select>
                        <strong class="strong-input">Responsable de Tarea: </strong>
                        <input type="text" name="tarea-responsable" class="input-text">
                    </div>
                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                        <p style="color: #ff6666;">Todos los campos son obligatorios.</p>
                    <?php } ?>
                    <input class="btn-crear" id="btn-crear-editar" type="submit" value="Crear Tarea" />
                </div>
            </form>

            <div class="kanban-block" id="pendientes" ondrop="drop(event)" ondragover="allowDrop(event)">
                <strong>PENDIENTES</strong>
                <?php
                // Incluye el archivo de conexión a la base de datos
                require 'Connect.php';

                // Consulta para seleccionar todas las tareas pendientes
                $sql = "SELECT * FROM tareas WHERE estado = 'Pendiente'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $tareasPendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($tareasPendientes) > 0) {
                    foreach ($tareasPendientes as $tarea) {
                        echo "<div class='tarea' draggable='true' ondragstart='drag(event)' id='tarea-" . $tarea['id'] . "'>";
                        echo "<p>Nombre: " . $tarea['nombre'] . "</p>";
                        echo "<p>Descripción: " . $tarea['descripcion'] . "</p>";
                        echo "<p>Fecha de Compromiso: " . $tarea['fecha_compromiso'] . "</p>";
                        echo "<p>Prioridad: " . $tarea['prioridad'] . "</p>";
                        echo "<p>Responsable: " . $tarea['responsable'] . "</p>";

                        // Botón de editar
                        echo "<a href='./app/Edit.php?id=" . $tarea['id'] . "' class='btn-editar'>Editar</a>";

                        // Botón de eliminar
                        echo "<a href='./app/Delete.php?id=" . $tarea['id'] . "' class='btn-eliminar'>Eliminar</a>";

                        echo "</div>";
                    }
                } else {
                    echo "No hay tareas pendientes.";
                }
                ?>
            </div>

            <div class="kanban-block" id="procesos" ondrop="drop(event, 'En Proceso')" ondragover="allowDrop(event)">
                <strong>EN PROCESO</strong>
                <?php
                // Incluye el archivo de conexión a la base de datos
                require 'Connect.php';

                // Consulta para seleccionar todas las tareas en proceso
                $sql = "SELECT * FROM tareas WHERE estado = 'En Proceso'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $tareasEnProceso = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($tareasEnProceso) > 0) {
                    foreach ($tareasEnProceso as $tarea) {
                        echo "<div class='tarea' draggable='true' ondragstart='drag(event)' id='tarea-" . $tarea['id'] . "'>";
                        echo "<p>Nombre: " . $tarea['nombre'] . "</p>";
                        echo "<p>Descripción: " . $tarea['descripcion'] . "</p>";
                        echo "<p>Fecha de Compromiso: " . $tarea['fecha_compromiso'] . "</p>";
                        echo "<p>Prioridad: " . $tarea['prioridad'] . "</p>";
                        echo "<p>Responsable: " . $tarea['responsable'] . "</p>";

                        // Botón de editar
                        echo "<a href='./app/Edit.php?id=" . $tarea['id'] . "' class='btn-editar'>Editar</a>";

                        // Botón de eliminar
                        echo "<a href='./app/Delete.php?id=" . $tarea['id'] . "' class='btn-eliminar'>Eliminar</a>";

                        echo "</div>";
                    }
                } else {
                    echo "No hay tareas en proceso.";
                }
                ?>
            </div>

            <div class="kanban-block" id="completados" ondrop="drop(event, 'Completado')" ondragover="allowDrop(event)">
                <strong>COMPLETADOS</strong>
                <?php
                // Incluye el archivo de conexión a la base de datos
                require 'Connect.php';

                // Consulta para seleccionar todas las tareas completadas
                $sql = "SELECT * FROM tareas WHERE estado = 'Completado'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $tareasCompletadas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($tareasCompletadas) > 0) {
                    foreach ($tareasCompletadas as $tarea) {
                        echo "<div class='tarea' draggable='true' ondragstart='drag(event)' id='tarea-" . $tarea['id'] . "'>";
                        echo "<p>Nombre: " . $tarea['nombre'] . "</p>";
                        echo "<p>Descripción: " . $tarea['descripcion'] . "</p>";
                        echo "<p>Fecha de Compromiso: " . $tarea['fecha_compromiso'] . "</p>";
                        echo "<p>Prioridad: " . $tarea['prioridad'] . "</p>";
                        echo "<p>Responsable: " . $tarea['responsable'] . "</p>";

                        echo "</div>";
                    }
                } else {
                    echo "No hay tareas completadas.";
                }
                ?>
            </div>

        </div>
    </div>
    <script type="text/javascript" charset="utf-8" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="./js/jquery-ui.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>
<?