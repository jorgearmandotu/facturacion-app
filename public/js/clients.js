let clientsTable;
let selectType = document.querySelector('#selectType');
let inputDni = document.querySelector('#inputDni');
let inputName = document.querySelector('#inputName');
let inputPhone = document.querySelector('#inputPhone');
let inputAddress = document.querySelector('#inputAddress');
let inputEmail = document.querySelector('#inputEmail');
let checkSupplier = document.querySelector('#customControlAutosizing');
let edit = false;
let client_id;

jQuery(function ($) {
    clientsTable = $('#clientsTable').DataTable({
        ajax: '/admin/listClients',
        responsive: true,
        dom: 'Bflrtipl',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="far fa-file-excel"></i>',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="far fa-file-pdf"></i>',
                titleAttr: 'Exportar a Pdf',
                className: 'btn btn-danger',
            },
            {
                extend: 'csvHtml5',
                text: '<i class="fas fa-file-csv"></i>',
                titleAttr: 'Exportar a csv',
                className: 'btn btn-warning',
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i>',
                titleAttr: 'Imprimir',
                className: 'btn btn-info',
            },
            // 'copy', 'csv', 'excel', 'pdf', 'print'
        ],
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
        lengthMenu: [10, 20, 30],
        columns: [
            {data: 'document_type'},
            {data: 'dni'},
            {data: 'name'},
            {data: 'phone'},
            {data: 'address'},
            {data: 'email'},
            {
                data: 'id',
                render: (data, type, row) => {
                    //const isActivo = row.state == 'Activo';
                    //const classBtn = isActivo ? 'btn-success' : 'btn-danger';
                    //const icon = isActivo ? 'fa-check' : 'fa-times';
                    //const text = isActivo ? "Activo" : "Inactivo";
                    return `<button class='jsgrid-button btn btn-warning ml-1' onclick="editClient(${row.id})" > <i class='far fa-edit'></i></button></div>`;
                }
            },
        ],
    });
});

async function save(e){
    e.preventDefault();
    let dni = inputDni.value;
    let type = selectType.value;
    let name = inputName.value;
    let phone = inputPhone.value;
    let address = inputAddress.value;
    let email = inputEmail.value;

    if(dni === '' || type === '' || name === ''){
       return messages('error', 'Datos de cliente es requerida', true);
    }

    let form = document.querySelector('#formClients');
    let data = new FormData(form);
    const values = Object.fromEntries(data.entries());
    let uri;
    if(edit){
        uri = `/admin/clients/${client_id}`;
        data.append('_method', 'PUT');
    } else {
       uri =  `/admin/clients`;
    }
    try{
        const response = await fetch(uri,{
            method: 'POST',
            body: data,
            headers: {
                //"X-CSRF-TOKEN": values._token,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        if (!response.ok) {
            messages('error', `Ocurio un error al procesar la solicitud, ${response.status}`, true);
            throw new Error(`HTTP error! status: ${response.status}`);
          }

        const res = await response.json();

        if(res.status == 200){
            messages('success', res.msg, false, 1500);
            clientsTable.ajax.reload(null, false);
            form.reset();
        }else{
            messages('error', res.msg, true);
        }
    }catch(error){
        console.error(error);
        messages('error', 'Ocurio un error al procesar la solicitud', true);
    }
}

async function editClient(id){
    //buscar cliente y cargar formulario con datos
    let uri = `clients/${id}`
    let response = await fetch(uri);

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

    const client = await response.json();
    //Livewire.emit(`loadGroup`, product.group);
    inputDni.value = client.dni;
    inputName.value = client.name;
    inputPhone.value = client.phone;
    inputAddress.value = client.address;
    inputEmail.value = client.email;
    selectType.value = client.document_type;
    let check = (client.supplier) ? checkSupplier.checked = true : checkSupplier.checked = false;
    $('#clientsModal').modal('show');
    edit = true;
    client_id = client.id;
}

function newClient(e){
    console.log('new');
    console.log(edit);
    edit = false;
    console.log(edit);
    document.querySelector('#formClients').reset();
}
