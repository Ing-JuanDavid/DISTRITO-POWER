// --- Configuración de DataTables ---
const config = {
    columnDefs: [
        { className: "center", targets: [0, 4] },
        { orderable: false, targets: [4] },
        { searchable: false, targets: [0, 2, 4] }
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

const memberTableConfig = {
    columnDefs: [
        { className: "center", targets: [2, 3, 4] },
        { orderable: false, targets: [4] },
        { searchable: false, targets: [2, 4] }
    ],
    lengthMenu: [5, 10, 25],
    destroy: true,
    language: config.language
};

const paysTableConfig = {
    columnDefs: [
        {className: "center", targets: [0, 1, 4, 5]},//{width: '5%', targets: [0]}
    ],
    lengthMenu: [5, 10, 25],
    // spageLength: 10,
    language: config.language
};

// --- Inicialización de DataTables ---
function initDataTables() {
    if (document.getElementById('users')) {
        $('#users').DataTable(config);
    }
    if (document.getElementById('memberships')) {
        $('#memberships').DataTable(config);
    }
    if (document.getElementById('members')) {
        $('#members').DataTable(memberTableConfig);
    }

    if (document.getElementById('pays')) {
        $('#pays').DataTable(paysTableConfig);
    }
}

// --- Inicialización de gráficas ---
function initCharts() {
    if (typeof payLabels !== "undefined" && typeof memsLabels !== "undefined" && typeof chartPaysData !== "undefined" && typeof chartMemsData !== "undefined") {
        // Membresías (línea)
        if (document.getElementById('chartMems')) {
            const memsCtx = document.getElementById('chartMems').getContext('2d');
            new Chart(memsCtx, {
                type: 'line',
                data: {
                    labels: memsLabels,
                    datasets: [{
                        label: '# membresías',
                        data: chartMemsData,
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13,110,253,0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }

        // Pagos (barras)
        if (document.getElementById('chartPays')) {
            const paysCtx = document.getElementById('chartPays').getContext('2d');
            new Chart(paysCtx, {
                type: 'bar',
                data: {
                    labels: payLabels,
                    datasets: [{
                        label: 'Pagos',
                        data: chartPaysData,
                        backgroundColor: '#198754'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    }
}

// --- Sidebar: selección visual ---
function initSidebarSelection() {
    const sideItems = document.querySelectorAll('.side-item');
    sideItems.forEach(item => {
        item.addEventListener('click', () => {
            sideItems.forEach(i => i.classList.remove('selected'));
            item.classList.add('selected');
        });
    });
}

// Modals

// Delegación de eventos para editar usuario
document.addEventListener('click', function (e) {
    const userBtn = e.target.closest('.editUser');
    if (userBtn) {
        const userFields = document.querySelectorAll('.field-edit-user');
        setModalUsers(userBtn, userFields);
    }
});

document.addEventListener('click', function (e) {
    const memBtn = e.target.closest('.editMem');
    if (memBtn) {
        const memFields = document.querySelectorAll('.field-edit-mem');
        setModalMems(memBtn, memFields);
    }
});

function setModalUsers(user, userFields) {
    id = user.getAttribute('data-userId')
    userName = user.getAttribute('data-name')
    email = user.getAttribute('data-email')
    rol = user.getAttribute('data-rol')

    userFields[0].value = id
    userFields[1].value = userName
    userFields[2].value = email
    userFields[3].value = rol   
}

function setModalMems(mem, memFields) {
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

// --- Inicialización global ---
document.addEventListener('DOMContentLoaded', function () {
    initDataTables();
    initCharts();
    initSidebarSelection();
});



