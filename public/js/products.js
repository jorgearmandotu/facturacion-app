let costoInput = document.getElementById('inputCosto');
let percentInput = document.getElementById('inputProfit');
let priceInput = document.getElementById('inputPrice');
let productsTable;

function changePercent(){
    let costo = costoInput.value;
    let percent = percentInput.value;
    priceInput.value = (Number(costo)+costo*percent/100).toFixed(0);
}

function changePrice(){
    let costo = costoInput.value;
    let price = priceInput.value;
    percentInput.value = (Number(price-costo)/costo*100).toFixed(2);
}

function changeCosto(){
    //let costo = costoInput.value;
    let percent = percentInput.value;
    let price = priceInput.value;
    if(percent === "" && price!== ""){
        changePrice();
    }else{
        changePercent();
    }
}

$(document).ready(function () {
    //productsTable = $('#productsTable');
    try{

            productsTable = $('#productsTable').DataTable({
                dom: 'lBfrtip',//lBfrtip agregará la opción de longitud de página (l), los botones de exportación (B), la búsqueda (f), la tabla en sí (r), la información de paginación (t) y los botones de proceso (i y p)
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
                    {data: 'costo',
                        render: (data, type, row)=>{
                            number = row.costo;
                            number.toLocaleString('es-CO');
                            number = new Intl.NumberFormat('es-CO').format(number);
                            return number;
                        }
                    },
                    {data: 'price',
                        render: (data, type, row)=>{
                            number = row.price;
                            number.toLocaleString('es-CO');
                            number = new Intl.NumberFormat('es-CO').format(number);
                            return number;
                        }
                    },
                    {data: 'profit',
                    render: (data, type, row)=> {
                        if(row.profit < 1){
                            return `<span style="color:red">${row.profit}</span>`;
                        }
                        return row.profit;
                        }
                    },
                    {data: 'total',
                    render: (data) => {
                        if(data < 1){
                            return `<span style="color:red">${data}</span>`;
                        }
                        return data;
                        }
                    },
                    {data: 'locationMain'},
                    {data: 'line'},
                    {data: 'group'},
                    {data: 'code'},
                    {data: 'state'},
                    {
                        data: 'state',
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
    }catch(error){

    }
});

async function state(uri, table){
    //const token = document.querySelector('input[name="_token"]').value;
    let url = uri;
    let data = new FormData();
    data.append('changeState', 'true');
    data.append('_method', 'PUT');
    try{
        const response = await fetch(url, {
            method: 'POST',
            body: data,
            headers: {
                //"X-CSRF-TOKEN": token,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const res = await response.json();
        if(res.status == 200){
            //Livewire.emit('lineAdded')
            messages('success', res.msg, false, 1500);
            //productsTable = $('#productsTable');
            //console.log(productsTable);
            //location.reload();
            productsTable.ajax.reload(null, false);
            //recargarTablas(table);
        }else{
            messages('error', res.msg, true);
        }

    }catch(error) {
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
    Livewire.emit(`loadGroup`, product.group);
    let inputCode = document.getElementById('inputCode');
    let inputName = document.getElementById('inputName');
    let inputCosto = document.getElementById('inputCosto');
    let inputProfit = document.getElementById('inputProfit');
    let inputPrice = document.getElementById('inputPrice');
    let inputReference = document.getElementById('inputReference');
    let inputBarCode = document.getElementById('inputBarCode');
    let inputId = document.getElementById('inputId');
    let selectTax = document.getElementById('selectTax');
    let checkActivo = document.getElementById('checkState');
    let selectLocationMain = document.getElementById('locationMain')
    inputCode.value = product.code;
    inputName.value = product.name;
    inputCosto.value = product.costo;
    inputProfit.value = product.utilidad;
    inputPrice.value = product.price;
    inputReference.value = (product.reference ) ? product.reference : '';
    inputBarCode.value = (product.bar_code) ? product.bar_code : '';
    inputId.value = product.id;
    selectTax.value = product.tax;
    selectLocationMain.value = product.location_main;
    (product.state === 'Activo') ? checkActivo.checked = true : checkActivo.checked = false;


    $('#editProduct').modal('show');
}

async function updateProduct(e){
    e.preventDefault();
    let form = document.querySelector('#formProduct');
    let data = new FormData(form);
    const values = Object.fromEntries(data.entries());
    try{
        const response = await fetch(`/admin/products/${values.id}`,{
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

        if(res.status == 200){
            //Livewire.emit('lineAdded')
            messages('success', res.msg, false, 1500);
            // productsTable = $('#productsTable');
            productsTable.ajax.reload(null, false);
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

