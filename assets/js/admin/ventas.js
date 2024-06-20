$(document).ready(function () {
   tablaVentas = $("#tablaVentas").DataTable({
     language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "<strong>No se encontraron resultados</strong>",
      info: "Mostrando registros del <strong>_START_</strong> al <strong>_END_</strong> de un total de <strong>_TOTAL_</strong> registros.",
      infoEmpty:
        "Mostrando registros del <strong> 0 </strong> al <strong> 0 </strong> de un total de <strong> 0 </strong> registros.",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Ultimo",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      sProcessing: "Procesando....",
    },
    scrollX: true,
   }); 
});