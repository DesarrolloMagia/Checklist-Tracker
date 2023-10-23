const tarea = {
    id: '',
    nombre: '',
    descripcion: '',
    fechadecompromiso: '',
    prioridad: '',
    responsable: ''
}

let isEditando = false
let isValido = false

function drag(event) {
    event.dataTransfer.setData("text", event.target.id)
}

function allowDrop(event) {
    event.preventDefault()
}

function drop(event) {
    event.preventDefault()
    const data = event.dataTransfer.getData("text")
    event.currentTarget.appendChild(document.getElementById(data))
}

function crearTarea(event) {
    event.preventDefault()

    validarCampos(
        document.getElementById("tarea-nombre").value,
        document.getElementById("tarea-descripcion").value,
        document.getElementById("fecha-de-compromiso").value,
        document.getElementById("tarea-prioridad").value,
        document.getElementById("tarea-responsable").value,
    )

    if(isValido) {
        if (isEditando) {
            const divTarea = document.getElementById(tarea.id)
            divTarea.childNodes[0].textContent = document.getElementById("tarea-nombre").value
            divTarea.childNodes[1].textContent = document.getElementById("tarea-descripcion").value
            divTarea.childNodes[2].textContent = document.getElementById("fecha-de-compromiso").value
            divTarea.childNodes[3].textContent = document.getElementById("tarea-prioridad").value
            divTarea.childNodes[4].textContent = document.getElementById("tarea-responsable").value

            const btnEditar = document.getElementById("btn-crear-editar")
            btnEditar.value = "Crear Tarea"
            btnEditar.classList.remove('btn-editar')
            btnEditar.classList.add('btn-crear')
        } else {
            tarea.nombre = document.getElementById("tarea-nombre").value
            tarea.descripcion = document.getElementById("tarea-descripcion").value
            tarea.fechadecompromiso = document.getElementById("fecha-de-compromiso").value
            tarea.prioridad = document.getElementById("tarea-prioridad").value
            tarea.responsable = document.getElementById("tarea-responsable").value

            registrarTarea()
        }
    }

    limpiarCampos()
    limpiarObj()
}

function limpiarCampos() {
    document.getElementById("tarea-nombre").value = ''
    document.getElementById("tarea-descripcion").value = ''
    document.getElementById("fecha-de-compromiso").value = ''
    document.getElementById("tarea-prioridad").value = ''
    document.getElementById("tarea-responsable").value = ''

    
} 

function limpiarObj() {
    tarea.id = ''
    tarea.nombre = ''
    tarea.descripcion = ''
    tarea.fechadecompromiso = ''
    tarea.prioridad = ''
    tarea.responsable = ''


    isValido = false
    isEditando = false
}

function validarCampos(nombre, descripcion, fechadecompromiso, prioridad) {
    if (nombre === '' || descripcion === '' || fechadecompromiso === '' || prioridad === '') {
        alert('Debe completar todos los campos para registrar la tarea.');
        isValido = false;
    } else {
        isValido = true;
    }
}


function registrarTarea() {
    tarea.id = new Date().getTime()

    const pendientes = document.getElementById("pendientes")

    const divTarea = document.createElement('div')
    divTarea.classList.add('tarea')
    divTarea.setAttribute('id', tarea.id)
    divTarea.setAttribute('draggable', true)
    divTarea.setAttribute('ondragstart', 'drag(event)')

    const pNombre = document.createElement('p')
    pNombre.setAttribute('id', 'nombre')
    pNombre.textContent = 'Nombre: ' + tarea.nombre;

    const pDescripcion = document.createElement('p')
    pDescripcion.setAttribute('id', 'descripcion')
    pDescripcion.textContent = 'Descripción: ' + tarea.descripcion;

    const pFechaCompromiso = document.createElement('p')    
    pFechaCompromiso.setAttribute('id', 'fechadecompromiso')
    pFechaCompromiso.textContent = 'Fecha de Compromiso: ' + tarea.fechadecompromiso;

    const pPrioridad = document.createElement('p')    
    pPrioridad.setAttribute('id', 'prioridad')
    pPrioridad.textContent = 'Prioridad: ' + tarea.prioridad;

    const pResponsable = document.createElement('p')    
    pResponsable.setAttribute('id', 'responsable')
    pResponsable.textContent = 'Responsable: ' + tarea.responsable;

    const inputEditar = document.createElement('input')
    inputEditar.classList.add('btn-crear')
    inputEditar.setAttribute('type', 'submit')
    inputEditar.value = 'Editar'
    inputEditar.onclick = function() {
        isEditando = true
        tarea.id = divTarea.getAttribute('id')
        tarea.nombre = pNombre.textContent
        tarea.descripcion = pDescripcion.textContent
        tarea.fechadecompromiso = pFechaCompromiso.textContent.replace('Fecha de Compromiso: ', '');
        tarea.prioridad = pPrioridad.textContent.replace('Prioridad: ', '');
        tarea.responsable = pResponsable.textContent.replace('Responsable: ', '');

        editarTarea()
    }

    const inputBorrar = document.createElement('input')
    inputBorrar.classList.add('btn-borrar')
    inputBorrar.setAttribute('type', 'submit')
    inputBorrar.value = 'Borrar'
    inputBorrar.onclick = function() {
        divTarea.remove()
    }

    divTarea.appendChild(pNombre)
    divTarea.appendChild(pDescripcion)
    divTarea.appendChild(pFechaCompromiso)
    divTarea.appendChild(pPrioridad)
    divTarea.appendChild(pResponsable)
    divTarea.appendChild(inputEditar)
    divTarea.appendChild(inputBorrar)
    pendientes.appendChild(divTarea)
}


function editarTarea() {
    const btnEditar = document.getElementById("btn-crear-editar");
    btnEditar.value = "Editar Tarea";
    btnEditar.classList.remove('btn-crear');
    btnEditar.classList.add('btn-editar');

    document.getElementById("tarea-nombre").value = tarea.nombre;
    document.getElementById("tarea-descripcion").value = tarea.descripcion;
    document.getElementById("fecha-de-compromiso").value = tarea.fechadecompromiso;
    document.getElementById("tarea-prioridad").value = tarea.prioridad;
    document.getElementById("tarea-responsable").value = tarea.responsable;
}

