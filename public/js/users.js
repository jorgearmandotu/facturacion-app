let inputName = document.querySelector('#name');
let inputDni = document.querySelector('#dni');
let inputEmail = document.querySelector('#email');
let inputPhone = document.querySelector('#phone');
let inputPassword = document.querySelector('#password');
let inputPasswordconfirmation = document.querySelector('#password_confirmation');
let formUser = document.querySelector('#formUser');
let btnForm = document.querySelector('#btnForm');

btnForm.addEventListener('click', function (e){
    e.preventDefault();
    store(e);
})

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
            // productsTable = $('#productsTable');
            //productsTable.ajax.reload(null, false);
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
