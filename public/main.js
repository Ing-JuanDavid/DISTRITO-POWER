let userTable, memTable


// Se valido solo cuando se usa AJAX
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
        emptyTable: "No hay datos disponibles",
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

    // userTableIsInicialized = true
    // memTableIsInicialized = true
}


window.addEventListener('load', ()=>{
    initDataTable();
})