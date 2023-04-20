//Código para Datables
//$('#example').DataTable(); //Para inicializar datatables de la manera más simple
jQuery(document).ready(function($) {
    if ($('#datatablecontrolsliderpage')) {
        $('#datatablecontrolsliderpage').DataTable({
            //para cambiar el lenguaje a español
            // dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            buttons: ['excel', 'pdf'],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },
            // searching: false,
        });
    }

});