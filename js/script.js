function updateTaskStatus(taskId, newStatus) {
    $.ajax({
        url: 'app/update.php',
        method: 'POST',
        data: {
            taskId: taskId,
            newState: newStatus
        },
        success: function(response) {
            console.log("Tarea actualizada con éxito.");
            location.reload();
        },
        error: function(error) {
            console.error("Error al actualizar la tarea.");
        }
    });
}

$(document).ready(function() {
    $(".kanban-block").sortable({
        connectWith: ".kanban-block",
        update: function(event, ui) {
            var taskId = ui.item.attr("id").split("-")[1]; // Obtiene el ID de la tarea
            var targetKanbanBlock = ui.item.parent().attr("id");

            // Obtiene el estado actual de la tarea
            var currentState = ui.item.data("estado");

            if (targetKanbanBlock === "pendientes") {
                updateTaskStatus(taskId, 'Pendiente');
            } else if (targetKanbanBlock === "procesos" && currentState !== 'Pendiente') {
                updateTaskStatus(taskId, 'En Proceso');
            } else if (targetKanbanBlock === "completados" && currentState === 'En Proceso') {
                updateTaskStatus(taskId, 'Completado');
            }
        }
    });

    $(".kanban-block").disableSelection();
});
