let userTable, memTable, memberTable


// Se valida solo cuando se usa AJAX
// let userTableIsInicialized= false
// let memTableIsInicialized= false

const config = {
    columnDefs: [
        {className: "center", targets: [0, 4]},
        {orderable: false, targets: [4]},
        {searchable: false, targets:[0, 2, 4]}
        //{width: '5%', targets: [0]}
    ],
    lengthMenu: [5, 10, 25],
    // spageLength: 10,
    destroy: true,
    language: {
        decimal: ",",
        thousands: ".",
        emptyTable: "No hay datos todavia",
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "Mostrando 0 a 0 de 0 registros",
        infoFiltered: "(filtrado de _MAX_ registros totales)",
        lengthMenu: "Mostrar _MENU_ registros por página",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Buscar:",
        zeroRecords: "No se encontraron resultados",
        paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
        },
        aria: {
        sortAscending: ": activar para ordenar ascendente",
        sortDescending: ": activar para ordenar descendente",
        },
    },
};


const memberTableConfig = {
    columnDefs: [
        {className: "center", targets: [2, 3, 4]},
        {orderable: false, targets: [4]},
        {searchable: false, targets:[2, 4]}
        //{width: '5%', targets: [0]}
    ],
    lengthMenu: [5, 10, 25],
    // spageLength: 10,
    destroy: true,
    language: {
        decimal: ",",
        thousands: ".",
        emptyTable: "No hay datos todavia",
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "Mostrando 0 a 0 de 0 registros",
        infoFiltered: "(filtrado de _MAX_ registros totales)",
        lengthMenu: "Mostrar _MENU_ registros por página",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Buscar:",
        zeroRecords: "No se encontraron resultados",
        paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
        },
        aria: {
        sortAscending: ": activar para ordenar ascendente",
        sortDescending: ": activar para ordenar descendente",
        },
    },
};

const paysTableConfig = {
    columnDefs: [
        {className: "center", targets: [0, 1, 4, 5]},//{width: '5%', targets: [0]}
    ],
    lengthMenu: [5, 10, 25],
    // spageLength: 10,
    destroy: true,
    language: {
        decimal: ",",
        thousands: ".",
        emptyTable: "No hay datos todavia",
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "Mostrando 0 a 0 de 0 registros",
        infoFiltered: "(filtrado de _MAX_ registros totales)",
        lengthMenu: "Mostrar _MENU_ registros por página",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Buscar:",
        zeroRecords: "No se encontraron resultados",
        paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
        },
        aria: {
        sortAscending: ": activar para ordenar ascendente",
        sortDescending: ": activar para ordenar descendente",
        },
    },
};

const initDataTable = ()=> {
    // if(userTableIsInicialized) {
    //     userTable.destroy()
    // }

    // if(memTableIsInicialized) {
    //     memTable.destroy()
    // }

    userTable = $('#users').DataTable(config);
    memTable = $('#memberships').DataTable(config)
    memberTable = $('#members').DataTable(memberTableConfig)
    paysTable = $('#pays').DataTable(paysTableConfig)

    // userTableIsInicialized = true
    // memTableIsInicialized = true
}


window.addEventListener('load', ()=>{
    initDataTable();

})


// Record users
const users = document.querySelectorAll('.editUser')
const userFields = document.querySelectorAll('.field-edit-user')

// Record mems
const mems = document.querySelectorAll('.editMem');
const memFields = document.querySelectorAll('.field-edit-mem')

users.forEach(user => {
    user.addEventListener('click', ()=>setModalUsers(user))
})


mems.forEach(mem => {
    mem.addEventListener('click', ()=>setModalMems(mem))
})


function setModalUsers(user) {
    id = user.getAttribute('data-userId')
    userName = user.getAttribute('data-name')
    email = user.getAttribute('data-email')
    rol = user.getAttribute('data-rol')

    userFields[0].value = id
    userFields[1].value = userName
    userFields[2].value = email
    userFields[3].value = rol   
}

function setModalMems(mem) {
    typeId = mem.getAttribute('data-typeId')
    memName = mem.getAttribute('data-name')
    duration = mem.getAttribute('data-duration')
    value = mem.getAttribute('data-value')

    memFields[0].value = typeId
    memFields[1].value = memName
    memFields[2].value = duration
    memFields[3].value = value  
}

const sideItems = document.querySelectorAll('.side-item')

sideItems.forEach(item => {
    item.addEventListener('click', (e)=>{
        sideItems.forEach(i => {
            i.classList.remove('selected')
        })
        item.classList.add('selected')
    })
})