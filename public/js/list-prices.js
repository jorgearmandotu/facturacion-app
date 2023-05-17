jQuery(function ($) {
    //productsTable = $('#productsTable');
    try{

            productsPriceTable = $('#pricesTable').DataTable({
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
                    [10, 15, 30],//-1 para all
                    //[5, 10, 50, "All"],
                    [10, 15, 30],
                ],
            });
    }catch(error){

    }
});
