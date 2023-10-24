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

            if (targetKanbanBlock === "procesos") {
                updateTaskStatus(taskId, 'En Proceso');
            } else if (targetKanbanBlock === "completados") {
                updateTaskStatus(taskId, 'Completado');
            }
        }
    });

    $(".kanban-block").disableSelection();
});
