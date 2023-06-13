let suppliersTable;

jQuery(function ($) {
    suppliersTable = $('#suppliersTable').DataTable({
        ajax: '/admin/suppliers-list',
        responsive: true,
        dom: 'Bflrtipl',
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
            {data: 'dni'},
            {data: 'name'},
            {data: 'phone'},
            {data: 'address'},
            {data: 'email'},
            // {
            //     data: null,
            //     render: (data, type, row) => {
            //         const isActivo = row.state == 'Activo';
            //         const classBtn = isActivo ? 'btn-success' : 'btn-danger';
            //         const icon = isActivo ? 'fa-check' : 'fa-times';
            //         //const text = isActivo ? "Activo" : "Inactivo";
            //         return `<button class='jsgrid-button btn ${classBtn}' onclick="state('/admin/lines/${row.id}', 'formLine')"> <i class='fas ${icon}'></i></button>`;
            //         //<button class='jsgrid-button btn btn-warning' onclick="editLine(${row.id})"> <i class='far fa-edit'></i></button>
            //     }
            // },
        ],
    });
});

async function save(e){
    e.preventDefault();
    let form = document.querySelector('#formSupplier');
    let data = new FormData(form);
    // const values = Object.fromEntries(data.entries());
    try{
        const response = await fetch(`suppliers`,{
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
            suppliersTable.ajax.reload(null, false);
            messages('success', res.msg, false, 1500);
            //productsTable.ajax.reload(null, false);
            //recargarTablas(table);
        }else{
            messages('error', res.msg, true);
        }
        form.reset();
    }catch(error){
        console.error(error);
        messages('error', 'Ocurio un error al procesar la solicitud', true);
        form.reset();
    }
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
