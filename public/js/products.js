let costoInput = document.getElementById('costo');
let percentInput = document.getElementById('percent');
let priceInput = document.getElementById('price');
let productsTable;

function changePercent(){
    let costo = costoInput.value;
    let percent = percentInput.value;
    priceInput.value = Number(costo)+costo*percent/100;
}

function changePrice(){
    let costo = costoInput.value;
    let price = priceInput.value;
    percentInput.value = Number(price-costo)/costo*100;
}

function changeCosto(){
    let costo = costoInput.value;
    let percent = percentInput.value;
    let price = priceInput.value;
    if(percent === "" && price!== ""){
        changePrice();
    }else{
        changePercent();
    }
}

$(document).ready(function () {
    productsTable = $('#productsTable').DataTable({
        ajax: '/admin/products',
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
            {data: 'reference'},
            {data: 'costo'},
            {data: 'price'},
            {data: 'profit'},
            {data: 'line'},
            {data: 'group'},
            {data: 'code'},
            {data: 'state'},
            {
                data: null,
                render: (data, type, row) => {
                    const isActivo = row.state == 'Activo';
                    const classBtn = isActivo ? 'btn-success' : 'btn-danger';
                    const icon = isActivo ? 'fa-check' : 'fa-times';
                    //const text = isActivo ? "Activo" : "Inactivo";
                    return `<div class="row"><button class='jsgrid-button btn ${classBtn}' onclick="state('/admin/products/${row.id}', 'productsTable')"> <i class='fas ${icon}'></i></button>
                    <button class='jsgrid-button btn btn-warning ml-1' onclick="edit(${row.id})" > <i class='far fa-edit'></i></button></div>`;
                }
            },
        ],
    });
});

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
            //Livewire.emit('lineAdded')
            messages('success', res.msg, false, 1500);
            productsTable.ajax.reload(null, false);
            //recargarTablas(table);
        }else{
            messages('error', res.msg, true);
        }

    }catch(error) {
        console.log(error);
        console.error(error);
        messages('error', 'Algo salió mal contacté con el administrador del sistema', true);
    }
}

async function edit(id){
    //buscar producto y cargar formulario con datos
    let uri = `products/${id}`
    let response = await fetch(uri);

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

    const product = await response.json();
    console.log(product);
    let inputCode = document.getElementById('inputCode');
    let inputName = document.getElementById('inputName');
    let inputCosto = document.getElementById('inputCosto');
    let inputProfit = document.getElementById('inputProfit');
    let inputPrice = document.getElementById('inputPrice');
    let inputReference = document.getElementById('inputReference');
    let inputCodeBar = document.getElementById('inputCodeBar');
    inputCode.value = product.code;
    inputName.value = product.name;
    inputCosto.value = product.costo;
    inputProfit.value = product.profit;
    inputPrice.value = product.price;
    inputReference.value = product.reference;
    inputCodeBar.value = product.codeBar;

    $('#editProduct').modal('show');
}

function messages(icon, title, button, timer){
    Swal.fire({
        //position: 'center',
        type: icon,
        title: title,
        showConfirmButton: button,
        timer: timer
      })

}
