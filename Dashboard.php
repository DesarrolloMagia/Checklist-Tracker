<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban UI</title>
    <link rel="stylesheet" href="./estilos.css">
</head>
<body>
    <div class="container">
        <div class="kanban-head">
            <strong class="kanban-head-title">Kanban UI</strong>
        </div>

        <div class="kanban-table">
            <div class="kanban-block kanban-form">
                <strong class="kanban-form-title">Tarea</strong>
                <div class="container-inputs">
                    <strong class="strong-input">Nombre Tarea: </strong>
                    <input type="text" id="tarea-nombre" class="input-text">
                    
                    <strong class="strong-input">Descripción Tarea: </strong>
                    <textarea type="text" id="tarea-descripcion" class="textarea-text" rows="4"></textarea>

                    <strong class="strong-input">Fecha de Compromiso: </strong>
                    <input type="date"></input>

                    <strong class="strong-input">Prioridad: </strong>
                        <select name="opcion" id="opciones">
                            <option value="" disabled selected>Seleccionar</option>
                            <option value="opcion2">Baja</option>
                            <option value="opcion3">Media</option>
                            <option value="opcion4">Alta</option>
                        </select>
         
                    <strong class="strong-input">Responsable Tarea: </strong>
                    <input type="text" id="tarea-responsable" class="input-text">
                </div>
    
                <input class="btn-crear" id="btn-crear-editar" type="submit" value="Crear Tarea" onclick="crearTarea(event)"/>
            </div>

            <div class="kanban-block" id="pendientes" ondrop="drop(event)" ondragover="allowDrop(event)">
                <strong>PENDIENTES</strong>
                <?php
                // Aquí puedes incluir el código PHP para cargar las tareas pendientes desde una fuente de datos
                ?>
            </div>

            <div class="kanban-block" id="procesos" ondrop="drop(event)" ondragover="allowDrop(event)">
                <strong>EN PROCESO</strong>
                <?php
                // Aquí puedes incluir el código PHP para cargar las tareas en proceso desde una fuente de datos
                ?>
            </div>

            <div class="kanban-block" id="completados" ondrop="drop(event)" ondragover="allowDrop(event)">
                <strong>COMPLETADOS</strong>
                <?php
                // Aquí puedes incluir el código PHP para cargar las tareas completadas desde una fuente de datos
                ?>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
</body>
</html>