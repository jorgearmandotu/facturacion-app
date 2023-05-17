let inputName = document.querySelector('#inputName');
let formCategory = document.querySelector('#formCategory');
let tableCategory = document.querySelector('#categoriesTable');
let index = 0;

async function crearCategory(e){
    if(inputName.value === ''){
        return messages('error', 'Ingrese nombre de categoria', true);
    }
    let name = inputName.value;
    const url = 'categoryDischarge';
    let data = new FormData(formCategory);
    try{
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
            formCategory.reset();
            $('#modalCategory').modal('hide');
            index = 0;
            tableCategory.ajax.reload(null, false);
        }else{
            messages('error', res.msg, true);
        }
    }catch(error){
        console.error(error);
        messages('error', 'Ocurio un error al procesar la solicitud', true);
    }
}

jQuery(function($){
    tableCategory = $('#categoriesTable').DataTable({
        ajax: 'categoriesDischargeList',
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
            {
                data: 'id',
                render: (data, type, row) => {
                index++;
                return index;
                }
            },
            {
                data: 'name'
            },
        ],
    });
});
