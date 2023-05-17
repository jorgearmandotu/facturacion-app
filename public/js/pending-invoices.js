
jQuery(function ($) {
    $('#pendingInvoicesTable').DataTable({
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
    });
});
