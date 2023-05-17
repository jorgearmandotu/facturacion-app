let paymentMethodsTable ;
jQuery(function(){
    paymentMethodsTable = $('#methodsTable').DataTable({
        ajax: '/admin/listPaymentMethods',
        responsive: true,
        // dom: 'Bflrtipl',
        // buttons: [
        //     {
        //         extend: 'excelHtml5',
        //         text: '<i class="far fa-file-excel"></i>',
        //         titleAttr: 'Exportar a Excel',
        //         className: 'btn btn-success',
        //     },
        //     {
        //         extend: 'pdfHtml5',
        //         text: '<i class="far fa-file-pdf"></i>',
        //         titleAttr: 'Exportar a Pdf',
        //         className: 'btn btn-danger',
        //     },
        //     {
        //         extend: 'csvHtml5',
        //         text: '<i class="fas fa-file-csv"></i>',
        //         titleAttr: 'Exportar a csv',
        //         className: 'btn btn-warning',
        //     },
        //     {
        //         extend: 'print',
        //         text: '<i class="fas fa-print"></i>',
        //         titleAttr: 'Imprimir',
        //         className: 'btn btn-info',
        //     },
        //     // 'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
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
});

async function changeState(id){
    const token = document.querySelector('input[name="_token"]').value;
    let url = `statePaymentMethods/${id}`;
    console.log(url);
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
