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
    const values = Object.fromEntries(data.entries());
    console.log(values);
    try{
        const response = await fetch(`/admin/adminUsers`,{
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

          console.log(response);
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
                data: null,
                render: (data, type, row) => {
                    return `<button class='jsgrid-button btn btn-warning ml-1' onclick="edit(${row.id})" > <i class='far fa-edit'></i></button></div>`;
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
      console.log(user);
      formUser.reset();
      inputDni.value = user.dni;
      inputEmail.value = user.email;
      inputName.value = user.name;
      inputPhone.value = user.phone;

    $('#userModal').modal('show');
}
