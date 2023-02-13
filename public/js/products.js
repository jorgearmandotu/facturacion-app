let costoInput = document.getElementById('costo');
let percentInput = document.getElementById('percent');
let priceInput = document.getElementById('price');

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
    linesTable = $('#productsTable').DataTable({
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
                    return `<button class='jsgrid-button btn ${classBtn}' onclick="state('/admin/lines/${row.id}', 'formLine')"> <i class='fas ${icon}'></i></button>`;
                    //<button class='jsgrid-button btn btn-warning' onclick="editLine(${row.id})"> <i class='far fa-edit'></i></button>
                }
            },
        ],
    });
});
