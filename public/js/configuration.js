let paymentMethodsTable ;
let taxTable;
let inputNameTax = document.querySelector('#nameTax');
let inputValueTax = document.querySelector('#valueTax');
let inputdescriptionTax = document.querySelector('#descriptionTax');
let inputTax = document.querySelector('#tax');
let stateTax = document.querySelector('#stateTax');
jQuery(function(){
    paymentMethodsTable = $('#methodsTable').DataTable({
        ajax: '/admin/listPaymentMethods',
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
            [5, 10, -1],
            [5, 10, 'Todos'],
        ],
        columns: [
            {data: 'value'},
            {
                data: 'state',
                render: (data, type, row) => {
                    const isActivo = data== 'Activo';
                    const classBtn = isActivo ? 'btn-success' : 'btn-danger';
                    const icon = isActivo ? 'fa-check' : 'fa-times';
                    const text = isActivo ? "Activo" : "Inactivo";
                    return `<button class='btn ${classBtn} ml-1' onclick="changeState(${row.id})" title="${text}"> <i class='fas ${icon}'></i></button></div>`;
                }
            },
        ],
    });

    taxTable = $('#taxesTable').DataTable({
        ajax: '/admin/listTaxes',
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
            [5, 10, -1],
            [5, 10, 'Todos'],
        ],
        columns: [
            {data: 'name'},
            {data: 'value'},
            {data: 'description',
                render: (data, type, row)=>{
                    return data.substring(0, 25);
                }
            },
            {
                data: 'id',
                render: (data, type, row) => {
                    let iconButton = '<i class="fas fa-times"></i>';
                    let classBtn = 'jsgrid-button btn btn-danger ml-1';
                    if(row.state.value === 'Activo'){
                        iconButton = '<i class="fas fa-check"></i>';
                        classBtn = 'jsgrid-button btn btn-success ml-1';
                    }
                    return `<div class="row"><button class='jsgrid-button btn btn-warning ml-1' onclick="editTax(${data})" > <i class='far fa-edit'></i></button>
                    <button class='${classBtn}' onclick="editStateTax(${data})" > ${iconButton}</button></div>`;
                }
            }
        ],
    });
});

async function changeState(id){
    const token = document.querySelector('input[name="_token"]').value;
    let url = `statePaymentMethods/${id}`;
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
            paymentMethodsTable.ajax.reload(null, false);
        }else{
            messages('error', res.msg, true);
        }

    }catch(error) {
        console.error(error);
        messages('error', 'Algo salió mal contacté con el administrador del sistema', true);
    }
}

async function editTax(id){
    //consultar informacion y cargar en modal
    let response = await fetch(`taxData/${id}`);
    if (!response.ok) {
        messages('error', 'No fue pposible obtener la información', true)
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    let tax = await response.json();
    inputNameTax.value = tax.name;
    inputValueTax.value = tax.value;
    inputdescriptionTax.value = tax.description;
    inputTax.value = tax.id;
    if(stateTax.checked){
        (tax.state.value === 'Activo') ? '' : stateTax.click();
    }else{
        (tax.state.value === 'Activo') ? stateTax.click() : '';
    }
    $('#taxModal').modal('show');
}


$('#taxModal').on('hidden.bs.modal', function (e) {
    inputNameTax.value = '';
    inputValueTax.value = '';
    inputdescriptionTax.value = '';
    inputTax.value = '';
    (stateTax.checked) ? '' : stateTax.click();
  });



async function saveTax(){
    let tax = inputTax.value;
    let url = 'createTax';
    try{
        let form = document.querySelector('#formTax');
        let data = new FormData(form);
    if(tax !== ''){
        url = `updateTax/${tax}`;
        data.append('_method', 'PUT')
    }
        // const values = Object.fromEntries(data.entries());
        // console.log(values);
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: data,
        });
        if (!response.ok) {
            console.log('error response');
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const res = await response.json();
        if(res.status == 200){
            messages('success', res.msg, false, 1500);
            taxTable.ajax.reload(null, false);
        }else{
            messages('error', res.msg, true);
        }
    }catch(error){
        console.error(error);
        messages('error', 'Ocurio un error al procesar la solicitud', true);
    }

    $('#taxModal').modal('hide');
}
async function editStateTax(id){
    let url = `updateStateTax/${id}`;
    try{
    let data = new FormData();
    data.append('_method', 'PUT')
        // const values = Object.fromEntries(data.entries());
        // console.log(values);
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: data,
        });
        if (!response.ok) {
            console.log('error response');
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const res = await response.json();
        if(res.status == 200){
            messages('success', res.msg, false, 1500);
            taxTable.ajax.reload(null, false);
        }else{
            messages('error', res.msg, true);
        }
    }catch(error){
        console.error(error);
        messages('error', 'Ocurio un error al procesar la solicitud', true);
    }
}
