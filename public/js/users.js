let inputName = document.querySelector('#name');
let inputDni = document.querySelector('#dni');
let inputEmail = document.querySelector('#email');
let inputPhone = document.querySelector('#phone');
let inputPassword = document.querySelector('#password');
let inputPasswordconfirmation = document.querySelector('#password_confirmation');
let formUser = document.querySelector('#formUser');
let btnForm = document.querySelector('#btnForm');
let checkAll = document.querySelector('#all');
let linesTable;
let inputId;
let inputMethod;
let checkRemision = document.querySelector('#remision');
let checkInvoice = document.querySelector('#invoice');
let checkReceipt = document.querySelector('#receipt');
let checkPendingInvoices = document.querySelector('#pending-invoices');
let checkRemisionesPendientes = document.querySelector('#remisionesPendientes');
let checkCreateProducts = document.querySelector('#createProducts');
let checkListProducts = document.querySelector('#listProductos');
let checkGestionInventario = document.querySelector('#gestionInventario');
let checkCargueFacturas = document.querySelector('#cargueFacturas');
let checkTerceros = document.querySelector('#terceros');
let checkSuppliers = document.querySelector('#suppliers');
let checkReports = document.querySelector('#reportes');
let checkConfigCompany = document.querySelector('#configurationCompany');
let checkUsers = document.querySelector('#users');
let checkgestionDocuments = document.querySelector('#gestionDocuments');

btnForm.addEventListener('click', function (e){
    e.preventDefault();
    store(e);
});

checkAll.addEventListener('click', function () {
    $('.group-all').prop('checked', $(this).prop('checked'));
});
async function store(e){
    e.preventDefault();
    let data = new FormData(formUser);
    //const values = Object.fromEntries(data.entries());
    let url = `/admin/adminUsers`;
    if(data.get('id')){
        url = `/admin/adminUsers/${data.get('id')}`;
    }
    try{
        inputId = document.querySelector('#id');
        inputMethod = document.querySelector('#method');
        if(inputId && inputMethod){
            formUser.removeChild(inputId);
            formUser.removeChild(inputMethod);
            inputId = null;
            inputMethod = null;
        }
        const response = await fetch(url,{
            method: 'POST',
            body: data,
            headers: {
                //"X-CSRF-TOKEN": values._token,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }

        const res = await response.json();
        // data = await response.json();
        // const errors = data.errors;
        // console.log(errors);
        if(res.errors){
            let msgError = '';
            for (const prop in res.errors) {
                msgError += `${res.errors[prop][0]}\n`;
            }
            return messages('error', msgError, true);
        }


        if(res.status == 200){
            //Livewire.emit('lineAdded')
            messages('success', res.msg, false, 1500);
            formUser.reset();
            $('#userModal').modal('hide');
            // productsTable = $('#productsTable');
            linesTable.ajax.reload(null, false);
            //location.reload();
            //recargarTablas(table);
        }else{
            messages('error', res.msg, true);
        }
    }catch(error){
        console.error(error);
        messages('error', 'Ocurio un error al procesar la solicitud', true);
    }
}

$(document).ready(function () {
    linesTable = $('#usersTable').DataTable({
        ajax: '/admin/users-list',
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
            {data: 'dni'},
            {data: 'email'},
            {data: 'phone'},
            {
                data: 'id',
                render: (data, type, row) => {
                    let classBtn = 'btn-success';
                    let iconBtn = '<i class="fas fa-check"></i>'
                    if(!row.is_active){
                        classBtn = 'btn-danger';
                        iconBtn = '<i class="fas fa-times"></i>'
                    }
                    return `<button class='jsgrid-button btn btn-warning ml-1' onclick="edit(${row.id})" > <i class='far fa-edit'></i></button></div><button type="submit" class='jsgrid-button btn ${classBtn} ml-1' onclick="stateUser(${row.id})" > ${iconBtn}</button></div>`;
                }
            },
        ],
    });
});

async function edit(userId){
    let uri = `adminUsers/${userId}`
    let response = await fetch(uri);

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const user = await response.json();
      formUser.reset();
      inputDni.value = user.dni;
      inputEmail.value = user.email;
      inputName.value = user.name;
      inputPhone.value = user.phone;
      const id = document.createElement("input");
      id.setAttribute("type", "hidden");
      id.setAttribute("value", user.id);
      id.setAttribute("name", `id`);
      id.setAttribute("id", `id`);
      const method = document.createElement("input");
      method.setAttribute("type", "hidden");
      method.setAttribute("value", "put");
      method.setAttribute("name", `_method`);
      method.setAttribute("id", `method`);
      formUser.appendChild(id);
      formUser.appendChild(method);
      user.permissions.forEach(function (permiso){
        switch(permiso.name){
            case 'remision.store':
                checkRemision.checked = true;
                break;
            case 'invoices.store':
                checkInvoice.checked = true;
                break;
            case 'receipt.store':
                checkReceipt.checked = true;
                break;
            case 'pending-invoices':
                checkPendingInvoices.checked = true;
                break;
            case 'listRemisiones':
                checkRemisionesPendientes.checked = true;
                break;
            case 'products.store':
                checkCreateProducts.checked = true;
                break;
            case 'products-list':
                checkListProducts.checked = true;
                break;
            case 'gestion-inventario':
                checkGestionInventario.checked = true;
                break;
            case 'shopping-invoices.store':
                checkCargueFacturas.checked = true;
                break;
            case 'terceros.store':
                checkTerceros.checked = true;
                break;
            case 'suppliers.index':
                checkSuppliers.checked = true;
                break;
            case 'exports':
                checkReports.checked = true;
                break;
            case 'config-company.store':
                checkConfigCompany.checked = true;
                break;
            case 'admin-users.store':
                checkUsers.checked = true;
                break;
            case 'gestion-documents':
                checkgestionDocuments.checked = true;
        }
        //   if(permiso.name == 'remision.index'){
        //       checkRemision.checked = true;
        //       console.log(permiso.name);
        // }
      });
    $('#userModal').modal('show');
}

async function stateUser(userId){
    const url = `stateUser/${userId}`;
    try{
        let data = new FormData();
        data.append('_method', 'put');
        let listado = Object.fromEntries(data.entries());
      console.log(listado);
        const response = await fetch(url,{
            method: 'POST',
            body: data,
            headers: {
                //"X-CSRF-TOKEN": values._token,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }

        const res = await response.json();
        if(res.errors){
            let msgError = '';
            for (const prop in res.errors) {
                msgError += `${res.errors[prop][0]}\n`;
            }
            return messages('error', msgError, true);
        }


        if(res.status == 200){
            messages('success', res.msg, false, 1500);
            linesTable.ajax.reload(null, false);
        }else{
            messages('error', res.msg, true);
        }
    }catch(error){
        console.error(error);
        messages('error', 'Ocurio un error al procesar la solicitud', true);
    }
}
$('#userModal').on('hidden.bs.modal', function (e) {
    inputId = document.querySelector('#id');
    inputMethod = document.querySelector('#method');
    if(inputId !== null && inputMethod !== null){
        formUser.removeChild(inputId);
        formUser.removeChild(inputMethod);
        inputId = null;
        inputMethod = null;
    }
    formUser.reset();
  });
