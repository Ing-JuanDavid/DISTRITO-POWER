let userTable, memTable, memberTable


// Se valida solo cuando se usa AJAX
// let userTableIsInicialized= false
// let memTableIsInicialized= false


const asistTableConfig = {
    columnDefs: [
        {className: "center", targets: [0, 1]},
        // {orderable: false, targets: [4]},
        //{searchable: fale, targets:[0, 1]}
    ],
    lengthMenu: [5, 10, 25],
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
    lengthMenu: [5, 10, 25],
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

    asistTable = $('#asist-table').DataTable(asistTableConfig);
    paysTable = $('#pays-table').DataTable(paysTableConfig);
}


window.addEventListener('load', ()=>{
    initDataTable();

})

const sideItems = document.querySelectorAll('.side-item')

function showTab(tabId, itemId) {
    const tabTrigger = new bootstrap.Tab(document.querySelector(`[href="#${tabId}"]`));
    tabTrigger.show();

    removeSelection();
    const item = document.getElementById(itemId);
    if (item) {
        item.classList.add('selected');
    }
}


function removeSelection() {
    sideItems.forEach(i => {
    i.classList.remove('selected');
});
}


// // Record users
// const users = document.querySelectorAll('.editUser')
// const userFields = document.querySelectorAll('.field-edit-user')

// // Record mems
// const mems = document.querySelectorAll('.editMem');
// const memFields = document.querySelectorAll('.field-edit-mem')

// users.forEach(user => {
//     user.addEventListener('click', ()=>setModalUsers(user))
// })


// mems.forEach(mem => {
//     mem.addEventListener('click', ()=>setModalMems(mem))
// })


// function setModalUsers(user) {
//     id = user.getAttribute('data-userId')
//     userName = user.getAttribute('data-name')
//     email = user.getAttribute('data-email')
//     rol = user.getAttribute('data-rol')

//     userFields[0].value = id
//     userFields[1].value = userName
//     userFields[2].value = email
//     userFields[3].value = rol   
// }

// function setModalMems(mem) {
//     typeId = mem.getAttribute('data-typeId')
//     memName = mem.getAttribute('data-name')
//     duration = mem.getAttribute('data-duration')
//     value = mem.getAttribute('data-value')

//     memFields[0].value = typeId
//     memFields[1].value = memName
//     memFields[2].value = duration
//     memFields[3].value = value  
// }

// const sideItems = document.querySelectorAll('.side-item')

// sideItems.forEach(item => {
//     item.addEventListener('click', (e)=>{
//         sideItems.forEach(i => {
//             i.classList.remove('selected')
//         })
//         item.classList.add('selected')
//     })
// })