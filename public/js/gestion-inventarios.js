let linesTable;
let groupsTable;
let locationsTable;

$(document).ready(function () {
    linesTable = $('#linesTable').DataTable({
        ajax: '/admin/lines',
        responsive: true,
        autoWidth: false,
        language: {
            lengthMenu: "Mostrar _MENU_ registro por página",
            zeroRecords: "No se encontraron registros",
            info: "Mostrando la página _PAGE_ de _PAGES_",
            search: "Buscar",
            paginate: {
                previous: "Anterior",
                next: "Siguiente",
            },
            loadingRecords: "Leyendo información...",
            infoEmpty: "No hay coincidencias",
            infoFiltered: "(Filtrado de _MAX_ registros totales)",
        },
        lengthMenu: [
            [5, 10, 15],//-1 para all
            //[5, 10, 50, "All"],
            [5, 10, 15],
        ],
        columns: [
            {data: 'name'},
            {data: 'state'},
            {
                data: null,
                render: (data, type, row) => {
                    const isActivo = row.state == 'Activo';
                    const classBtn = isActivo ? 'btn-success' : 'btn-danger';
                    const icon = isActivo ? 'fa-check' : 'fa-times';
                    //const text = isActivo ? "Activo" : "Inactivo";
                    return `<button class='jsgrid-button btn ${classBtn}' onclick="state('/admin/lines/${row.id}', 'formLine')"> <i class='fas ${icon}'></i></button>`;
                    //<button class='jsgrid-button btn btn-warning' onclick="editLine(${row.id})"> <i class='far fa-edit'></i></button>
                }
            },
        ],
    });

    groupsTable = $('#groupsTable').DataTable({
        ajax: '/admin/groups',
        responsive: true,
        autoWidth: false,
        language: {
            lengthMenu: "Mostrar _MENU_ registro por página",
            zeroRecords: "No se encontraron registros",
            info: "Mostrando la página _PAGE_ de _PAGES_",
            search: "Buscar",
            paginate: {
                previous: "Anterior",
                next: "Siguiente",
            },
            loadingRecords: "Leyendo información...",
            infoEmpty: "No hay coincidencias",
            infoFiltered: "(Filtrado de _MAX_ registros totales)",
        },
        lengthMenu: [
            [5, 10, 15],//-1 para all
            //[5, 10, 50, "All"],
            [5, 10, 15],
        ],
        columns: [
            {data: 'name'},
            {data: 'line'},
            {data: 'state'},
            {
                data: null,
                render: (data, type, row) => {
                    const isActivo = row.state == 'Activo';
                    const classBtn = isActivo ? 'btn-success' : 'btn-danger';
                    const icon = isActivo ? 'fa-check' : 'fa-times';
                    //const text = isActivo ? "Activo" : "Inactivo";
                    return `<button class='jsgrid-button btn ${classBtn}' onclick="state('/admin/groups/${row.id}', 'formGroup')"> <i class='fas ${icon}'></i></button>`;
                    //<button class='jsgrid-button btn btn-warning' onclick="state('/admin/lines/${row.id}', 'formLine')"> <i class='far fa-edit'></i></button>
                }
            },
        ],
    });

    locationsTable = $('#locationsTable').DataTable({
        ajax: '/admin/locations',
        responsive: true,
        autoWidth: false,
        language: {
            lengthMenu: "Mostrar _MENU_ registro por página",
            zeroRecords: "No se encontraron registros",
            info: "Mostrando la página _PAGE_ de _PAGES_",
            search: "Buscar",
            paginate: {
                previous: "Anterior",
                next: "Siguiente",
            },
            loadingRecords: "Leyendo información...",
            infoEmpty: "No hay coincidencias",
            infoFiltered: "(Filtrado de _MAX_ registros totales)",
        },
        lengthMenu: [
            [5, 10, 15],//-1 para all
            //[5, 10, 50, "All"],
            [5, 10, 15],
        ],
        columns: [
            {data: 'name'},
            {data: 'state'},
            {
                data: null,
                render: (data, type, row) => {
                    const isActivo = row.state == 'Activo';
                    const classBtn = isActivo ? 'btn-success' : 'btn-danger';
                    const icon = isActivo ? 'fa-check' : 'fa-times';
                    //const text = isActivo ? "Activo" : "Inactivo";
                    return `<button class='jsgrid-button btn ${classBtn}' onclick="state('/admin/locations/${row.id}', 'formLocation')"> <i class='fas ${icon}'></i></button>`;
                    //<button class='jsgrid-button btn btn-warning' onclick="editLine(${row.id})"> <i class='far fa-edit'></i></button>
                }
            },
        ],
    });
});

function messages(icon, title, button, timer){
    Swal.fire({
        //position: 'center',
        type: icon,
        title: title,
        showConfirmButton: button,
        timer: timer
      })

}

// async function saveGroup(){
//     let form = document.querySelector('#formGroup');
//     let data = new FormData(form);
//     const valores = Object.fromEntries(data.entries());
//     if(valores.name !== ""){
//         //peticion fetch
//         try{
//             const response = await fetch('/admin/groups',{
//                 method: 'POST',
//                 body: data,
//             });

//             if (!response.ok) {
//                 throw new Error(`HTTP error! status: ${response.status}`);
//               }

//             const res = await response.json();
//             if(res.status == 200){
//                 messages('success', res.msg, false, 1500);
//             }else{
//                 messages('error', res.msg, true);
//             }

//         } catch(error) {
//             console.error(error);
//             messages('error', 'Algo salió mal contacté con el administrador del sistema', true);
//         }
//         form.reset();
//     }
// }
async function save(url, id){
    let form = document.querySelector(`#${id}`);
    let data = new FormData(form);
    const valores = Object.fromEntries(data.entries());
    if(valores.name !== ""){
        //peticion fetch
        try{
            //const response = await fetch('/admin/locations',{
            const response = await fetch(url ,{
                method: 'POST',
                body: data,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
              }

            const res = await response.json();
            if(res.status == 200){
                messages('success', res.msg, false, 1500);
                recargarTablas(id);
                if(id == 'formLine') Livewire.emit('lineAdded');
            }else{
                messages('error', res.msg, true);
            }

        } catch(error) {
            console.error(error);
            messages('error', 'Algo salió mal contacté con el administrador del sistema', true);
        }
        form.reset();
    }else{
        messages('info', 'El nombre no puede estar vacio', true);
    }
}

// async function stateLine(id){
//     const token = document.querySelector('input[name="_token"]').value;
//     const url = `/admin/lines/${id}`;
//     try{
//         const response = await fetch(url, {
//             method: 'PUT',
//             headers: {
//                 "X-CSRF-TOKEN": token,
//             },
//         });
//         if (!response.ok) {
//             throw new Error(`HTTP error! status: ${response.status}`);
//         }
//         const res = await response.json();
//         if(res.status == 200){
//             messages('success', res.msg, false, 1500);
//             recargarTablas('formLine');
//         }else{
//             messages('error', res.msg, true);
//         }

//     }catch(error) {
//         console.error(error);
//         messages('error', 'Algo salió mal contacté con el administrador del sistema', true);
//     }
// }

async function state(uri, table){
    const token = document.querySelector('input[name="_token"]').value;
    let url = uri;
    try{
        const response = await fetch(url, {
            method: 'PUT',
            headers: {
                "X-CSRF-TOKEN": token,
            },
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const res = await response.json();
        if(res.status == 200){
            messages('success', res.msg, false, 1500);
            recargarTablas(table);
        }else{
            messages('error', res.msg, true);
        }

    }catch(error) {
        console.error(error);
        messages('error', 'Algo salió mal contacté con el administrador del sistema', true);
    }
}

function recargarTablas(id){
    switch(id){
        case 'formLine':
            linesTable.ajax.reload(null, false);
        case 'formGroup':
            groupsTable.ajax.reload(null, false);
        case 'formLocation':
            locationsTable.ajax.reload(null, false);
    }
}
