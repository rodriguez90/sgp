var handleDataTable = function() {

    if ($('#data-table').length !== 0) {

        var ajax = null;

        var columns = [
            {
                "title": "Nombre",
                "data":"nombre"
            },
            {
                "title": "Código",
                "data":"codigo"
            },
            {
                "title": "Cantidad",
                "data":"cantidad"
            },
            {
                "title": "Proveedor",
                "data":"proveedor"
            },
        ];

        var columnDefs = [
        ];

        var  table = $('#data-table').DataTable({
            // dom: '<"top"iflp<"clear">>rt',
            // data:[],
            dom: '<"top"<"clear">>tp',
            // processing:true,
            lengthMenu: [5, 10, 15],
            pageLength: 3,
            language: lan,
            order: [[ 0, 'asc' ]],
            responsive: true,
            deferRender: false,
            // "ajax": ajax,
            columns: columns,
            columnDefs:columnDefs
        });
    }
};

var init = function(){

    handleDataTable();
    // recuperar los medicamentos del pedido

    $.ajax({
        // async:false,
        url: homeUrl + "pedido/detalles",
        type: "get",
        dataType: "json",
        data: {id: pedidoId} ,
//                            contentType: "application/json; charset=utf-8",
        beforeSend:function () {

        },
        success: function (response) {

            if(response.success)
            {
                var table = $('#data-table').DataTable();
                table.rows.add(response.data).draw();
            }
            else
            {
                $.alert(
                    {
                        title:'Advertencia!',
                        content:response.msg,
                        buttons: {
                            confirm: {
                                text:'Aceptar',
                            }
                        }
                    }
                );
            }
        },
        error: function(data) {
            $.alert(
                {
                    title:'Advertencia!',
                    content:'Ah ocurrido un error al recuperar los medicamentos del pedido.',
                    buttons: {
                        confirm: {
                            text:'Aceptar',
                        }
                    }
                }
            );
        },
    });
};

$(document).ready(function () {
    init();
});