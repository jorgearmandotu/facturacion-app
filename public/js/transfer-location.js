
let inputCode = document.querySelector('#inputCode');
let inputStock = document.querySelector('#existenciaFrom');
let inputQuantity = document.querySelector('#quantity');
let selectFrom = document.querySelector('#selectFrom');
let selectTo = document.querySelector('#selectTo');
let productsTable;
let listTransfer = new FormData();
let index = 1;
let labelProduct = document.querySelector('#nameProduct');
$(document).ready(function () {
    productsTable = $('#tableLocationsProducts').DataTable({
        ajax: '/admin/transfer-location-table',
        responsive: true,
        autoWidth: false,
        order: [1, 'asc'],
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
            [10, 20, 30],//-1 para all
            //[5, 10, 50, "All"],
            [10, 20, 30],
        ],
        columns: [
            {data: 'code'},
            {data: 'product'},
            {data: 'location'},
            {data: 'stock',
                render: (data, type, row)=> {
                    if(data <= 0){
                        return `<span style="color:red">${ data }</span>`;
                    }else{
                        return data;
                    }
                }},
        ]
    })
});

function createTransfer(e){
    e.preventDefault();
    let quantity = inputQuantity.value;
    let stock = inputStock.value;
    console.log(stock);
    console.log(quantity);
    if(Number(stock) < Number(quantity)){
        return messages('error', 'La cantidad supera el stock disponible en esta ubicación', true);
    }
    if(quantity < 1){
        return messages('error', 'La cantidad a transladar debe ser mayor a cero', true);
    }
    let formTransfer = document.querySelector('#form-transfer');
    let dataTransfer = new FormData(formTransfer);

    // document.querySelector('#form-transfer').reset();
    // Livewire.emit('resetForm')
    //     while (newrow.firstChild) {
    //         newrow.removeChild(newrow.firstChild);
    //       }
    //listTransfer.append(`code${index}`)
    sendTransfer(dataTransfer);
}

async function sendTransfer(data){
    try{
        const response = await fetch('/admin/transfer-location', {
            method: 'Post',
            body: data,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        });
        if (!response.ok) {
            messages('error', 'Ocurrió un error interno, contacte al administrador del sistema', true)
            throw new Error(`HTTP error! status: ${response.status}`);
          }

          const res = await response.json();

        if(res.status == 200){
            messages('success', 'Translado exitoso', false, 1500);
            productsTable.ajax.reload(null, false);
            let print = window.open(`print-transfer/${res.transfer}`, '_blank');
        }else{
            messages('error', res.msg, true);
        }
        //reset a formulario encabezados
        document.querySelector('#form-transfer').reset();
        Livewire.emit('resetForm')
    }catch(error){
        console.error(error);
        return messages('error', 'Ocurrió un error inesperado, contacte al administrador del sistema', true)
    }
}
